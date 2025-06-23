<?php

namespace App\Http\Controllers\Admin\transkrip;

use App\Http\Controllers\Controller;
use App\Models\TranskripNilai;
use App\Models\User;
use Illuminate\Http\Request;

class TranskripControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Transkrip.index');
    }

    /**
     * Get transkrip data for AJAX
     */
    public function data()
    {
        $transkrips = TranskripNilai::with(['user'])
            ->select('id', 'user_id', 'mata_kuliah', 'sks', 'nilai_huruf', 'nilai_angka', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        $transkrips->transform(function ($transkrip) {
            $transkrip->user_name = $transkrip->user ? $transkrip->user->user_name : 'Unknown';
            $transkrip->user_email = $transkrip->user ? $transkrip->user->email : 'Unknown';
            $transkrip->grade = $transkrip->nilai_huruf; // Add compatibility field
            return $transkrip;
        });

        return response()->json($transkrips->values());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_kuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'nilai_huruf' => 'required|string|in:A,B,C,D,E',
            'nilai_angka' => 'nullable|integer|min:0|max:100'
        ]);

        TranskripNilai::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transkrip nilai berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TranskripNilai $transkripNilai)
    {
        $transkripNilai->load('user');
        return response()->json($transkripNilai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TranskripNilai $transkripNilai)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'nilai_huruf' => 'required|string|in:A,B,C,D,E',
            'nilai_angka' => 'nullable|integer|min:0|max:100'
        ]);

        $transkripNilai->update($request->only(['mata_kuliah', 'sks', 'nilai_huruf', 'nilai_angka']));

        return response()->json([
            'success' => true,
            'message' => 'Transkrip nilai berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TranskripNilai $transkripNilai)
    {
        try {
            $transkripNilai->delete();

            return response()->json([
                'success' => true,
                'message' => 'Transkrip nilai berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus transkrip nilai: ' . $e->getMessage()
            ], 500);
        }
    }
}
