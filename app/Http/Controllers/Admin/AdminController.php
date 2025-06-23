<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TranskripNilai;
use App\Models\Assessment;

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
}
