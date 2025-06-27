<?php

namespace App\Http\Controllers\Admin\keputusan;

use App\Http\Controllers\Controller;
use App\Models\Keputusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KeputusanControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Keputusan.index');
    }

    /**
     * Get data for DataTable
     */
    public function getData()
    {
        try {
            $keputusanData = DB::table('keputusan')
                ->join('users as mahasiswa', 'keputusan.user_id', '=', 'mahasiswa.id')
                ->join('users as asesor', 'keputusan.asesor_id', '=', 'asesor.id')
                ->leftJoin('data_diri', 'mahasiswa.id', '=', 'data_diri.user_id')
                ->leftJoin('pendidikan', 'mahasiswa.id', '=', 'pendidikan.user_id')
                ->select(
                    'keputusan.id',
                    'keputusan.status',
                    'keputusan.catatan',
                    'keputusan.created_at',
                    'mahasiswa.user_name as mahasiswa_name',
                    'asesor.user_name as asesor_name',
                    'data_diri.nama_lengkap',
                    'data_diri.email',
                    'data_diri.foto',
                    'pendidikan.jurusan',
                    'pendidikan.prodi'
                )
                ->orderBy('keputusan.created_at', 'desc')
                ->get();

            $data = $keputusanData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'mahasiswa_name' => $item->nama_lengkap ?: $item->mahasiswa_name,
                    'email' => $item->email ?: '-',
                    'jurusan' => $item->jurusan ?: 'Belum Diisi',
                    'prodi' => $item->prodi ?: 'Belum Diisi',
                    'asesor_name' => $item->asesor_name,
                    'status' => $item->status,
                    'status_text' => $item->status ? 'Diterima' : 'Ditolak',
                    'status_class' => $item->status ? 'success' : 'danger',
                    'catatan' => $item->catatan ?: '-',
                    'foto' => $item->foto,
                    'created_at' => date('d/m/Y H:i', strtotime($item->created_at))
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in Keputusan getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'asesor_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
            'catatan' => 'nullable|string|max:500'
        ]);

        try {
            $keputusan = Keputusan::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Keputusan berhasil disimpan',
                'data' => $keputusan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Keputusan store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan keputusan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $keputusan = DB::table('keputusan')
                ->join('users as mahasiswa', 'keputusan.user_id', '=', 'mahasiswa.id')
                ->join('users as asesor', 'keputusan.asesor_id', '=', 'asesor.id')
                ->leftJoin('data_diri', 'mahasiswa.id', '=', 'data_diri.user_id')
                ->leftJoin('pendidikan', 'mahasiswa.id', '=', 'pendidikan.user_id')
                ->where('keputusan.id', $id)
                ->select(
                    'keputusan.id',
                    'keputusan.user_id',
                    'keputusan.asesor_id',
                    'keputusan.status',
                    'keputusan.catatan',
                    'keputusan.created_at',
                    'keputusan.updated_at',
                    'mahasiswa.user_name as mahasiswa_name',
                    'asesor.user_name as asesor_name',
                    'data_diri.nama_lengkap',
                    'data_diri.email',
                    'data_diri.foto',
                    'data_diri.tempat_lahir',
                    'data_diri.tgl_lahir',
                    'data_diri.jenis_kelamin',
                    'data_diri.alamat',
                    'pendidikan.jurusan',
                    'pendidikan.prodi',
                    'pendidikan.nama_perguruan',
                    'pendidikan.ipk',
                    'pendidikan.nim',
                    'pendidikan.jenjang_pendidikan'
                )
                ->first();

            if (!$keputusan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Pastikan status boolean dikembalikan dengan benar
            $keputusan->status = (bool) $keputusan->status;
            $keputusan->status_text = $keputusan->status ? 'Diterima' : 'Ditolak';
            $keputusan->status_class = $keputusan->status ? 'success' : 'danger';

            return response()->json([
                'success' => true,
                'data' => $keputusan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Keputusan show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
            'catatan' => 'nullable|string|max:500'
        ]);

        try {
            $keputusan = Keputusan::findOrFail($id);
            $keputusan->update($request->only(['status', 'catatan']));

            return response()->json([
                'success' => true,
                'message' => 'Keputusan berhasil diperbarui',
                'data' => $keputusan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Keputusan update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui keputusan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $keputusan = Keputusan::findOrFail($id);
            $keputusan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Keputusan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in Keputusan destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus keputusan: ' . $e->getMessage()
            ], 500);
        }
    }
}
