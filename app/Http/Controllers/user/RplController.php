<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\Pendidikan;
use App\Models\TranskripNilai;
use Illuminate\Support\Facades\Auth;

class RplController extends Controller
{
    public function index()
    {
        return view(
            'user.rpl',
            [
                'konfirmasi' => $this->check(),
                'datadiri' => DataDiri::where('user_id', Auth::id())->exists(),
                'pendidikan' => Pendidikan::where('user_id', Auth::id())->exists(),
                'asesment' => TranskripNilai::where('user_id', Auth::id())->exists()
            ]
        );
    }
    public function check()
    {
        $id = Auth::id();
        $datadiri = DataDiri::where('user_id', $id)->get();
        $pendidikan = Pendidikan::where('user_id', $id)->get();
        $asesment = TranskripNilai::where('user_id', $id)->get();
        if ($datadiri->isEmpty() || $pendidikan->isEmpty() || $asesment->isEmpty()) {
            return false;
        }
        return true;
    }
}
