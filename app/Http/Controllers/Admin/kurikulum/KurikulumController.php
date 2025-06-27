<?php

namespace App\Http\Controllers\Admin\kurikulum;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.kurikulum.index');
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $kurikulum = Kurikulum::orderBy('created_at', 'desc')->get();

            $data = $kurikulum->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'mata_kuliah_trpl' => $item->mata_kuliah_trpl,
                    'sks' => $item->sks,
                    'created_at' => $item->created_at->format('d/m/Y'),
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mata_kuliah_trpl' => 'required|string|min:3|max:100',
                'sks' => 'required|integer|min:1|max:6',
            ], [
                'mata_kuliah_trpl.required' => 'Mata kuliah wajib diisi',
                'mata_kuliah_trpl.min' => 'Mata kuliah minimal 3 karakter',
                'mata_kuliah_trpl.max' => 'Mata kuliah maksimal 100 karakter',
                'sks.required' => 'SKS wajib diisi',
                'sks.integer' => 'SKS harus berupa angka',
                'sks.min' => 'SKS minimal 1',
                'sks.max' => 'SKS maksimal 6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $kurikulum = Kurikulum::create([
                'mata_kuliah_trpl' => $request->mata_kuliah_trpl,
                'sks' => $request->sks
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kurikulum berhasil ditambahkan',
                'data' => $kurikulum
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah kurikulum'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kurikulum = Kurikulum::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $kurikulum
            ]);
        } catch (\Exception $e) {
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
        try {
            $validator = Validator::make($request->all(), [
                'mata_kuliah_trpl' => 'required|string|min:3|max:100',
                'sks' => 'required|integer|min:1|max:6',
            ], [
                'mata_kuliah_trpl.required' => 'Mata kuliah wajib diisi',
                'mata_kuliah_trpl.min' => 'Mata kuliah minimal 3 karakter',
                'mata_kuliah_trpl.max' => 'Mata kuliah maksimal 100 karakter',
                'sks.required' => 'SKS wajib diisi',
                'sks.integer' => 'SKS harus berupa angka',
                'sks.min' => 'SKS minimal 1',
                'sks.max' => 'SKS maksimal 6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $kurikulum = Kurikulum::findOrFail($id);
            $kurikulum->update([
                'mata_kuliah_trpl' => $request->mata_kuliah_trpl,
                'sks' => $request->sks
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kurikulum berhasil diperbarui',
                'data' => $kurikulum
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kurikulum'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kurikulum = Kurikulum::findOrFail($id);
            $kurikulum->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kurikulum berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kurikulum'
            ], 500);
        }
    }
}
