<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Absensi;

class PertemuanController extends Controller
{
    public function index(Request $request, $kelasId, $mataKuliahId)
    {
        $pertemuanList = Pertemuan::with('absensi')
            ->where('kelas_id', $kelasId)
            ->where('mata_kuliah_id', $mataKuliahId)
            ->orderBy('tanggal')
            ->get();

        $kelas = Kelas::findOrFail($kelasId);
        $mataKuliah = MataKuliah::findOrFail($mataKuliahId);

        $pertemuanTerpilih = null;
        $muridList = collect();

        if ($request->has('pertemuanId')) {
            $pertemuanTerpilih = Pertemuan::with(['mataKuliah', 'kelas', 'absensi'])->findOrFail($request->pertemuanId);
        
            $muridList = Murid::with(['user.dataDiri' => function ($query) {
                $query->withTrashed(); // 👈 Tambahkan ini
            }])->where('kelas_id', $kelasId)->get();
        
            foreach ($muridList as $murid) {
                $absen = $pertemuanTerpilih->absensi->firstWhere('user_id', $murid->user_id);
                $murid->absensi_status = $absen?->status;
            }
        }
        

        return view('dosen.pertemuan.index', compact(
            'pertemuanList',
            'kelas',
            'mataKuliah',
            'pertemuanTerpilih',
            'muridList'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nama_pertemuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Pertemuan::create([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kelas_id' => $request->kelas_id,
            'nama_pertemuan' => $request->nama_pertemuan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('dosen.pertemuan.index', [
            'kelasId' => $request->kelas_id,
            'mataKuliahId' => $request->mata_kuliah_id
        ])->with('success', 'Pertemuan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pertemuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $pertemuan = Pertemuan::findOrFail($id);
        $pertemuan->update([
            'nama_pertemuan' => $request->nama_pertemuan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('dosen.pertemuan.index', [
            'kelasId' => $pertemuan->kelas_id,
            'mataKuliahId' => $pertemuan->mata_kuliah_id
        ])->with('success', 'Pertemuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        $kelasId = $pertemuan->kelas_id;
        $mataKuliahId = $pertemuan->mata_kuliah_id;

        $pertemuan->delete();

        return redirect()->route('dosen.pertemuan.index', [
            'kelasId' => $kelasId,
            'mataKuliahId' => $mataKuliahId
        ])->with('success', 'Pertemuan berhasil dihapus.');
    }
}
