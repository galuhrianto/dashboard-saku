<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kerjasama;
use App\Models\State;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index()
    {
        
    $kerjasamas = Kerjasama::with('state')
            ->latest()
            ->paginate(10);

        return view('admin.kerjasama.index', compact('kerjasamas'));
    }

    public function create()
    {
        $states = State::orderBy('state_name')->get();
        return view('admin.kerjasama.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'bentuk_kerjasama' => 'required',
            'status' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        Kerjasama::create($request->all());

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Kerjasama $kerjasama)
    {
        $states = State::orderBy('state_name')->get();
        return view('admin.kerjasama.edit', compact('kerjasama', 'states'));
    }

    public function update(Request $request, Kerjasama $kerjasama)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'bentuk_kerjasama' => 'required',
            'status' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        $kerjasama->update($request->all());

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Kerjasama $kerjasama)
    {
        $kerjasama->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}