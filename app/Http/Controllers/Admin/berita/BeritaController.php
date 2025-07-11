<?php

namespace App\Http\Controllers\Admin\berita;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Berita.index');
    }

    /**
     * Get data for DataTables
     */
    public function data(Request $request)
    {
        try {
            $search = $request->input('search');
            $page = $request->input('page', 1);
            $perPage = 9;

            // Simple query first - remove with clause temporarily
            $query = Berita::orderBy('created_at', 'desc');

            if ($search) {
                $query->search($search);
            }

            $total = $query->count();
            $berita = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            // Load admin relation separately to avoid issues
            $berita->load(['admin' => function ($query) {
                $query->select('id', 'user_name', 'email'); // Hanya ambil kolom yang pasti ada
            }]);

            $totalPages = ceil($total / $perPage);

            return response()->json([
                'data' => $berita,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'admin_id' => Auth::id(),
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berita', $filename, 'public');
            $data['foto'] = $path;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('sukses', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::with(['admin' => function ($query) {
            $query->select('id', 'user_name', 'name', 'email');
        }])->findOrFail($id);
        return view('Admin.Berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('Admin.Berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berita', $filename, 'public');
            $data['foto'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('sukses', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            // Delete file if exists
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }

            $berita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita'
            ], 500);
        }
    }

    /**
     * Debug method untuk testing
     */
    public function debug()
    {
        try {
            // Test basic query
            $count = Berita::count();
            $users = \App\Models\User::count();

            return response()->json([
                'berita_count' => $count,
                'users_count' => $users,
                'message' => 'Debug berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
