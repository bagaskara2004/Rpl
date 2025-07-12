<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the admin users.
     */
    public function index()
    {
        return view('Admin.User.admin');
    }

    /**
     * Get admin users data for DataTable.
     */
    public function data()
    {
        $admins = User::with('role')
            ->where('block', 0)
            ->whereIn('role_id', [3, 4]) // 3 = admin, 4 = super admin
            ->select('id', 'user_name', 'email', 'created_at', 'foto', 'role_id')
            ->get();

        $admins->transform(function ($user) {
            // Use user_name as display name since name column doesn't exist yet
            $user->display_name = $user->user_name;
            $user->role_name = $user->role ? $user->role->name : 'Unknown';
            $user->formatted_date = $user->created_at ? $user->created_at->format('d/m/Y') : '';
            return $user;
        });

        return response()->json($admins->values());
    }

    /**
     * Store a newly created admin user.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role_id' => 'required|integer|in:3,4', // 3 = admin, 4 = super admin
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Handle photo upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/profile_photos', $fileName);
                $fotoPath = $fileName;
            }

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'foto' => $fotoPath,
                'block' => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil ditambahkan!',
                'data' => $user
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan admin: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the specified admin user.
     */
    public function show($id)
    {
        try {
            $admin = User::with('role')
                ->whereIn('role_id', [3, 4])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $admin
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Admin tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified admin user.
     */
    public function update(Request $request, $id)
    {
        try {
            $admin = User::whereIn('role_id', [3, 4])->findOrFail($id);

            $request->validate([
                'user_name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($admin->id)],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($admin->id)],
                'password' => 'nullable|string|min:8',
                'role_id' => 'required|integer|in:3,4',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Handle photo upload
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($admin->foto && Storage::exists('public/profile_photos/' . $admin->foto)) {
                    Storage::delete('public/profile_photos/' . $admin->foto);
                }

                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/profile_photos', $fileName);
                $admin->foto = $fileName;
            }

            // Update admin data
            $admin->user_name = $request->user_name;
            $admin->email = $request->email;
            $admin->role_id = $request->role_id;

            // Update password if provided
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }

            $admin->save();

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diperbarui!',
                'data' => $admin->load('role')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui admin: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Block the specified admin user.
     */
    public function block(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id'
            ]);

            $admin = User::whereIn('role_id', [3, 4])->findOrFail($request->id);

            // Prevent blocking super admin if there's only one
            if ($admin->role_id == 4) {
                $superAdminCount = User::where('role_id', 4)->where('block', 0)->count();
                if ($superAdminCount <= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak dapat memblokir super admin terakhir!'
                    ], 422);
                }
            }

            $admin->block = 1;
            $admin->save();

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diblokir'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memblokir admin: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Unblock the specified admin user.
     */
    public function unblock(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:users,id'
            ]);

            $admin = User::whereIn('role_id', [3, 4])->findOrFail($request->id);
            $admin->block = 0;
            $admin->save();

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diaktifkan kembali'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengaktifkan admin: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified admin user.
     */
    public function destroy($id)
    {
        try {
            $admin = User::whereIn('role_id', [3, 4])->findOrFail($id);

            // Prevent deleting super admin if there's only one
            if ($admin->role_id == 4) {
                $superAdminCount = User::where('role_id', 4)->where('block', 0)->count();
                if ($superAdminCount <= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak dapat menghapus super admin terakhir!'
                    ], 422);
                }
            }

            // Delete photo if exists
            if ($admin->foto && Storage::exists('public/profile_photos/' . $admin->foto)) {
                Storage::delete('public/profile_photos/' . $admin->foto);
            }

            $admin->delete();

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus admin: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all roles for dropdown.
     */
    public function getRoles()
    {
        $roles = Role::whereIn('id', [3, 4])->get(['id', 'name']);
        return response()->json($roles);
    }
}
