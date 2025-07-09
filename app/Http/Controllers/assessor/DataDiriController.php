<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\User;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $dataDiri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])
                ->findOrFail($id);

            return view('Assessor.pendaftar.datadiri', compact('dataDiri'));
        } catch (\Exception $e) {
            return redirect()->route('assesor.pendaftar')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Update status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:prosess,sukses,pending,gagal'
            ]);

            $dataDiri = DataDiri::findOrFail($id);
            $dataDiri->update(['status' => $request->status]);

            $statusLabels = [
                'prosess' => 'Proses',
                'sukses' => 'Sukses',
                'pending' => 'Pending',
                'gagal' => 'Gagal'
            ];

            return redirect()->back()->with('success', 'Status berhasil diubah menjadi: ' . $statusLabels[$request->status]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengubah status. Silakan coba lagi.');
        }
    }
}
