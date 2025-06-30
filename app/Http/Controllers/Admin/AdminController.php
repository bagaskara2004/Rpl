<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TranskripNilai;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.Dashboard.index');
    }

    public function dashboard(Request $request)
    {
        // Get statistics for dashboard
        $totalUsers = User::count();
        $totalTranskrip = TranskripNilai::count();
        $totalAssessment = Assessment::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentTranskrip = TranskripNilai::with('user')->latest()->take(5)->get();

        $data = compact('totalUsers', 'totalTranskrip', 'totalAssessment', 'recentUsers', 'recentTranskrip');

        return view('Admin.Dashboard.index', $data);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('Admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        try {
            $user = Auth::user();
            User::where('id', $user->id)->update([
                'user_name' => $request->user_name,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui profile.'
            ], 500);
        }
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $user = Auth::user();

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($user->foto && Storage::exists('public/profile_photos/' . $user->foto)) {
                    Storage::delete('public/profile_photos/' . $user->foto);
                }

                // Store new photo
                $fileName = time() . '_' . $user->id . '.' . $request->photo->extension();
                $request->photo->storeAs('public/profile_photos', $fileName);

                User::where('id', $user->id)->update([
                    'foto' => $fileName
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Foto profile berhasil diupload!',
                'photo_url' => asset('storage/profile_photos/' . $fileName)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupload foto.'
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        try {
            $user = Auth::user();

            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password saat ini tidak benar.'
                ], 422);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah password.'
            ], 500);
        }
    }
}
