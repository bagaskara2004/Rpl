<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;
use App\Models\Assessment;
use App\Models\Pertanyaan;
use App\Models\Kurikulum;
use App\Models\TranskripNilai;
use Illuminate\Support\Facades\Auth;

class AssessorController extends Controller
{
    public function index()
    {
        return view('Assessor.pendaftar.index');
    }

    public function getData()
    {
        $dataDiri = DataDiri::with(['user', 'pendidikan'])->get();
        return response()->json($dataDiri);
    }

    public function getModalData($id)
    {
        $diri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])->findOrFail($id);
        return response()->json($diri);
    }

    public function getAssessmentModal($id)
    {

        $pertanyaan = Pertanyaan::all();

        $assessment = Assessment::where('user_id', $id)->get();
        return response()->json([
            'pertanyaan' => $pertanyaan,
            'assessment' => $assessment,
        ]);
    }

    public function transferNilai($id, Request $request)
    {
        $kurikulum = Kurikulum::all();
        $transkrip = TranskripNilai::where('user_id', $id)->get();

        
        if ($request->isMethod('post')) {
            $asesor_id = Auth::check() ? Auth::user()->id : 2; 
            $kurikulum_ids = $request->input('kurikulum', []);
            $nilai_trpl = $request->input('nilai_trpl', []);
            $keterangan = $request->input('keterangan', []);
            $transkrip_ids = $request->input('transkrip_id', []);

            foreach ($kurikulum_ids as $i => $kurikulum_id) {
                \App\Models\TransferNilai::create([
                    'asesor_id' => $asesor_id,
                    'kurikulum_id' => $kurikulum_id,
                    'transkrip_id' => $transkrip_ids[$i] ?? null,
                    'nilai' => $nilai_trpl[$i] ?? null,
                    'catatan' => $keterangan[$i] ?? null,
                    'status' => 1,
                ]);
            }
            return redirect()->route('assesor.index')->with('success', 'Data transfer nilai berhasil disimpan!');
        }

        return view('Assessor.pendaftar.transfer_nilai', [
            'id' => $id,
            'kurikulum' => $kurikulum,
            'transkrip' => $transkrip,
        ]);
    }
}
