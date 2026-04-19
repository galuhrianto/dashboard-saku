<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function showResetForm($token)
    {
        $records = DB::table('password_reset_tokens')->get();

        $record = $records->first(function ($r) use ($token) {
            return Hash::check($token, $r->token);
        });

        // token tidak ditemukan / sudah dipakai
        if (!$record) {
            return view('auth.reset-expired');
        }

        // expired
        if ($record->created_at < now()->subMinutes(60)) {
            return view('auth.reset-expired');
        }

        // valid
        return view('auth.reset-password', [
            'token' => $token,
            'username' => request('username'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'token' => 'required'
        ]);

        $records = DB::table('password_reset_tokens')->get();

        $record = $records->first(function ($r) use ($request) {
            return Hash::check($request->token, $r->token);
        });

        if (!$record) {
            return back()->withErrors(['token' => 'Token tidak ditemukan']);
        }

        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Token tidak valid']);
        }

        if ($record->created_at < now()->subMinutes(60)) {

                DB::table('password_reset_tokens')
                ->where('email', $record->email)
                ->delete();

            return view('auth.reset-expired');
        }

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User tidak ditemukan']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'password_initialized_at' => now(),
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $request->username)
            ->delete();

        return redirect('/login')->with('success', 'Password berhasil diubah');
    }
}
