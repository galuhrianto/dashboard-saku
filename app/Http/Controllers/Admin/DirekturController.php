<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direktur;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirekturController extends Controller
{
    public function store(Request $request, State $state)
{
    $request->validate([
        'nama' => 'required',
        'jabatan' => 'nullable',
        'masa_jabatan' => 'nullable',
        'kontak' => 'nullable',
        'photo' => 'nullable|image|max:2048',
    ]);

    $dir = $state->direktur; // bisa null atau existing

    $data = [
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'masa_jabatan' => $request->masa_jabatan,
        'kontak' => $request->kontak,
    ];

    // kalau upload foto baru
    if ($request->hasFile('photo')) {

        // hapus foto lama
        if ($dir && $dir->photo && Storage::disk('public')->exists($dir->photo)) {
            Storage::disk('public')->delete($dir->photo);
        }

        $data['photo'] = $request->file('photo')->store('direktur', 'public');
    }

    \App\Models\Direktur::updateOrCreate(
        ['state_id' => $state->id],
        $data
    );

    return back()->with('success', 'Direktur berhasil disimpan');
}

    public function destroy(Direktur $direktur)
    {
        if ($direktur->photo && \Storage::disk('public')->exists($direktur->photo)) {
            \Storage::disk('public')->delete($direktur->photo);
        }

        $direktur->delete();

        return back()->with('success', 'Direktur berhasil dihapus');
    }
}