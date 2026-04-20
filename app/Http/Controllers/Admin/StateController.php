<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function show(State $state)
    {
        $state->load(['kerjasamas', 'direktur']);

        return view('admin.states.show', compact('state'));
    }

        public function create()
    {
        return view('admin.states.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'state_name' => 'required|string|max:255|unique:states,state_name',
            'country_code' => 'nullable|string|max:2',
        ], [
        'state_name.required' => 'Nama negara wajib diisi',
        'country_code.max'   => 'Kode negara harus 2 huruf',
    ]);

    State::create($validated);

    return redirect()
        ->route('admin.dashboard')
        ->with('success', 'State berhasil ditambahkan');
}

    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    public function update(Request $request, State $state)
{
    $validated = $request->validate([
        'state_name' => 'required|string|max:255',

        'country_code' => 'nullable|string|max:2',
        'capital_city' => 'nullable|string|max:255',
        'icao_region' => 'nullable|string|max:255',
        'icao_regional_office' => 'nullable|string|max:255',
        'rep_in_council' => 'nullable|string|max:255',
        'vote_probability_indonesia' => 'nullable|string|max:255',

        'council_part' => 'nullable|integer',

        'posisi_2016' => 'nullable|string|max:255',
        'posisi_2013' => 'nullable|string|max:255',

        'informasi_umum' => 'nullable|string',
        'deskripsi' => 'nullable|string',

        'dialing_code' => 'nullable|string|max:20',
        'currency' => 'nullable|string|max:100',
        'population' => 'nullable|string|max:100',
        'leader' => 'nullable|string|max:255',
        'official_languages' => 'nullable|string|max:255',
        'points_of_interest' => 'nullable|string',
        'university' => 'nullable|string|max:255',

        'additional_info' => 'nullable|array',
    ]);

    $state->update($validated);

    return redirect()
        ->route('admin.dashboard', $state)
        ->with('success', 'Data negara berhasil diperbarui');
}

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('admin.dashboard')
    ->with('success', 'Data berhasil dihapus');
    }
}

