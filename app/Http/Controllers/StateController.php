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

        if ($request->search) {
            $terms = explode(' ', strtolower($request->search));

            $query->where(function ($q) use ($terms) {

                foreach ($terms as $term) {

                    $q->where(function ($sub) use ($term) {

                        $sub->whereRaw('LOWER(state_name) LIKE ?', [$term . '%']) // awal kalimat
                            ->orWhereRaw('LOWER(state_name) LIKE ?', ['% ' . $term . '%']) // awal kata
                            ->orWhereHas('direktur', function ($q2) use ($term) {
                                $q2->whereRaw('LOWER(nama) LIKE ?', [$term . '%'])
                                ->orWhereRaw('LOWER(nama) LIKE ?', ['% ' . $term . '%']);
                            });

                    });

                }

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

        $filters = $request->kemitraan ?? [];

        if (!empty($filters)) {

            // kalau ada "none" + lainnya → skip none
            if (in_array('none', $filters) && count($filters) > 1) {
                $filters = array_filter($filters, fn($f) => $f !== 'none');
            }

            foreach ($filters as $filter) {

                if ($filter === 'none') {
                    $query->whereDoesntHave('kerjasamas');
                    continue;
                }

                [$bentuk, $status] = explode('|', $filter);

                $query->whereHas('kerjasamas', function ($q) use ($bentuk, $status) {

                    $q->where('bentuk_kerjasama', $bentuk);

                    if ($status !== 'null') {
                        $q->where('status_penerimaan', $status);
                    }

                });
            }
        }


        if ($request->sort === 'kerjasama') {

    $query->withCount('kerjasamas')
          ->orderByDesc('kerjasamas_count');

} else {

    $query->orderBy('state_name');

}

        $states = $query
            ->orderBy('state_name')
            ->paginate(12)
            ->withQueryString();



            $kemitraanList = \DB::table('kerjasamas')
    ->select('bentuk_kerjasama', 'status_penerimaan')
    ->distinct()
    ->get()
    ->map(function ($item) {
        return [
    'value' => $item->bentuk_kerjasama . '|' . ($item->status_penerimaan ?? 'null'),

    'label' => $item->status_penerimaan
        ? $item->bentuk_kerjasama . ' (' . $item->status_penerimaan . ')'
        : $item->bentuk_kerjasama,
];
    });

        $aidememoire = Media::where('type', 'aidememoire')->first();
        $strategipencalonan = Media::where('type', 'strategipencalonan')->first();


        return view('dashboard', compact('states', 'kemitraanList', 'aidememoire', 'strategipencalonan'));
    }

    // 🔍 Detail Negara
    public function show($id)
    {
        $state = State::with(['kerjasamas', 'beasiswa', 'direktur'])
            ->findOrFail($id);

        return view('states.show', compact('state'));
    }
}
