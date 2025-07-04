<?php

namespace App\Http\Controllers\Admin\datadiri;

use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\User;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['dataDiri', 'pendidikan', 'pengalamanKerja'])
            ->where('role_id', 1)
            ->whereHas('dataDiri')
            ->orderBy('created_at', 'desc')
            ->get();

        // Pastikan $users tidak null
        if ($users === null) {
            $users = collect([]);
        }

        return view('Admin.DataDiri.index', compact('users'));
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $dataDiri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $dataDiri->map(function ($item) {
                return [
                    'id' => $item->id,
                    'user_id' => $item->user_id,
                    'nama_lengkap' => $item->nama_lengkap ?? 'Belum diisi',
                    'email' => $item->email ?? $item->user->email ?? 'Belum diisi',
                    'jurusan' => $item->pendidikan->jurusan ?? 'Belum diisi',
                    'prodi' => $item->pendidikan->prodi ?? 'Belum diisi',
                    'created_at' => $item->created_at->format('d/m/Y'),
                    'status' => $item->status ?? 'pending'
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = User::with(['dataDiri', 'pendidikan', 'pengalamanKerja'])
                ->findOrFail($id);

            return view('Admin.DataDiri.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('admin.datadiri.index')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataDiri $dataDiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataDiri $dataDiri)
    {
        //
    }
}
