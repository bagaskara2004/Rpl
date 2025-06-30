<?php

namespace App\Http\Controllers\assessor\dataDiri;

use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use Illuminate\Http\Request;

class DataDiriControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Debug: cek apakah ID valid
        if (!$id || !is_numeric($id)) {
            return redirect()->route('assesor.index')->with('error', 'ID tidak valid');
        }

        $dataDiri = DataDiri::with(['pendidikan', 'pengalamanKerja'])->find($id);

        if (!$dataDiri) {
            return redirect()->route('assesor.index')->with('error', 'Data tidak ditemukan');
        }

        return view('Assessor.pendaftar.datadiri', compact('dataDiri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataDiri $dataDiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataDiri $dataDiri)
    {
        //
    }
}
