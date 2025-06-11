<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;

class AssessorController extends Controller
{
    public function index()
    {
        // Hanya menampilkan halaman, data diambil via AJAX
        return view('Assessor.pendaftar.index');
    }

    public function getData()
    {
        $dataDiri = DataDiri::with(['user', 'pendidikan'])->get();
        return response()->json($dataDiri);
    }

    public function getModalData($id)
    {
        $diri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])->findOrFail($id);
        return response()->json($diri);
    }
}
