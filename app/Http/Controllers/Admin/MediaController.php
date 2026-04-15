<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\IcaoOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $aidememoire = Media::where('type', 'aidememoire')->first();
        $astacita = Media::where('type', 'astacita')->first();
        $offices = IcaoOffice::latest()->get();

        return view('admin.media.index', compact(
            'aidememoire',
            'astacita',
            'offices'
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

    public function destroyOffice(IcaoOffice $office)
    {
        if ($office->photo && Storage::disk('public')->exists($office->photo)) {
            Storage::disk('public')->delete($office->photo);
        }

        $office->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function storeOffice(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('media', 'public');
        }

        IcaoOffice::create([
            'name' => $request->name,
            'position' => $request->position,
            'photo' => $path,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }
}