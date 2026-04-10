<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function dashboard(Request $request)
{
    $query = State::with('direktur');

    // 🔍 SEARCH (negara + direktur)
    if ($request->search) {
    $search = $request->search;

    $query->where(function ($q) use ($search) {
        $q->where('state_name', 'like', $search . '%') 
          ->orWhereHas('direktur', function ($q2) use ($search) {
              $q2->where('nama', 'like', $search . '%');
          });
    });
}

    // 🎛️ FILTER PART
    if ($request->part) {
        $query->where('council_part', $request->part);
    }

    // 🌍 FILTER REGION
    if ($request->region) {
        $query->where('icao_region', $request->region);
    }

    // 📊 FILTER DCTP
    if ($request->dctp) {
        $query->where('dctp_enum', $request->dctp);
    }

    $states = $query->get();

    return view('dashboard', compact('states'));
}

    // 🔍 Detail Negara
    public function show($id)
    {
        $state = State::with(['kerjasama', 'beasiswa', 'direktur'])
                      ->findOrFail($id);

        return view('states.show', compact('state'));
    }
}