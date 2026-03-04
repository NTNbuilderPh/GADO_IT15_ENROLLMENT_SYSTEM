<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Secure Ledger — payment history and balances.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        $payments = $student->payments()
                            ->orderByDesc('created_at')
                            ->paginate(15);

        $totalPaid    = $student->payments()->where('status', 'completed')->sum('amount');
        $netBalance   = $student->net_balance;

        return view('payments.index', compact('student', 'payments', 'totalPaid', 'netBalance'));
    }

    /**
     * Process a tuition payment.
     */
    public function pay(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:100|max:100000',
            'payment_method' => 'required|in:cash,gcash,bank_transfer,credit_card',
        ]);

        $student = Auth::guard('student')->user();
        $amount  = (float) $request->input('amount');

        if ($amount > $student->tuition_balance) {
            return back()->with('error', 'Payment amount exceeds your outstanding balance.');
        }

        return DB::transaction(function () use ($student, $amount, $request) {

            // Generate unique reference
            $reference = 'UM-PAY-' . strtoupper(Str::random(8));

            Payment::create([
                'student_id'       => $student->id,
                'amount'           => $amount,
                'payment_method'   => $request->input('payment_method'),
                'reference_number' => $reference,
                'status'           => 'completed',
                'description'      => 'Tuition Payment',
                'paid_at'          => now(),
            ]);

            // Update student balance
            $student->decrement('tuition_balance', $amount);

            return back()->with('success', "Payment of ₱" . number_format($amount, 2) . " processed. Reference: {$reference}");
        });
    }
}