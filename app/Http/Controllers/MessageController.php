<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Unified Messaging inbox.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        $messages = $student->messages()
                            ->orderByDesc('created_at')
                            ->paginate(15);

        return view('messages.index', compact('student', 'messages'));
    }

    /**
     * Send a message to faculty.
     */
    public function send(Request $request)
    {
        $request->validate([
            'recipient_name'  => 'required|string|max:150',
            'recipient_email' => 'required|email|max:255',
            'subject'         => 'required|string|max:255',
            'body'            => 'required|string|max:5000',
        ]);

        $student = Auth::guard('student')->user();

        Message::create([
            'student_id'      => $student->id,
            'direction'        => 'sent',
            'recipient_name'  => $request->input('recipient_name'),
            'recipient_email' => $request->input('recipient_email'),
            'subject'         => $request->input('subject'),
            'body'            => $request->input('body'),
            'is_read'         => true,
        ]);

        return back()->with('success', 'Message sent to ' . $request->input('recipient_name') . '!');
    }

    /**
     * Mark a message as read.
     */
    public function markRead(Message $message)
    {
        $student = Auth::guard('student')->user();

        if ($message->student_id !== $student->id) {
            abort(403);
        }

        $message->update(['is_read' => true]);

        return back();
    }
}