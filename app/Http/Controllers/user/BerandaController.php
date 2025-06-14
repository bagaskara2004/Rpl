<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view(
            'user.beranda',
            [
                'berita' => Berita::orderByDesc('id')->limit(3)->get(),
            ]
        );
    }
}
