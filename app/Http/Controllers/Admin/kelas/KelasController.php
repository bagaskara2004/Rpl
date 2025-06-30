<?php

namespace App\Http\Controllers\Admin\kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Kelas.index');
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $kelasData = Kelas::orderBy('created_at', 'desc')->get();

            $data = $kelasData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'kelas' => $item->kelas,
                    'tahun' => date('Y', strtotime($item->created_at)) . '/' . (date('Y', strtotime($item->created_at)) + 1),
                    'created_at' => $item->created_at->format('d/m/Y H:i'),
                    'updated_at' => $item->updated_at->format('d/m/Y H:i')
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in Kelas getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:20|unique:kelas,kelas'
        ], [
            'kelas.required' => 'Nama kelas harus diisi',
            'kelas.max' => 'Nama kelas maksimal 20 karakter',
            'kelas.unique' => 'Nama kelas sudah ada'
        ]);

        try {
            $kelas = Kelas::create($request->only('kelas'));

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil ditambahkan',
                'data' => $kelas
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Kelas store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah kelas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $kelas
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Kelas show: ' . $e->getMessage());
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
            'kelas' => 'required|string|max:20|unique:kelas,kelas,' . $id
        ], [
            'kelas.required' => 'Nama kelas harus diisi',
            'kelas.max' => 'Nama kelas maksimal 20 karakter',
            'kelas.unique' => 'Nama kelas sudah ada'
        ]);

        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update($request->only('kelas'));

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil diperbarui',
                'data' => $kelas
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Kelas update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kelas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Kelas destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kelas: ' . $e->getMessage()
            ], 500);
        }
    }
}
