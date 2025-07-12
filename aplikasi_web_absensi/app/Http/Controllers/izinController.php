<?php

namespace App\Http\Controllers;

use App\Models\izin;
use Illuminate\Http\Request;

class izinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        izin::latest()->paginate(5);
        return view('izins.index', compact('izin'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('izins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_izin' => 'required',
            'id_user' => 'required',
            'deskripsi_izin' => 'required',
            'status' => 'required',
            'surat_keterangan_sakit' => 'nullable',
            'created_by' => 'required',
        ]);

        izin::create($request->all());

        return redirect()->route('izins.index')
            ->with('success', 'izin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(izin $izin)
    {
        return view('izins.show', compact('izin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(izin $izin)
    {
        return view('izins.edit', compact('izin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, izin $izin)
    {
        $request->validate([
            'id_kategori_izin' => 'required',
            'id_user' => 'required',
            'deskripsi_izin' => 'required',
            'status' => 'required',
            'surat_keterangan_sakit' => 'nullable',
            'created_by' => 'required',
        ]);

        $izin->update($request->all());

        return redirect()->route('izins.index')
            ->with('success', 'Izin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(izin $izin)
    {
        $izin->delete();

        return redirect()->route('izins.index')
            ->with('success', 'Izin deleted successfully');
    }
}
