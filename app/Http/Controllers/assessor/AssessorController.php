<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;

class AssessorController extends Controller
{
    public function index()
    {
        $dataDiri = DataDiri::with(['user', 'pendidikan'])->get();
        return view('Assessor.pendaftar', compact('dataDiri'));
    }
}
