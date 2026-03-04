<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Mail\WelcomeStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the SIS Login form.
     */
    public function showLogin()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * SIS INTEGRATION: Authenticate via Student ID OR Email.
     */
    public function login(Request $request)
    {
        $request->validate([
            'credential' => 'required|string',
            'password'   => 'required|string',
        ]);

        $credential = $request->input('credential');
        $password    = $request->input('password');

        // Determine if the credential is an email or student number
        $field = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'student_number';

        $student = Student::where($field, $credential)->first();

        if (!$student || !Hash::check($password, $student->password)) {
            return back()
                ->withInput($request->only('credential'))
                ->withErrors(['credential' => 'Invalid Student ID/Email or password.']);
        }

        if (!$student->is_active) {
            return back()->withErrors([
                'credential' => 'Account deactivated. Please contact the Registrar\'s Office.'
            ]);
        }

        Auth::guard('student')->login($student, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Show registration form.
     */
    public function showRegister()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Register a new student account.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:20|unique:students,student_number',
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|max:255|unique:students,email',
            'password'       => ['required', 'confirmed', Password::min(8)],
            'program'        => 'required|string|max:150',
            'year_level'     => 'required|in:1st Year,2nd Year,3rd Year,4th Year',
            'id_photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle Digital ID upload
        if ($request->hasFile('id_photo')) {
            $validated['id_photo'] = $request->file('id_photo')
                                             ->store('id_photos', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        $student = Student::create($validated);

        // Send automated "Welcome" email
        try {
            Mail::to($student->email)->send(new WelcomeStudent($student));
        } catch (\Exception $e) {
            // Log but don't block registration
            logger()->warning('Welcome email failed: ' . $e->getMessage());
        }

        Auth::guard('student')->login($student);

        return redirect()->route('dashboard')
                         ->with('success', 'Welcome to the University of Mindanao Academic Portal, ' . $student->first_name . '!');
    }

    /**
     * Logout the student.
     */
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'You have been logged out successfully.');
    }
}
