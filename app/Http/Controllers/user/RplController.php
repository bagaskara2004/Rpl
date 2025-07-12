<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\DataDiri;
use App\Models\Keputusan;
use App\Models\Pelatihan;
use App\Models\Pendidikan;
use App\Models\PengalamanKerja;
use App\Models\Pertanyaan;
use App\Models\TransferNilai;
use App\Models\TranskripNilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RplController extends Controller
{
    public function index()
    {
        if ($keputusan = Keputusan::where('user_id', Auth::id())->first()) {
            if ($keputusan->status) {
                return view('user.diterima');
            }
            return view('user.ditolak', [
                'message' => $keputusan->catatan
            ]);
        }
        if (Assessment::where('user_id', Auth::id())->exists()) {
            return view('user.diproses');
        }
        return view(
            'user.rpl',
            [
                'konfirmasi' => $this->check(),
                'datadiri' => DataDiri::where('user_id', Auth::id())->exists(),
                'pendidikan' => Pendidikan::where('user_id', Auth::id())->exists(),
                'asesment' => TranskripNilai::where('user_id', Auth::id())->exists(),
                'pengalamankerja' => PengalamanKerja::where('user_id', Auth::id())->get(),
                'pelatihan' => Pelatihan::where('user_id', Auth::id())->get(),
                'pertanyaan' => Pertanyaan::all()
            ]
        );
    }

    public function ajukanUlang()
    {
        $datadiri = DataDiri::select('user_id', 'nama_lengkap', 'tgl_lahir', 'tempat_lahir', 'jenis_kelamin', 'email', 'hp', 'tlp', 'alamat', 'kab_kota', 'provinsi', 'kode_pos', 'foto', 'cv', 'sumber_biaya_pendidikan', 'nama_ibu', 'pekerjaan_ibu', 'nama_ayah', 'pekerjaan_ayah', 'status')->where('user_id', Auth::id())->first();
        $pendidikan = Pendidikan::select('user_id', 'nama_perguruan', 'pembimbing1', 'prodi', 'judul_ta', 'tahun_lulus', 'tahun_masuk', 'ipk', 'nim', 'jurusan', 'jenjang_pendidikan', 'ijasah', 'transkrip')->where('user_id', Auth::id())->first();
        $transkrip = TranskripNilai::select('user_id','mata_kuliah','sks','nilai_huruf','nilai_angka')->where('user_id', Auth::id())->get();

        $datadiri['status'] = 'pending';

        DataDiri::where('user_id',Auth::id())->delete();
        Pendidikan::where('user_id',Auth::id())->delete();
        TranskripNilai::where('user_id',Auth::id())->delete();

        Keputusan::where('user_id',Auth::id())->delete();
        Assessment::where('user_id',Auth::id())->delete();

        DataDiri::create($datadiri->toArray());
        Pendidikan::create($pendidikan->toArray());

        foreach ($transkrip as $data) {
            TranskripNilai::create([
                'user_id' => $data['user_id'],
                'mata_kuliah' => $data['mata_kuliah'],
                'sks' => $data['sks'],
                'nilai_huruf' => $data['nilai_huruf'],
                'nilai_angka' => $data['nilai_angka'],
            ]);
        }
        return redirect()->route('user.rpl')->with('sukses','Pengajuan RPL berhasil Diulang');
    }

    public function detailFormulir()
    {

        return view(
            'user.detail-formulir',
            [
                'datadiri' => DataDiri::select('nama_lengkap', 'tgl_lahir', 'tempat_lahir', 'jenis_kelamin', 'email', 'hp', 'tlp', 'alamat', 'kab_kota', 'provinsi', 'kode_pos', 'foto', 'cv', 'sumber_biaya_pendidikan', 'nama_ibu', 'pekerjaan_ibu', 'nama_ayah', 'pekerjaan_ayah', 'status')
                    ->where('user_id', Auth::id())
                    ->first(),
                'pendidikan' => Pendidikan::select('nama_perguruan', 'pembimbing1', 'prodi', 'judul_ta', 'tahun_lulus', 'tahun_masuk', 'ipk', 'nim', 'jurusan', 'jenjang_pendidikan', 'ijasah', 'transkrip')
                    ->where('user_id', Auth::id())
                    ->first(),
                'transkrip' => TranskripNilai::where('user_id', Auth::id())->get(),
                'pekerjaan' => PengalamanKerja::where('user_id', Auth::id())->get(),
                'pelatihan' => Pelatihan::where('user_id', Auth::id())->get(),
            ]
        );
    }
    public function check()
    {
        $id = Auth::id();
        $datadiri = DataDiri::where('user_id', $id)->get();
        $pendidikan = Pendidikan::where('user_id', $id)->get();
        $asesment = TranskripNilai::where('user_id', $id)->get();
        if ($datadiri->isEmpty() || $pendidikan->isEmpty() || $asesment->isEmpty()) {
            return false;
        }
        return true;
    }
    public function datadiri(Request $request)
    {
        if ($request->isMethod('get')) {
            return view(
                'user.form-datadiri',
                [
                    'data' => DataDiri::where('user_id', Auth::id())->first()
                ]
            );
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'alamat' => 'required|min:5|max:255',
                'provinsi' => 'required|min:3|max:255',
                'kab_kota' => 'required|min:3|max:255',
                'kode_pos' => 'required|min_digits:5|max_digits:5|numeric',
                'tlp' => 'required|min_digits:5|max_digits:16|numeric',
                'hp' => 'required|min_digits:10|max_digits:16|numeric',
                'tempat_lahir' => 'required|min:5|max:255',
                'tgl_lahir' => 'required',
                'nama_ayah' => 'required|max:255',
                'pekerjaan_ayah' => 'required|max:255',
                'nama_ibu' => 'required|max:255',
                'pekerjaan_ibu' => 'required|max:255',
                'sumber_biaya_pendidikan' => 'required|max:255',
                'foto' => 'required|image|mimes:jpg,jpeg,png',
                'cv' => 'required|mimes:pdf'
            ]);
        }

        if ($request->isMethod('put')) {
            $data = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'alamat' => 'required|min:5|max:255',
                'provinsi' => 'required|min:3|max:255',
                'kab_kota' => 'required|min:3|max:255',
                'kode_pos' => 'required|min_digits:5|max_digits:5|numeric',
                'tlp' => 'required|min_digits:5|max_digits:16|numeric',
                'hp' => 'required|min_digits:10|max_digits:16|numeric',
                'tempat_lahir' => 'required|min:5|max:255',
                'tgl_lahir' => 'required',
                'nama_ayah' => 'required|max:255',
                'pekerjaan_ayah' => 'required|max:255',
                'nama_ibu' => 'required|max:255',
                'pekerjaan_ibu' => 'required|max:255',
                'sumber_biaya_pendidikan' => 'required|max:255',
                'foto' => 'image|mimes:jpg,jpeg,png',
                'cv' => 'mimes:pdf'
            ]);
            if ($request->file('foto')) {
                $pathFoto = DataDiri::where('user_id', Auth::id())->value('foto');
                Storage::disk('public')->delete($pathFoto);
            }
            if ($request->file('cv')) {
                $pathCv = DataDiri::where('user_id', Auth::id())->value('cv');
                Storage::disk('public')->delete($pathCv);
            }
        }
        $data['user_id'] = Auth::id();

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $pathFoto = $foto->store('foto', 'public');
            $data['foto'] = $pathFoto;
        }
        if ($request->file('cv')) {
            $cv = $request->file('cv');
            $pathCv = $cv->store('cv', 'public');
            $data['cv'] = $pathCv;
        }

        $save = DataDiri::updateOrCreate(['user_id' => $data['user_id']], $data);
        if ($save) {
            return redirect()->to('/rpl')->with('sukses', 'Form datadiri berhasil disimpan');
        }
        return redirect()->to('/rpl')->with('gagal', 'Form datadiri gagal disimpan');
    }

    public function pendidikan(Request $request)
    {
        if ($request->isMethod('get')) {
            return view(
                'user.form-pendidikan',
                [
                    'data' => Pendidikan::where('user_id', Auth::id())->first()
                ]
            );
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'nama_perguruan' => 'required|string|max:255',
                'pembimbing1' => 'required|string|max:255',
                'prodi' => 'required|string|max:255',
                'judul_ta' => 'required|string|max:255',
                'tahun_lulus' => 'required',
                'tahun_masuk' => 'required',
                'ipk' => 'required|numeric',
                'nim' => 'required|min_digits:10|max_digits:11|numeric',
                'jurusan' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|string|max:255',
                'ijasah' => 'required|mimes:pdf',
                'transkrip' => 'required|mimes:pdf',
            ]);
        }
        if ($request->isMethod('put')) {
            $data = $request->validate([
                'nama_perguruan' => 'required|string|max:255',
                'pembimbing1' => 'required|string|max:255',
                'prodi' => 'required|string|max:255',
                'judul_ta' => 'required|string|max:255',
                'tahun_lulus' => 'required',
                'tahun_masuk' => 'required',
                'ipk' => 'required|numeric',
                'nim' => 'required|min_digits:10|max_digits:11|numeric',
                'jurusan' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|string|max:255',
                'ijasah' => 'mimes:pdf',
                'transkrip' => 'mimes:pdf',
            ]);
            if ($request->file('ijasah')) {
                $pathIjasah = Pendidikan::where('user_id', Auth::id())->value('ijasah');
                Storage::disk('public')->delete($pathIjasah);
            }
            if ($request->file('transkrip')) {
                $pathTranskrip = Pendidikan::where('user_id', Auth::id())->value('transkrip');
                Storage::disk('public')->delete($pathTranskrip);
            }
        }
        $data['user_id'] = Auth::id();

        if ($request->file('ijasah')) {
            $ijasah = $request->file('ijasah');
            $pathIjasah = $ijasah->store('ijasah', 'public');
            $data['ijasah'] = $pathIjasah;
        }
        if ($request->file('transkrip')) {
            $transkrip = $request->file('transkrip');
            $pathTranskrip = $transkrip->store('transkrip', 'public');
            $data['transkrip'] = $pathTranskrip;
        }

        $save = Pendidikan::updateOrCreate(['user_id' => $data['user_id']], $data);
        if ($save) {
            return redirect()->to('/rpl')->with('sukses', 'Form pendidikan berhasil disimpan');
        }
        return redirect()->to('/rpl')->with('gagal', 'Form pendidikan gagal disimpan');
    }

    public function asesment(Request $request)
    {
        if ($request->isMethod('get')) {
            return view(
                'user.form-asesment',
                [
                    'asesments' => TranskripNilai::where('user_id', Auth::id())->get()
                ]
            );
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'mata_kuliah' => 'required|string|min:3|max:100',
                'sks' => 'required|numeric|max_digits:3',
                'nilai_angka' => 'required|numeric',
                'nilai_huruf' => 'required|string|max:2'
            ]);
            $data['user_id'] = Auth::id();
            TranskripNilai::create($data);
            return back()->with('sukses', 'Data berhasil ditambahkan');
        }

        if ($request->isMethod('delete')) {
            $data = TranskripNilai::find($request->input('id'));
            if (!$data || $data->user_id != Auth::id()) {
                return back()->with('gagal', 'Data gagal dihapus');
            }
            TranskripNilai::destroy($request->input('id'));
            return back()->with('sukses', 'Data berhasil dihapus');
        }
    }

    public function pengalamanKerja(Request $request, $id = 0)
    {
        if ($request->isMethod('get')) {
            return view(
                'user.form-pekerjaan',
                [
                    'data' => PengalamanKerja::where('user_id', Auth::id())->find($id)
                ]
            );
        }
        if ($request->isMethod('delete')) {
            PengalamanKerja::destroy($request->input('id'));
            return redirect()->to('/rpl')->with('sukses', 'Pengalaman Kerja berhasil dihapus');
        }


        $data = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'negara_perusahaan' => 'required|string|max:255',
            'provinsi_perusahaan' => 'required|string|max:255',
            'kota_kab_perusahaan' => 'required|string|max:255',
            'sejak' => 'required',
            'sampai' => '',
            'nama_staf' => 'string|max:255',
            'tlp_staf' => 'string|max:255',
            'posisi_staf' => 'string|max:255',
            'email_staf' => 'max:255|email',
            'posisi' => 'required|string|max:255',
            'durasi' => 'numeric',
            'prestasi' => 'required|string|max:255',
        ]);
        $data['user_id'] = Auth::id();

        if ($request->isMethod('post')) {
            PengalamanKerja::create($data);
        }

        if ($request->isMethod('put')) {
            PengalamanKerja::where('id', $request->input('id'))->update($data);
        }

        return redirect()->to('/rpl')->with('sukses', 'Pengalaman Kerja berhasil disimpan');
    }

    public function pelatihan(Request $request, $id = 0)
    {
        if ($request->isMethod('get')) {
            return view(
                'user.form-pelatihan',
                [
                    'data' => Pelatihan::where('user_id', Auth::id())->find($id)
                ]
            );
        }

        if ($request->isMethod('delete')) {
            $dokumen = Pelatihan::find($request->input('id'));
            Storage::disk('public')->delete($dokumen->sertifikat);

            Pelatihan::destroy($request->input('id'));
            return redirect()->to('/rpl')->with('sukses', 'Pelatihan berhasil dihapus');
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'nama_pelatihan' => 'required|string|max:255',
                'penyelenggara' => 'required|string|max:255',
                'peran' => 'required|string|max:255',
                'sertifikat' => 'required|mimes:pdf',
                'durasi' => 'required|numeric',
            ]);
            $data['user_id'] = Auth::id();
            $sertifikat = $request->file('sertifikat');
            $pathSertifikat = $sertifikat->store('pelatihan', 'public');
            $data['sertifikat'] = $pathSertifikat;
            Pelatihan::create($data);
        }

        if ($request->isMethod('put')) {
            $data = $request->validate([
                'nama_pelatihan' => 'required|string|max:255',
                'penyelenggara' => 'required|string|max:255',
                'peran' => 'required|string|max:255',
                'sertifikat' => 'mimes:pdf',
                'durasi' => 'required|numeric',
            ]);
            $data['user_id'] = Auth::id();

            if ($request->file('sertifikat')) {
                $pathSertifikat = Pelatihan::where('user_id', Auth::id())->value('sertifikat');
                Storage::disk('public')->delete($pathSertifikat);

                $sertifikat = $request->file('sertifikat');
                $pathSertifikatNew = $sertifikat->store('pelatihan', 'public');
                $data['sertifikat'] = $pathSertifikatNew;
            }

            Pelatihan::where('id', $request->input('id'))->update($data);
        }
        return redirect()->to('/rpl')->with('sukses', 'Pelatihan berhasil disimpan');
    }

    public function konfirmasi(Request $request)
    {
        if ($request->method('post')) {
            if (!$request->has('konfirmasi')) {
                return back()->with('gagal', 'Harap checklist " SAYA TELAH MEMBACA DAN MENGISI FORMULIR PENDAFTARAN UNTUK MENGIKUTI PERKULIAHAN MELALUI PROGRAM RPL DI POLITEKNIK NEGERI BALI DENGAN BAIK "');
            }

            $jawabans = $request->input('jawaban');

            foreach ($jawabans as $pertanyaanId => $jawaban) {
                Assessment::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'pertanyaan_id' => $pertanyaanId
                    ],
                    [
                        'jawaban' => $jawaban
                    ]
                );
            }
            return back()->with('sukses', 'Terimaksih jawaban anda sudah terkirim');
        }
    }
}
