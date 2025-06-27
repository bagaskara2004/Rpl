<?php

namespace App\Http\Controllers\Admin\kelas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource for specific pertemuan.
     */
    public function index($pertemuan_id)
    {
        try {
            $pertemuan = Pertemuan::with(['kelas', 'mataKuliah.dosen'])
                ->findOrFail($pertemuan_id);

            return view('Admin.Kelas.absensi', compact('pertemuan'));
        } catch (\Exception $e) {
            Log::error('Error in Absensi index: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Pertemuan tidak ditemukan');
        }
    }

    /**
     * Get data for DataTable
     */
    public function getData($pertemuan_id)
    {
        try {
            $absensiData = Absensi::with(['user', 'pertemuan'])
                ->where('pertemuan_id', $pertemuan_id)
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $absensiData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'user_name' => $item->user ? $item->user->name : '-',
                    'user_email' => $item->user ? $item->user->email : '-',
                    'status' => $item->status,
                    'tanggal_absen' => $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-',
                    'user_id' => $item->user_id,
                    'pertemuan_id' => $item->pertemuan_id
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in Absensi getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get users options for specific pertemuan (students only)
     */
    public function getUsers()
    {
        try {
            $users = User::whereHas('role', function ($query) {
                $query->where('role_name', 'LIKE', '%student%')
                    ->orWhere('role_name', 'LIKE', '%mahasiswa%')
                    ->orWhere('role_name', 'LIKE', '%siswa%');
            })->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email
                ];
            });

            // Jika tidak ada user dengan role student, ambil semua user
            if ($users->isEmpty()) {
                $users = User::select('id', 'name', 'email')->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'email' => $item->email
                    ];
                });
            }

            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('Error in getUsers: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data user'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertemuan_id' => 'required|exists:pertemuan,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha'
        ], [
            'pertemuan_id.required' => 'Pertemuan harus dipilih',
            'pertemuan_id.exists' => 'Pertemuan tidak valid',
            'user_id.required' => 'User harus dipilih',
            'user_id.exists' => 'User tidak valid',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus salah satu: Hadir, Izin, Sakit, Alpha'
        ]);

        try {
            // Check if user already has attendance for this pertemuan
            $existingAbsensi = Absensi::where('user_id', $request->user_id)
                ->where('pertemuan_id', $request->pertemuan_id)
                ->first();

            if ($existingAbsensi) {
                return response()->json([
                    'success' => false,
                    'message' => 'User sudah memiliki absensi untuk pertemuan ini'
                ], 422);
            }

            $absensi = Absensi::create($request->only([
                'pertemuan_id',
                'user_id',
                'status'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil ditambahkan',
                'data' => $absensi
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Absensi store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah absensi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $absensi = Absensi::with(['user', 'pertemuan'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $absensi->id,
                    'user_id' => $absensi->user_id,
                    'pertemuan_id' => $absensi->pertemuan_id,
                    'status' => $absensi->status,
                    'user_name' => $absensi->user ? $absensi->user->name : '',
                    'user_email' => $absensi->user ? $absensi->user->email : ''
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Absensi show: ' . $e->getMessage());
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
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha'
        ], [
            'user_id.required' => 'User harus dipilih',
            'user_id.exists' => 'User tidak valid',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus salah satu: Hadir, Izin, Sakit, Alpha'
        ]);

        try {
            $absensi = Absensi::findOrFail($id);

            // Check if user already has attendance for this pertemuan (excluding current record)
            $existingAbsensi = Absensi::where('user_id', $request->user_id)
                ->where('pertemuan_id', $absensi->pertemuan_id)
                ->where('id', '!=', $id)
                ->first();

            if ($existingAbsensi) {
                return response()->json([
                    'success' => false,
                    'message' => 'User sudah memiliki absensi untuk pertemuan ini'
                ], 422);
            }

            $absensi->update($request->only([
                'user_id',
                'status'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil diperbarui',
                'data' => $absensi
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Absensi update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui absensi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $absensi = Absensi::findOrFail($id);
            $absensi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Absensi destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus absensi: ' . $e->getMessage()
            ], 500);
        }
    }
}
