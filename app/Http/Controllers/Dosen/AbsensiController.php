<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\Murid;
use App\Models\Absensi;
use App\Models\User;

class AbsensiController extends Controller
{
    public function index($pertemuanId)
    {
        $pertemuan = Pertemuan::with('kelas', 'mataKuliah')->findOrFail($pertemuanId);
        $muridList = Murid::with('user')->where('kelas_id', $pertemuan->kelas_id)->get();

        return view('dosen.absensi.index', compact('pertemuan', 'muridList'));
    }

    public function store(Request $request)
    {
        $pertemuanId = $request->input('pertemuan_id');
        $absensiData = $request->input('absensi', []);

        foreach ($absensiData as $userId => $status) {
            Absensi::updateOrCreate(
                ['pertemuan_id' => $pertemuanId, 'user_id' => $userId],
                ['status' => $status]
            );
        }

        $pertemuan = Pertemuan::findOrFail($pertemuanId);

        return redirect()
            ->route('dosen.pertemuan.index', [
                'kelasId' => $pertemuan->kelas_id,
                'mataKuliahId' => $pertemuan->mata_kuliah_id,
                'pertemuanId' => $pertemuan->id,
            ])
            ->with('success', 'Absensi berhasil disimpan.');
    }

}
