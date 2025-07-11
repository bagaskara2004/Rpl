<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.User.index');
    }

    public function assessor()
    {
        return view('Admin.User.assessor');
    }

    public function data()
    {
        $users = User::with('role')
            ->where('block', 0)
            ->where('role_id', 1) // Hanya tampilkan user dengan role_id = 1 (role: user)
            ->select('id', 'user_name', 'email', 'created_at', 'foto', 'role_id')
            ->get();
        $users->transform(function ($user) {
            $user->name = $user->user_name;
            return $user;
        });
        return response()->json($users->values());
    }

    public function dataAssessor()
    {
        $users = User::with('role')
            ->where('block', 0)
            ->where('role_id', 2)
            ->select('id', 'user_name', 'email', 'created_at', 'foto', 'role_id')
            ->get();
        $users->transform(function ($user) {
            $user->name = $user->user_name;
            return $user;
        });
        return response()->json($users->values());
    }

    public function block(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id'
            ]);

            $user = User::findOrFail($request->id);
            $user->block = 1;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diblokir'
            ])->header('Content-Type', 'application/json');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422)->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memblokir user: ' . $e->getMessage()
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
                'role_id' => 'required|integer|in:1,2', // 1 = user, 2 = assessor
            ]);

            // Set foto default
            $fotoPath = '/assets/User.svg';

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id ?? 1, // Default role sebagai User
                'foto' => $fotoPath,
                'block' => 0
            ]);

            $roleText = $request->role_id == 1 ? 'User' : 'Assessor';

            return response()->json([
                'success' => true,
                'message' => $roleText . ' berhasil ditambahkan',
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
                'message' => 'Gagal menambahkan pengguna: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Store a newly created assessor in storage.
     */
    public function storeAssessor(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role_id' => 'required|integer|in:2', // 2 = assessor
            ]);

            // Set foto default
            $fotoPath = '/assets/User.svg';

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id ?? 2, // Default role sebagai Assessor
                'foto' => $fotoPath,
                'block' => 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assessor berhasil ditambahkan',
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
                'message' => 'Gagal menambahkan assessor: ' . $e->getMessage()
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
