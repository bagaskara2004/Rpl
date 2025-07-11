<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.User.Dosen');
    }

    public function data()
    {
        $dosens = User::with('role')
            ->where('block', 0)
            ->where('role_id', 4) // role_id = 4 untuk dosen
            ->select('id', 'user_name', 'email', 'created_at', 'foto', 'role_id')
            ->get();
        $dosens->transform(function ($dosen) {
            $dosen->name = $dosen->user_name;
            return $dosen;
        });
        return response()->json($dosens->values());
    }

    public function block(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id'
            ]);

            $dosen = User::findOrFail($request->id);
            $dosen->block = 1;
            $dosen->save();

            return response()->json([
                'success' => true,
                'message' => 'Dosen berhasil diblokir'
            ])->header('Content-Type', 'application/json');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422)->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memblokir dosen: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function unblock(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id'
            ]);

            $dosen = User::findOrFail($request->id);
            $dosen->block = 0;
            $dosen->save();

            return response()->json([
                'success' => true,
                'message' => 'Dosen berhasil dibuka blokir'
            ])->header('Content-Type', 'application/json');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422)->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuka blokir dosen: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role_id' => 'required|integer|in:4', // 4 = dosen
            ]);

            // Set foto default
            $fotoPath = '/assets/User.svg';

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id ?? 4, // Default role sebagai Dosen
                'foto' => $fotoPath,
                'block' => 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dosen berhasil ditambahkan',
                'data' => $user->load('role')
            ])->header('Content-Type', 'application/json');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422)->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan dosen: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
