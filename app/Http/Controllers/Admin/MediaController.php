<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $aidememoire = Media::where('type', 'aidememoire')->first();
        $astacita = Media::where('type', 'astacita')->first();
        $strategipencalonan = Media::where('type', 'strategipencalonan')->first();
        

        return view('admin.media.index', compact(
            'aidememoire',
            'astacita',
            'strategipencalonan',
        
        ));
    }

    public function uploadAidememoire(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        'title' => 'nullable|string|max:255',
    ]);

    $old = Media::where('type', 'aidememoire')->first();

    if ($old && Storage::disk('public')->exists($old->file_path)) {
        Storage::disk('public')->delete($old->file_path);
    }

    $path = $request->file('file')->store('media', 'public');

    Media::updateOrCreate(
        ['type' => 'aidememoire'],
        [
            'file_path' => $path,
            'title' => $request->title,
        ]
    );

    return back()->with('success', 'Aidememoire berhasil diupload');
}

    public function uploadAstaCita(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048',
        'title' => 'nullable|string|max:255',
    ]);

    $old = Media::where('type', 'astacita')->first();

    if ($old && Storage::disk('public')->exists($old->file_path)) {
        Storage::disk('public')->delete($old->file_path);
    }
    
    $path = $request->file('image')->store('media', 'public');

    Media::updateOrCreate(
        ['type' => 'astacita'],
        [
            'file_path' => $path,
            'title' => $request->title,
        ]
    );

    return back()->with('success', 'Asta Cita berhasil diupload');
}

public function uploadStrategipencalonan(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        'title' => 'nullable|string|max:255',
    ]);

    $old = Media::where('type', 'strategipencalonan')->first();

    if ($old && Storage::disk('public')->exists($old->file_path)) {
        Storage::disk('public')->delete($old->file_path);
    }

    $path = $request->file('file')->store('media', 'public');

    Media::updateOrCreate(
        ['type' => 'strategipencalonan'],
        [
            'file_path' => $path,
            'title' => $request->title,
        ]
    );

    return back()->with('success', 'Strategi Pencalonan berhasil diupload');
}

    
}