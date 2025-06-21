<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\Pendidikan;
use App\Models\TranskripNilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RplController extends Controller
{
    public function index()
    {
        return view(
            'user.rpl',
            [
                'konfirmasi' => $this->check(),
                'datadiri' => DataDiri::where('user_id', Auth::id())->exists(),
                'pendidikan' => Pendidikan::where('user_id', Auth::id())->exists(),
                'asesment' => TranskripNilai::where('user_id', Auth::id())->exists()
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
            // dd(DataDiri::where('user_id',Auth::id())->get());
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
}
