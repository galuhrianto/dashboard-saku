<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direktur;

class DirekturController extends Controller
{
    public function index()
    {
        $direkturs = \App\Models\Direktur::with('state')->get();

        return view('directors.index', compact('direkturs')); 
    }

    public function show($id)
{
    $direkturs = \App\Models\Direktur::with('state')
        ->where('state_id', $id)
        ->get();

    return view('directors.show', compact('direkturs'));
}
}
