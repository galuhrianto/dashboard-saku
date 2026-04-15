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


        $states = State::with('kerjasamas')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalStates',
            'states'
        ));
    }
}