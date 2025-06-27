<?php

namespace App\Http\Controllers\Admin\pertanyaan;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PertanyaanControle extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.pertanyaan.index');
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $pertanyaan = Pertanyaan::orderBy('created_at', 'desc')->get();

            $data = $pertanyaan->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'pertanyaan' => $item->pertanyaan,
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
                'pertanyaan' => 'required|string|min:5|max:500',
            ], [
                'pertanyaan.required' => 'Pertanyaan wajib diisi',
                'pertanyaan.min' => 'Pertanyaan minimal 5 karakter',
                'pertanyaan.max' => 'Pertanyaan maksimal 500 karakter',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $pertanyaan = Pertanyaan::create([
                'pertanyaan' => $request->pertanyaan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan berhasil ditambahkan',
                'data' => $pertanyaan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah pertanyaan'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $pertanyaan
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
                'pertanyaan' => 'required|string|min:5|max:500',
            ], [
                'pertanyaan.required' => 'Pertanyaan wajib diisi',
                'pertanyaan.min' => 'Pertanyaan minimal 5 karakter',
                'pertanyaan.max' => 'Pertanyaan maksimal 500 karakter',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->update([
                'pertanyaan' => $request->pertanyaan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan berhasil diperbarui',
                'data' => $pertanyaan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pertanyaan'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pertanyaan'
            ], 500);
        }
    }
}
