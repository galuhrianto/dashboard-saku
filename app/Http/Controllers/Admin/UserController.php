<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Backupreceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        $receivers = BackupReceiver::latest()->get();

        return view('admin.users.index', compact('users', 'roles', 'receivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'phone' => 'required',
        ], [
            'username.unique' => 'Username sudah digunakan',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->username),
            'role_id' => 2,
        ]);

        return back()->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'role_id' => $request->role_id,
        ]);

        return back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back();
    }

    public function passwordMode(Request $request, $user)
    {
        $request->validate([
            'password_mode' => 'required|in:auto,off'
        ]);

        $user = User::findOrFail($user);

        $user->update([
            'password_mode' => $request->password_mode,
        ]);

        return back()->with('success', 'Mode password diperbarui');
    }


    public function resendReset(User $user)
    {
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->username],
            [
                'token' => bcrypt($token),
                'created_at' => now(),
            ]
        );

        $link = url('/reset-password/'.$token.'?username='.$user->username);

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $user->phone,
            'message' => "🔐 Reset Password\n\nKlik link berikut:\n\n$link\n\nMohon untuk tidak bagikan tautan ke siapa pun, tautan akan kadaluarsa dalam waktu 60 menit."
        ]);

        $user->update([
            'password_initialized_at' => now()
        ]);

        return back()->with('success', 'Link berhasil dikirim ulang');
    }

    public function toggleBackup(BackupReceiver $receiver)
    {
        $receiver->update([
            'is_active' => !$receiver->is_active
        ]);

        return back()->with('success', 'Status berhasil diubah');
    }

    public function destroyBackup(BackupReceiver $receiver)
    {
        $receiver->delete();

        return back()->with('success', 'Receiver berhasil dihapus');
    }

    public function updateBackupAccounts(Request $request, BackupReceiver $receiver)
{
    $accounts = json_decode($request->accounts, true);

    if (!is_array($accounts)) {
        $accounts = [];
    }

    $validUsers = \App\Models\User::whereIn('username', $accounts)
        ->pluck('username')
        ->toArray();

    $receiver->update([
        'accounts' => $validUsers
    ]);

    return back(); // ← INI YANG BENAR
}
}
