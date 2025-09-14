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
use App\Models\Program;

class AuthController extends Controller
{
    public function success()
    {
        return view('auth.success')->with('success', 'Registration successful');
    }

    public function index()
    {
        $programs = Program::all();
        return view('auth.login', compact('programs'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if (is_null($user->email_verified_at)) {
                $this->sendVerificationCode($user);
                return redirect()->route('auth.verifyEmail')
                    ->with('warning', 'Debes verificar tu correo.');
            }
            return redirect()->route('dashboard.index')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->with('error', 'Credenciales inválidas.')->withInput();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ci' => 'required|string|max:9|unique:users,ci',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'program_id' => 'required|integer|exists:programs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $verificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ci' => $request->ci,
            'program_id' => $request->program_id,
            'role_id' => 4,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

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
            return back()->withErrors(['email' => 'No user found with this email.'])->withInput();
        }

        $newVerificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['verification_code' => $newVerificationCode]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($newVerificationCode));
            $programs = Program::all();
            return view('auth.verifyEmail', compact('programs'))
                ->with('success', 'Your verification code has been successfully resent!');
        } catch (\Exception $e) {
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
        return redirect()->route('indexLogin')->with('success', 'Sesión cerrada.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'new_password' => 'required|string|min:8|confirmed',
            'verification_code' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.'])->withInput();
        }

        if ($user->verification_code !== $request->verification_code) {
            return back()->withErrors(['verification_code' => 'Invalid verification code.'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->verification_code = null;
        $user->email_verified_at = now();
        $user->save();
        $programs = Program::all();

        return view('auth.login', compact('programs'))
            ->with('success', 'Password reset successfully.');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()
                ->route('password.forgot')
                ->withErrors(['email' => 'No user found with this email.'])
                ->withInput();
        }

        $newVerificationCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'verification_code'   => $newVerificationCode,
            'email_verified_at'   => null,
        ]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($newVerificationCode));

            session()->flash('code_sent', true);
            session()->flash('email_for_reset', $user->email);

            return redirect()
                ->route('password.forgot')
                ->with('success', 'Hemos enviado un código a tu correo. Revisa bandeja de entrada o spam.');
        } catch (\Exception $e) {
            return redirect()
                ->route('password.forgot')
                ->withErrors(['email' => 'No se pudo enviar el correo. Inténtalo de nuevo más tarde.'])
                ->withInput();
        }
    }
}
