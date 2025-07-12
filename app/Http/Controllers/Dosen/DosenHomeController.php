<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataKuliah;

class DosenHomeController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Ambil mata kuliah milik dosen
    $mataKuliah = MataKuliah::with('kelas')
        ->where('dosen_id', $user->id)
        ->get();

    return view('dosen.dashboard', [
        'user' => $user,
        'mataKuliah' => $mataKuliah
    ]);
}



    public function storeKelas(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'semester' => 'required|string',
            'tahun' => 'required|numeric',
            'kelas' => 'required|string|max:20',
        ]);

        $kelas = Kelas::firstOrCreate(['kelas' => $request->kelas]);

        MataKuliah::create([
            'dosen_id' => Auth::id(),
            'kelas_id' => $kelas->id,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dosen.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
        ]);

        $user = Auth::user();
        $user->update($request->only('user_name', 'email'));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
