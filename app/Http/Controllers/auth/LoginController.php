<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = $request->input('g-recaptcha-response');
        $remoteIp = $request->ip();
        if (!$this->recaptcha($response, $remoteIp)) {
            return back()->withErrors([
                'gagal' => 'Recaptcha tidak sesuai',
            ])->onlyInput('email');
        }


        $input = $request->only('email', 'password');
        if (Auth::attempt($input)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->to('/')->with('sukses', 'Kamu Berhasil Login');
            }
            if ($user->role_id == 2) {
                return redirect()->to('/assesor/dashboard')->with('sukses', 'Selamat datang Assessor!');
            }
            if ($user->role_id == 3) {
                return redirect()->to('/admin/dashboard')->with('sukses', 'Selamat datang Admin!');
            }
            if ($user->role_id == 4) {
                return redirect()->route('dosen.dashboard')->with('sukses', 'Selamat datang Dosen!');
            }
            if ($user->role_id == 5) {
                return redirect()->to('admin/dashboard');
            }
        }

        return back()->withErrors([
            'gagal' => 'Email atau Katasandi tidak sesuai',
        ])->onlyInput('email');
    }

    public function recaptcha($response, $remoteIp)
    {
        $secretKey = '6LfKVWIrAAAAACFeMK6FYN0CKn-3AsTSMszZQZ1G';
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

        $recaptchaResponse = file_get_contents("$recaptchaUrl?secret=$secretKey&response=$response&remoteip=$remoteIp");
        $recaptcha = json_decode($recaptchaResponse);
        if ($recaptcha->success) {
            return true;
        }
        return false;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('sukses', 'Berhasil logout');
    }
}
