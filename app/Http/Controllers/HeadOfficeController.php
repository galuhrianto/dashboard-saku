<?php

namespace App\Http\Controllers;

use App\Models\HeadOffice;
use App\Http\Requests\StoreHeadOfficeRequest;
use App\Http\Requests\UpdateHeadOfficeRequest;
use Illuminate\Support\Facades\Storage;

class HeadOfficeController extends Controller
{
    public function index()
    {
        // Ambil data dari root (pucuk pimpinan) beserta seluruh bawahannya
        $tree = HeadOffice::whereNull('parent_id')->with('children')->get();
        return view('admin.head_offices.index', compact('tree'));
    }

    public function create()
    {
        $parents = HeadOffice::all();
        return view('admin.head_offices.create', compact('parents'));
    }

    public function store(StoreHeadOfficeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos/head_offices', 'public');
        }

        HeadOffice::create($data);

        return redirect()->route('admin.head_offices.index')->with('success', 'Data struktur organisasi berhasil ditambahkan.');
    }

    public function edit(HeadOffice $headOffice)
    {
        // Tampilkan pilihan parent, tapi kecualikan dirinya sendiri agar tidak circular
        $parents = HeadOffice::where('id', '!=', $headOffice->id)->get();
        return view('admin.head_offices.edit', compact('headOffice', 'parents'));
    }

    public function update(UpdateHeadOfficeRequest $request, HeadOffice $headOffice)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($headOffice->photo && Storage::disk('public')->exists($headOffice->photo)) {
                Storage::disk('public')->delete($headOffice->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos/head_offices', 'public');
        }

        $headOffice->update($data);

        return redirect()->route('admin.head_offices.index')->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }

    public function destroy(HeadOffice $headOffice)
    {
        // Hapus foto fisik jika ada
        if ($headOffice->photo && Storage::disk('public')->exists($headOffice->photo)) {
            Storage::disk('public')->delete($headOffice->photo);
        }

        $headOffice->delete();

        return redirect()->route('admin.head_offices.index')->with('success', 'Data berhasil dihapus.');
    }
}
