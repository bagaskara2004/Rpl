<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dosen.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function updateProfile(Request $request)
    {
    $request->validate([
        'user_name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:100',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('foto', 'public');
        $user->foto = $path;
    }

    if ($request->filled('password')) {
        $user->password = $request->password;
    }

    $user->user_name = $request->user_name;
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

}
