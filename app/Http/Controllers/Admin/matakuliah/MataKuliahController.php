<?php

namespace App\Http\Controllers\Admin\matakuliah;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.MataKuliah.index');
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $mataKuliahData = MataKuliah::with(['kelas', 'dosen'])
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $mataKuliahData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'mata_kuliah' => $item->mata_kuliah,
                    'kelas' => $item->kelas ? $item->kelas->kelas : '-',
                    'dosen' => $item->dosen ? $item->dosen->name : '-',
                    'dosen_email' => $item->dosen ? $item->dosen->email : '-',
                    'semester' => $item->semester,
                    'tahun' => $item->tahun,
                    'kelas_id' => $item->kelas_id,
                    'dosen_id' => $item->dosen_id,
                    'created_at' => $item->created_at->format('d/m/Y H:i'),
                    'updated_at' => $item->updated_at->format('d/m/Y H:i')
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in MataKuliah getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get kelas options
     */
    public function getKelas()
    {
        try {
            $kelas = Kelas::orderBy('kelas', 'asc')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kelas' => $item->kelas
                ];
            });

            return response()->json($kelas);
        } catch (\Exception $e) {
            Log::error('Error in getKelas: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data kelas'], 500);
        }
    }

    /**
     * Get dosen options
     */
    public function getDosen()
    {
        try {
            // Ambil user yang memiliki role dosen
            $dosens = User::whereHas('role', function ($query) {
                $query->where('role_name', 'LIKE', '%dosen%')
                    ->orWhere('role_name', 'LIKE', '%teacher%')
                    ->orWhere('role_name', 'LIKE', '%lecturer%');
            })->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email
                ];
            });

            // Jika tidak ada dosen, ambil semua user sebagai fallback
            if ($dosens->isEmpty()) {
                $dosens = User::select('id', 'name', 'email')->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'email' => $item->email
                    ];
                });
            }

            return response()->json($dosens);
        } catch (\Exception $e) {
            Log::error('Error in getDosen: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data dosen'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:100',
            'kelas_id' => 'required|exists:kelas,id',
            'dosen_id' => 'required|exists:users,id',
            'semester' => 'required|string|max:10',
            'tahun' => 'required|string|max:10'
        ], [
            'mata_kuliah.required' => 'Nama mata kuliah harus diisi',
            'mata_kuliah.max' => 'Nama mata kuliah maksimal 100 karakter',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
            'dosen_id.required' => 'Dosen harus dipilih',
            'dosen_id.exists' => 'Dosen tidak valid',
            'semester.required' => 'Semester harus diisi',
            'semester.max' => 'Semester maksimal 10 karakter',
            'tahun.required' => 'Tahun harus diisi',
            'tahun.max' => 'Tahun maksimal 10 karakter'
        ]);

        try {
            $mataKuliah = MataKuliah::create($request->only([
                'mata_kuliah',
                'kelas_id',
                'dosen_id',
                'semester',
                'tahun'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil ditambahkan',
                'data' => $mataKuliah
            ]);
        } catch (\Exception $e) {
            Log::error('Error in MataKuliah store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $mataKuliah = MataKuliah::with(['kelas', 'dosen'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $mataKuliah->id,
                    'mata_kuliah' => $mataKuliah->mata_kuliah,
                    'kelas_id' => $mataKuliah->kelas_id,
                    'dosen_id' => $mataKuliah->dosen_id,
                    'semester' => $mataKuliah->semester,
                    'tahun' => $mataKuliah->tahun,
                    'kelas_name' => $mataKuliah->kelas ? $mataKuliah->kelas->kelas : '',
                    'dosen_name' => $mataKuliah->dosen ? $mataKuliah->dosen->name : '',
                    'dosen_email' => $mataKuliah->dosen ? $mataKuliah->dosen->email : ''
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in MataKuliah show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:100',
            'kelas_id' => 'required|exists:kelas,id',
            'dosen_id' => 'required|exists:users,id',
            'semester' => 'required|string|max:10',
            'tahun' => 'required|string|max:10'
        ], [
            'mata_kuliah.required' => 'Nama mata kuliah harus diisi',
            'mata_kuliah.max' => 'Nama mata kuliah maksimal 100 karakter',
            'kelas_id.required' => 'Kelas harus dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
            'dosen_id.required' => 'Dosen harus dipilih',
            'dosen_id.exists' => 'Dosen tidak valid',
            'semester.required' => 'Semester harus diisi',
            'semester.max' => 'Semester maksimal 10 karakter',
            'tahun.required' => 'Tahun harus diisi',
            'tahun.max' => 'Tahun maksimal 10 karakter'
        ]);

        try {
            $mataKuliah = MataKuliah::findOrFail($id);
            $mataKuliah->update($request->only([
                'mata_kuliah',
                'kelas_id',
                'dosen_id',
                'semester',
                'tahun'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil diperbarui',
                'data' => $mataKuliah
            ]);
        } catch (\Exception $e) {
            Log::error('Error in MataKuliah update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $mataKuliah = MataKuliah::findOrFail($id);

            // Check if mata kuliah has related pertemuan
            if ($mataKuliah->pertemuan()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mata kuliah tidak dapat dihapus karena masih memiliki data pertemuan'
                ], 422);
            }

            $mataKuliah->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in MataKuliah destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus mata kuliah: ' . $e->getMessage()
            ], 500);
        }
    }
}
