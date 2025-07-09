<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;

class absensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $absensi = absensi::latest()->paginate(5);
        
       return view('absensis.index', compact('absensi'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('absensis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'role_user' => 'required',
            'tanggal_dan_waktu' => 'required',
            'foto_absensi' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required',
        ]);
        absensi::create($request->all());

        return redirect()->route('absensis.index')
            ->with('success', 'absensi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(absensi $absensi)
    {
        return view('absensis.show', compact('absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(absensi $absensi)
    {
         return view('absensis.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, absensi $absensi)
    {
         $request->validate([  
            'id_user' => 'required',
            'role_user' => 'required',
            'tanggal_dan_waktu' => 'required|date_format:Y-m-d',
            'jurusan' => 'required',
            'foto_absensi' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required', 
        ]); 
     
        $absensi->update($request->all()); 
     
        return redirect()->route('absensis.index') 
                        ->with('success','Absensi updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(absensi $absensi)
    {
         $absensi->delete();

        return redirect()->route('absensis.index')
            ->with('success', 'absensi deleted successfully');
    }
}
