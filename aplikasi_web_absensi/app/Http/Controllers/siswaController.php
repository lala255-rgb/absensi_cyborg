<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = siswa::latest()->paginate(5);

        return view('siswas.index', compact('siswas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'asal_kampus' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'nohp_orangtua' => 'required',
            'foto' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/fotos'), $fotoName);
        }
        siswa::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_kampus' => $request->asal_kampus,
            'jurusan' => $request->jurusan,
            'semester' => $request->semester,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'nohp_orangtua' => $request->nohp_orangtua,
            'foto' => $fotoName, // Set foto name atau null
            'keterangan' => $request->keterangan,
            'created_by' => 'lala', // Set nilai default
        ]);

        return redirect()->route('siswas.index')
            ->with('success', 'Siswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswas.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswas.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'asal_kampus' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'nohp_orangtua' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable',
        ]);

        $data = $request->all();

        // Cek jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/fotos'), $fotoName);
            $data['foto'] = $fotoName;
        }

        $siswa->update($data);

        return redirect()->route('siswas.index')
            ->with('success', 'Siswa updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $siswa = Siswa::where('id', $id)->firstOrFail();
            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Siswa deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student: ' . $e->getMessage()
            ], 500);
        }
    }
}
