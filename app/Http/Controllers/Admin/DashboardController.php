<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Kerjasama;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $totalStates = State::count();
    $totalKerjasamas = Kerjasama::count(); 

    $query = State::with('kerjasamas');

    if ($request->search) {
        $query->where('state_name', 'like', $request->search . '%');
    }

    $states = $query->latest()->paginate(10)->withQueryString();

    return view('admin.dashboard', compact(
        'totalStates',
        'totalKerjasamas', 
        'states'
    ));
}

    
}