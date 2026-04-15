<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Media;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function dashboard(Request $request)
    {
       $query = State::with([
            'direktur',
            'kerjasamas'
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

        if ($request->kemitraan) {

    // 👉 Belum ada kerjasama
    if ($request->kemitraan === 'none') {
        $query->whereDoesntHave('kerjasamas');
    } 
    else {

        [$bentuk, $status] = explode('|', $request->kemitraan);

        $query->whereHas('kerjasamas', function ($q) use ($bentuk, $status) {
            $q->where('bentuk_kerjasama', $bentuk);

            if ($status !== 'null') {
                $q->where('status', $status);
            }
        });
    }
}



        $states = $query
            ->orderBy('state_name')
            ->paginate(12)
            ->withQueryString();



            $kemitraanList = \DB::table('kerjasamas')
    ->select('bentuk_kerjasama', 'status')
    ->distinct()
    ->get()
    ->map(function ($item) {
        return [
            'value' => $item->status
    ? $item->bentuk_kerjasama . '|' . $item->status
    : $item->bentuk_kerjasama . '|null',
            'label' => $item->status
    ? $item->bentuk_kerjasama . ' - ' . $item->status
    : $item->bentuk_kerjasama,
        ];
    });

        $aidememoire = Media::where('type', 'aidememoire')->first();


        return view('dashboard', compact('states', 'kemitraanList', 'aidememoire'));
    }

    // 🔍 Detail Negara
    public function show($id)
    {
        $state = State::with(['kerjasamas', 'beasiswa', 'direktur'])
            ->findOrFail($id);

        return view('states.show', compact('state'));
    }
}
