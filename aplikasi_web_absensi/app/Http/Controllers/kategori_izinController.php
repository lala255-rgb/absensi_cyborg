<?php

namespace App\Http\Controllers;

use App\Models\kategori_izin;
use Illuminate\Http\Request;

class kategori_izinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        kategori_izin::latest()->paginate(5);
        return view('kategori_izins.index', compact('kategori_izin'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('kategori_izins.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required',
        ]);

        kategori_izin::create($request->all());

        return redirect()->route('kategori_izins.index')
            ->with('success', 'kategori created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori_izin $kategori_izin)
    {
        return view('kategori_izins.show', compact('kategori_izin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori_izin $kategori_izin)
    {
        return view('kategori_izins.edit', compact('kategori_izin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori_izin $kategori_izin)
    {
       $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required',
        ]);

        $kategori_izin->update($request->all());

        return redirect()->route('kategori_izins.index')
            ->with('success', 'kategori Izin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori_izin $kategori_izin)
    {
        $kategori_izin->delete();

        return redirect()->route('kategori_izins.index')
            ->with('success', 'kategori Izin deleted successfully');
    }
}
