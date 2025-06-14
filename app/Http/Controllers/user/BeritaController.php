<?php

namespace App\Http\Controllers\user;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function index()
    {
        return view(
            'user.berita',
            [
                'berita' => Berita::orderByDesc('id')->paginate(9),
            ]
        );
    }
    public function detail(Berita $berita)
    {
        return view(
            'user.detail-berita',
            [
                'berita' => $berita
                ]
        );
    }
}
