<?php

namespace App\Http\Controllers\Admin\assessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Pertanyaan;
use App\Models\DataDiri;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function getAssessmentModal($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User tidak ditemukan'], 404);
            }

            $assessment = Assessment::where('user_id', $id)->first();
            $pertanyaan = Pertanyaan::all();

            $html = view('admin.pendaftar.assessment_modal', compact('user', 'assessment', 'pertanyaan'))->render();
            
            return response()->json([
                'html' => $html,
                'assessment' => $assessment
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data assessment'], 500);
        }
    }

    public function showAsesmen($id)
    {
        try {
            $user = User::with(['dataDiri', 'pendidikan'])->findOrFail($id);
            $assessment = Assessment::where('user_id', $id)->first();
            $pertanyaan = Pertanyaan::all();

            return view('admin.pendaftar.asesment', compact('user', 'assessment', 'pertanyaan'));
        } catch (\Exception $e) {
            return redirect()->route('admin.pendaftar.index')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    public function updateStatus(Request $request, $userId)
    {
        try {
            $request->validate([
                'status' => 'required|in:0,1',
                'jawaban' => 'required|array',
                'jawaban.*' => 'required|string'
            ]);

            // Check if assessment already exists
            $assessment = Assessment::where('user_id', $userId)->first();
            
            if ($assessment) {
                // Update existing assessment
                $assessment->update([
                    'status' => $request->status,
                    'jawaban' => json_encode($request->jawaban)
                ]);
            } else {
                // Create new assessment
                Assessment::create([
                    'user_id' => $userId,
                    'status' => $request->status,
                    'jawaban' => json_encode($request->jawaban)
                ]);
            }

            $statusText = $request->status == 1 ? 'Lulus' : 'Tidak Lulus';
            
            return response()->json([
                'success' => true,
                'message' => "Status assessment berhasil diubah menjadi: {$statusText}"
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status assessment: ' . $e->getMessage()
            ], 500);
        }
    }
}
