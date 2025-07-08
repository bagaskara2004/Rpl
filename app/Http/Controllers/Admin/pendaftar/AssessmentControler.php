<?php

namespace App\Http\Controllers\assessor\assessment;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Pertanyaan;
use App\Models\DataDiri;
use Illuminate\Http\Request;

class AssessmentControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessment $assessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        //
    }

    /**
     * Get assessment modal data for a specific user.
     */
    public function getAssessmentModal($id)
    {
        $pertanyaan = Pertanyaan::all();
        $assessment = Assessment::where('user_id', $id)->get();

        return response()->json([
            'pertanyaan' => $pertanyaan,
            'assessment' => $assessment,
        ]);
    }

    /**
     * Show assessment page for a specific user.
     */
    public function showAsesmen($id)
    {
        // Validasi ID
        if (!$id || !is_numeric($id)) {
            return redirect()->route('assesor.index')->with('error', 'ID tidak valid');
        }

        // Ambil data pendaftar
        $dataDiri = DataDiri::with(['user', 'pendidikan'])->find($id);

        if (!$dataDiri) {
            return redirect()->route('assesor.index')->with('error', 'Data pendaftar tidak ditemukan');
        }

        // Ambil semua pertanyaan
        $pertanyaan = Pertanyaan::all();

        // Ambil assessment yang sudah dijawab user
        $assessment = Assessment::where('user_id', $id)->get();

        return view('Assessor.pendaftar.asesment', compact('dataDiri', 'pertanyaan', 'assessment'));
    }

    /**
     * Update status for all assessments of a specific user.
     */
    public function updateStatus(Request $request, $userId)
    {
        $request->validate([
            'status' => 'required|in:prosess,sukses,pending,gagal'
        ]);

        try {
            // Update all assessments for this user
            $updated = Assessment::where('user_id', $userId)
                ->update(['status' => $request->status]);

            // If AJAX request, return JSON
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status asesmen berhasil diperbarui',
                    'updated_count' => $updated
                ]);
            }

            // For regular form submission, redirect back with success message
            return redirect()->back()->with('success', 'Status asesmen berhasil diperbarui');
        } catch (\Exception $e) {
            // If AJAX request, return JSON error
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui status asesmen: ' . $e->getMessage()
                ], 500);
            }

            // For regular form submission, redirect back with error message
            return redirect()->back()->with('error', 'Gagal memperbarui status asesmen: ' . $e->getMessage());
        }
    }
}
