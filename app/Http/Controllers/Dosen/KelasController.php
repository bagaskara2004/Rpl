<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MataKuliah;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('dosen.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
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


    public function create()
    {
        return view('dosen.kelas.create'); 
    }

    

}
