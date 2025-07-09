<?php

namespace App\Http\Controllers;

use App\Models\mentor;
use Illuminate\Http\Request;

class mentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $mentors= mentor::latest()->paginate(5);
        
        return view('mentors.index', compact('mentors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mentors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nohp' => 'required',
            'tanggal_dan_waktu' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'foto' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required',
        ]);
        mentor::create($request->all());

        return redirect()->route('mentors.index')
            ->with('success', 'mentor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(mentor $mentor)
    {
        return view('mentors.show', compact('mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mentor $mentor)
    {
        return view('mentors.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mentor $mentor)
    {
        $request->validate([  
            'nama' => 'required',
            'nohp' => 'required',
            'tanggal_dan_waktu' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'foto' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required', 
        ]); 
     
        $mentor->update($request->all()); 
     
        return redirect()->route('mentors.index') 
                        ->with('success','Mentor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mentor $mentor)
    {
        $mentor->delete();

        return redirect()->route('mentors.index')
            ->with('success', 'Mentor deleted successfully');
    }
}
