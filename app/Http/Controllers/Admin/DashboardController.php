<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Kerjasama;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStates = State::count();

        $totalDctp = State::whereNotNull('dctp_status')->count();

        $dctpSudah = State::where('dctp_status', 'Sudah Menerima')->count();
        $dctpPotensial = State::where('dctp_status', 'Penerima Potensial')->count();
        $dctpBelum = State::whereNull('dctp_status')->count();

        $totalASA = Kerjasama::where('bentuk_kerjasama', 'ASA')->count();

        $states = State::with('kerjasamas')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalStates',
            'totalDctp',
            'dctpSudah',
            'dctpPotensial',
            'dctpBelum',
            'totalASA',
            'states'
        ));
    }
}