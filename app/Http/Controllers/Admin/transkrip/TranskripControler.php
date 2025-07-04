<?php

namespace App\Http\Controllers\Admin\transkrip;

use App\Http\Controllers\Controller;
use App\Models\TranskripNilai;
use App\Models\User;
use Illuminate\Http\Request;

class TranskripControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::with(['dataDiri', 'pendidikan', 'transkripNilai'])->has('transkripNilai')->get();
        return view('Admin.Transkrip.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = \App\Models\User::with(['dataDiri', 'pendidikan', 'transkripNilai'])->findOrFail($id);
        return view('Admin.Transkrip.show', compact('user'));
    }
}
