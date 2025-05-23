<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCodeMail;
use App\Mail\PasswordResetSuccessful;


class AuthController extends Controller
{
    public function success()
    {
        return view('auth.success')->with('success', 'Registration successful');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (is_null($user->email_verified_at)) {

                $this->sendVerificationCode($user);
                return view('auth.verifyEmail')
                    ->with('warning', 'You must verify your email to access.');
            }
            return redirect()->route('dashboard.index')
                ->with('success', 'Login successful');
        }

        return redirect()->route('logins')->with('error', 'Login failed');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ci' => 'required|string|max:9',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'program_id' => 'required|integer|exists:programs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Mantiene los datos ingresados en el formulario
        }

        $verificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 3,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

        // Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

        Auth::guard('web')->login($user);

        return redirect('/auth-verifyEmail')->with('success', 'Usuario registrado exitosamente.');
    }

    public function sendVerificationCode($user)
    {
        $verificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['verification_code' => $verificationCode]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo enviar el correo. Inténtalo de nuevo más tarde.',
            ], 500);
        }
    }

    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado.',
            ], 404);
        }

        $newVerificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['verification_code' => $newVerificationCode]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($newVerificationCode));
            return back()->with('success', 'Your verification code has been successfully resent!');
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo enviar el correo. Inténtalo de nuevo más tarde.',
            ], 500);
        }
    }



    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (trim($user->verification_code) === trim($request->verification_code)) {
            $user->verification_code = null;
            $user->email_verified_at = now();

            $user->save();

            return redirect()->route('dashboard.index')->with('success', 'Your account has been successfully verified!');
        }

        session()->flash('error', 'Invalid verification code. Please try again.');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logins')->with('success', ' You logged out successfully');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Mail::to($user->email)->send(new PasswordResetSuccessful());
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully.'], 200)
            : response()->json(['message' => 'Error resetting password.'], 400);
    }
}
