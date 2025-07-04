<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TranskripNilai;
use App\Models\Assessment;
use App\Models\DataDiri;
use App\Models\Pendidikan;
use App\Models\PengalamanKerja;


class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        return view('superAdmin.dashboard.index');
    }

    public function dashboard(Request $request)
    {
        // Basic statistics
        $totalUsers = User::count();
        $totalTranskrip = TranskripNilai::count();
        $totalAssessment = Assessment::count();

        // Data Diri statistics
        $totalDataDiri = User::whereHas('dataDiri')->count();
        $percentageDataDiri = $totalUsers > 0 ? round(($totalDataDiri / $totalUsers) * 100) : 0;

        // Monthly statistics
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Pending assessments
        $pendingAssessment = Assessment::where('status', 'pending')->count();

        // Average SKS
        $avgSksTersedia = TranskripNilai::avg('sks') ?? 0;
        $avgSksTersedia = round($avgSksTersedia, 1);

        // Total pendaftar (users with role_id = 1)
        $totalPendaftar = User::where('role_id', 1)->count();

        // Registration trend (last 7 days)
        $registrationTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $registrationTrend[] = [
                'day' => $date->format('D'),
                'count' => $count
            ];
        }

        // Status data for charts
        $dataLengkap = User::whereHas('dataDiri')->count();
        $dalamReview = 25; // Mock data - replace with actual logic
        $perluPerbaikan = 8; // Mock data
        $disetujui = 35; // Mock data

        // Recent data with better error handling
        $recentUsers = User::with(['dataDiri'])
            ->latest()
            ->take(5)
            ->get();

        $recentTranskrip = TranskripNilai::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Storage usage (mock data - replace with actual implementation)
        $storageUsage = '75%';

        // Top Perguruan Tinggi statistics
        try {
            $topPerguruanTinggi = Pendidikan::select('nama_perguruan')
                ->selectRaw('COUNT(*) as jumlah')
                ->whereNotNull('nama_perguruan')
                ->where('nama_perguruan', '!=', '')
                ->groupBy('nama_perguruan')
                ->orderBy('jumlah', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($item, $index) use ($totalUsers) {
                    return [
                        'nama_perguruan' => $item->nama_perguruan,
                        'jumlah' => $item->jumlah,
                        'percentage' => $totalUsers > 0 ? round(($item->jumlah / $totalUsers) * 100, 1) : 0
                    ];
                });
        } catch (\Exception $e) {
            $topPerguruanTinggi = collect([
                ['nama_perguruan' => 'Universitas Indonesia', 'jumlah' => 25, 'percentage' => 35.0],
                ['nama_perguruan' => 'Institut Teknologi Bandung', 'jumlah' => 18, 'percentage' => 25.0],
                ['nama_perguruan' => 'Universitas Gadjah Mada', 'jumlah' => 15, 'percentage' => 21.0],
            ]);
        }

        // Top Posisi Pekerjaan statistics
        try {
            $topPosisi = PengalamanKerja::select('posisi')
                ->selectRaw('COUNT(*) as jumlah')
                ->whereNotNull('posisi')
                ->where('posisi', '!=', '')
                ->groupBy('posisi')
                ->orderBy('jumlah', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($item, $index) use ($totalUsers) {
                    return [
                        'posisi' => $item->posisi,
                        'jumlah' => $item->jumlah,
                        'percentage' => $totalUsers > 0 ? round(($item->jumlah / $totalUsers) * 100, 1) : 0
                    ];
                });
        } catch (\Exception $e) {
            $topPosisi = collect([
                ['posisi' => 'Software Engineer', 'jumlah' => 32, 'percentage' => 45.0],
                ['posisi' => 'Data Analyst', 'jumlah' => 28, 'percentage' => 39.0],
                ['posisi' => 'Web Developer', 'jumlah' => 20, 'percentage' => 28.0],
            ]);
        }

        $data = compact(
            'totalUsers',
            'totalTranskrip',
            'totalAssessment',
            'totalDataDiri',
            'percentageDataDiri',
            'newUsersThisMonth',
            'pendingAssessment',
            'avgSksTersedia',
            'totalPendaftar',
            'registrationTrend',
            'dataLengkap',
            'dalamReview',
            'perluPerbaikan',
            'disetujui',
            'recentUsers',
            'recentTranskrip',
            'storageUsage',
            'topPerguruanTinggi',
            'topPosisi'
        );

        return view('Admin.Dashboard.index', $data);
    }
}
