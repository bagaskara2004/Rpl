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
     * Get data for DataTables
     */
    public function getData()
    {
        $users = \App\Models\User::with(['dataDiri', 'pendidikan', 'sisaMk.kurikulum'])->has('sisaMk')->get();

        return response()->json([
            'data' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nama' => $user->dataDiri->nama_lengkap ?? $user->user_name,
                    'email' => $user->email,
                    'total_sisa_mk' => $user->sisaMk->count(),
                    'created_at' => $user->created_at->format('d/m/Y H:i'),
                    'action' => $user->id
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kurikulum_id' => 'required|exists:kurikulum,id'
        ]);

        SisaMk::create([
            'user_id' => $request->user_id,
            'kurikulum_id' => $request->kurikulum_id
        ]);

        return response()->json(['success' => true, 'message' => 'Sisa MK berhasil ditambahkan']);
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kurikulum_id' => 'required|exists:kurikulum,id'
        ]);

        $sisaMk->update([
            'user_id' => $request->user_id,
            'kurikulum_id' => $request->kurikulum_id
        ]);

        return response()->json(['success' => true, 'message' => 'Sisa MK berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SisaMk $sisaMk)
    {
        $sisaMk->delete();

        return response()->json(['success' => true, 'message' => 'Sisa MK berhasil dihapus']);
    }
}
