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
            'state_name' => 'required',
        ]);

        State::create($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'State berhasil ditambahkan');
    }

    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    public function update(Request $request, State $state)
    {
        $state->update($request->all());

        return redirect()->route('admin.states.show', $state);
    }

    public function destroy(State $state)
    {
        $state->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}

