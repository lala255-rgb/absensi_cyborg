<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            ->with('success', 'Absensi created successfully.');
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
            ->with('success', 'Absensi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(absensi $absensi)
    {
        $absensi->delete();

        return redirect()->route('absensis.index')
            ->with('success', 'Absensi deleted successfully');
    }

    /**
     * Show self absensi form
     */
    public function selfAbsen()
    {
        return view('absensis.self');
    }

    /**
     * Submit self absensi
     */
    public function submitSelfAbsen(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|string',
            ]);

            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            // Check if user already absent today
            $today = Carbon::today();
            $existingAbsensi = absensi::where('id_user', $user->id)
                ->whereDate('tanggal_dan_waktu', $today)
                ->first();

            if ($existingAbsensi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah absen hari ini'
                ], 400);
            }

            // Process image
            $image = $request->image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageData = base64_decode($image);

            if (!$imageData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gambar tidak valid'
                ], 400);
            }

            // Generate unique filename
            $fileName = 'absen_' . $user->id . '_' . Carbon::now()->format('Ymd_His') . '.png';
            $filePath = 'absensi/' . $fileName;
            
            // Save image
            $saved = Storage::disk('public')->put($filePath, $imageData);
            
            if (!$saved) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan foto'
                ], 500);
            }

            // Create absensi record
            $absensi = absensi::create([
                'id_user' => $user->id,
                'role_user' => $user->role ?? 'mahasiswa',
                'tanggal_dan_waktu' => Carbon::now(),
                'foto_absensi' => $fileName,
                'status' => 'Hadir',
                'keterangan' => 'Self Absensi via kamera',
                'created_by' => $user->name ?? 'system',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil disimpan',
                'data' => [
                    'id' => $absensi->id,
                    'filename' => $fileName,
                    'time' => $absensi->tanggal_dan_waktu->format('d/m/Y H:i:s')
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Self Absensi Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }
}