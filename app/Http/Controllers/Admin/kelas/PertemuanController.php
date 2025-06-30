<?php

namespace App\Http\Controllers\Admin\kelas;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        return view('Admin.Kelas.pertemuan', compact('kelas'));
    }

    /**
     * Get data for DataTable
     */
    public function getData($kelasId)
    {
        try {
            $pertemuanData = DB::table('pertemuan')
                ->join('mata_kuliah', 'pertemuan.mata_kuliah_id', '=', 'mata_kuliah.id')
                ->join('users as dosen', 'mata_kuliah.dosen_id', '=', 'dosen.id')
                ->where('pertemuan.kelas_id', $kelasId)
                ->select(
                    'pertemuan.id',
                    'pertemuan.nama_pertemuan',
                    'pertemuan.tanggal',
                    'mata_kuliah.mata_kuliah',
                    'mata_kuliah.semester',
                    'dosen.user_name as dosen_name',
                    'pertemuan.created_at'
                )
                ->orderBy('pertemuan.tanggal', 'desc')
                ->get();

            $data = $pertemuanData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'nama_pertemuan' => $item->nama_pertemuan,
                    'mata_kuliah' => $item->mata_kuliah,
                    'semester' => $item->semester,
                    'dosen_name' => $item->dosen_name,
                    'tanggal' => date('d/m/Y', strtotime($item->tanggal)),
                    'created_at' => date('d/m/Y H:i', strtotime($item->created_at))
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in Pertemuan getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get mata kuliah for dropdown
     */
    public function getMataKuliah($kelasId)
    {
        try {
            $mataKuliah = MataKuliah::with('dosen')
                ->where('kelas_id', $kelasId)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'mata_kuliah' => $item->mata_kuliah,
                        'semester' => $item->semester,
                        'dosen_name' => $item->dosen->user_name ?? 'Tidak ada'
                    ];
                });

            return response()->json($mataKuliah);
        } catch (\Exception $e) {
            Log::error('Error in getMataKuliah: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat mata kuliah'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kelasId)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'nama_pertemuan' => 'required|string|max:255',
            'tanggal' => 'required|date'
        ], [
            'mata_kuliah_id.required' => 'Mata kuliah harus dipilih',
            'mata_kuliah_id.exists' => 'Mata kuliah tidak valid',
            'nama_pertemuan.required' => 'Nama pertemuan harus diisi',
            'nama_pertemuan.max' => 'Nama pertemuan maksimal 255 karakter',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid'
        ]);

        try {
            $pertemuan = Pertemuan::create([
                'kelas_id' => $kelasId,
                'mata_kuliah_id' => $request->mata_kuliah_id,
                'nama_pertemuan' => $request->nama_pertemuan,
                'tanggal' => $request->tanggal
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pertemuan berhasil ditambahkan',
                'data' => $pertemuan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Pertemuan store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah pertemuan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($kelasId, $id)
    {
        try {
            $pertemuan = DB::table('pertemuan')
                ->join('mata_kuliah', 'pertemuan.mata_kuliah_id', '=', 'mata_kuliah.id')
                ->join('users as dosen', 'mata_kuliah.dosen_id', '=', 'dosen.id')
                ->where('pertemuan.id', $id)
                ->where('pertemuan.kelas_id', $kelasId)
                ->select(
                    'pertemuan.*',
                    'mata_kuliah.mata_kuliah',
                    'mata_kuliah.semester',
                    'dosen.user_name as dosen_name'
                )
                ->first();

            if (!$pertemuan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $pertemuan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Pertemuan show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kelasId, $id)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'nama_pertemuan' => 'required|string|max:255',
            'tanggal' => 'required|date'
        ], [
            'mata_kuliah_id.required' => 'Mata kuliah harus dipilih',
            'mata_kuliah_id.exists' => 'Mata kuliah tidak valid',
            'nama_pertemuan.required' => 'Nama pertemuan harus diisi',
            'nama_pertemuan.max' => 'Nama pertemuan maksimal 255 karakter',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid'
        ]);

        try {
            $pertemuan = Pertemuan::where('id', $id)
                ->where('kelas_id', $kelasId)
                ->firstOrFail();

            $pertemuan->update($request->only(['mata_kuliah_id', 'nama_pertemuan', 'tanggal']));

            return response()->json([
                'success' => true,
                'message' => 'Pertemuan berhasil diperbarui',
                'data' => $pertemuan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Pertemuan update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pertemuan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kelasId, $id)
    {
        try {
            $pertemuan = Pertemuan::where('id', $id)
                ->where('kelas_id', $kelasId)
                ->firstOrFail();

            $pertemuan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pertemuan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Pertemuan destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pertemuan: ' . $e->getMessage()
            ], 500);
        }
    }
}
