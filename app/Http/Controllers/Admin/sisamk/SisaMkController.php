<?php

namespace App\Http\Controllers\Admin\sisamk;

use App\Http\Controllers\Controller;
use App\Models\SisaMk;
use Illuminate\Http\Request;

class SisaMkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::with(['dataDiri', 'pendidikan', 'sisaMk.kurikulum'])->has('sisaMk')->get();
        return view('Admin.SisaMk.index', compact('users'));
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
        $user = \App\Models\User::with(['dataDiri', 'pendidikan', 'sisaMk.kurikulum'])->findOrFail($id);
        return view('Admin.SisaMk.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SisaMk $sisaMk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SisaMk $sisaMk)
    {
        //
    }
}
