<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function dashboard(Request $request)
    {
       $query = State::with([
            'direktur',
            'kerjasamas' => function ($q) {
                $q->where('status', 'Aktif');
            }
        ]);

        // 🔍 SEARCH (negara + direktur)
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('state_name', 'like', $search.'%')
                    ->orWhereHas('direktur', function ($q2) use ($search) {
                        $q2->where('nama', 'like', $search.'%');
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
        if ($request->dctp == 'Sudah Menerima') {
            $query->where('dctp_status', 'Sudah Menerima');
        }

        if ($request->dctp == 'Penerima Potensial') {
            $query->where('dctp_status', 'Penerima Potensial');
        }

        if ($request->dctp == 'null') {
            $query->whereNull('dctp_status');
        }

        
        
        if ($request->kerjasama) {

    if ($request->kerjasama === 'none') {
        $query->whereDoesntHave('kerjasamas', function ($q) {
            $q->where('status', 'Aktif');
        });
    } 
    
    else {
        $query->whereHas('kerjasamas', function ($q) use ($request) {
            $q->where('bentuk_kerjasama', $request->kerjasama)
              ->where('status', 'Aktif');
        });
    }

}

        $states = $query
            ->orderBy('state_name')
            ->paginate(12)
            ->withQueryString();

        return view('dashboard', compact('states'));
    }

    // 🔍 Detail Negara
    public function show($id)
    {
        $state = State::with(['kerjasamas', 'beasiswa', 'direktur'])
            ->findOrFail($id);

        return view('states.show', compact('state'));
    }
}
