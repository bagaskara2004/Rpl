<?php

namespace App\Http\Controllers\Admin\pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;
use App\Models\Assessment;
use App\Models\Pertanyaan;
use App\Models\Kurikulum;
use App\Models\TranskripNilai;
use App\Models\Keputusan;
use App\Models\TransferNilai;
use App\Models\User;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AssessorController extends Controller
{
    public function index()
    {
        return view('admin.pendaftar.index');
    }

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function getDashboardData()
    {
        try {
            // Ambil statistik keputusan
            $keputusanStats = Keputusan::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status');

            // Ambil total pendaftar yang belum diputuskan
            $userSudahDiputuskan = Keputusan::pluck('user_id')->toArray();
            $totalPendingEvaluasi = DataDiri::whereNotIn('user_id', $userSudahDiputuskan)->count();

            // Ambil total transfer nilai
            $totalTransferNilai = TransferNilai::count();

            // Ambil pendaftar terbaru (5 terakhir)
            $recentApplicants = DataDiri::with(['user', 'pendidikan'])
                ->whereNotIn('user_id', $userSudahDiputuskan)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Ambil aktivitas terbaru (keputusan terbaru)
            $recentActivities = Keputusan::with(['user'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return response()->json([
                'stats' => [
                    'total_pendaftar' => DataDiri::count(),
                    'pending_evaluasi' => $totalPendingEvaluasi,
                    'disetujui' => $keputusanStats->get(1, 0),
                    'ditolak' => $keputusanStats->get(0, 0),
                    'transfer_nilai' => $totalTransferNilai
                ],
                'recent_applicants' => $recentApplicants,
                'recent_activities' => $recentActivities
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load dashboard data'], 500);
        }
    }

    public function pendaftar()
    {
        return view('admin.pendaftar.index');
    }

    public function getData()
    {
        // Ambil semua user_id yang sudah ada di keputusan
        $userSudahDiputuskan = \App\Models\Keputusan::pluck('user_id')->toArray();

        // Ambil data diri yang user_id-nya belum ada di keputusan
        $dataDiri = DataDiri::with(['user', 'pendidikan'])
            ->whereNotIn('user_id', $userSudahDiputuskan)
            ->get();

        // Add status information for each user
        $dataDiri->each(function ($diri) {
            // Get DataDiri status
            $diri->data_diri_status = $diri->status;

            // Get Assessment status
            $assessment = \App\Models\Assessment::where('user_id', $diri->user_id)->first();
            $diri->assessment_status = $assessment ? $assessment->status : null;

            // Get TransferNilai status - check if all transfer nilai for this user have 'sukses' status
            $transferNilai = \App\Models\TransferNilai::whereHas('transkripNilai', function ($query) use ($diri) {
                $query->where('user_id', $diri->user_id);
            })->get();

            if ($transferNilai->count() > 0) {
                // If all transfer nilai have status 'sukses', then it's sukses, otherwise not
                $allSukses = $transferNilai->every(function ($transfer) {
                    return $transfer->status === 'sukses';
                });
                $diri->transfer_nilai_status = $allSukses ? 'sukses' : 'pending';
            } else {
                $diri->transfer_nilai_status = null;
            }

            // Determine if evaluation buttons should be enabled
            $diri->can_evaluate = ($diri->data_diri_status === 'sukses' &&
                $diri->assessment_status === 'sukses' &&
                $diri->transfer_nilai_status === 'sukses');
        });

        return response()->json($dataDiri);
    }

    public function getModalData($id)
    {
        $diri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])->findOrFail($id);
        return response()->json($diri);
    }

    public function transferNilai($id, Request $request)
    {
        $kurikulum = Kurikulum::all();
        $transkrip = TranskripNilai::where('user_id', $id)->get();

        // Get existing transfer nilai for this user to prevent duplicates
        $existingTransfers = \App\Models\TransferNilai::whereHas('transkripNilai', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->with(['kurikulum', 'transkripNilai'])->get();

        // Check if user already has transfer nilai data
        $hasTransferNilai = $existingTransfers->count() > 0;

        // Calculate SKS totals
        $totalSksTrpl = $kurikulum->sum('sks');
        $transferredSks = $existingTransfers->sum(function ($transfer) {
            return $transfer->kurikulum->sks ?? 0;
        });
        $remainingSks = $totalSksTrpl - $transferredSks;

        if ($request->isMethod('post')) {
            $asesor_id = Auth::check() ? Auth::user()->id : 2;
            $kurikulum_ids = $request->input('kurikulum', []);
            $nilai_trpl = $request->input('nilai_trpl', []);
            $keterangan = $request->input('keterangan', []);
            $transkrip_ids = $request->input('transkrip_id', []);

            $savedCount = 0;
            foreach ($kurikulum_ids as $i => $kurikulum_id) {
                // Only save if kurikulum_id is not null or empty
                if (!empty($kurikulum_id)) {
                    \App\Models\TransferNilai::create([
                        'asesor_id' => $asesor_id,
                        'kurikulum_id' => $kurikulum_id,
                        'transkrip_id' => $transkrip_ids[$i] ?? null,
                        'nilai' => $nilai_trpl[$i] ?? null,
                        'catatan' => $keterangan[$i] ?? null,
                        'status' => 1,
                    ]);
                    $savedCount++;
                }
            }

            $message = $savedCount > 0
                ? "Data transfer nilai berhasil disimpan! ($savedCount mata kuliah ditransfer)"
                : "Tidak ada mata kuliah yang dipilih untuk ditransfer.";

            return redirect()->route('admin.pendaftar.index')->with('success', $message);
        }

        return view('admin.pendaftar.transfer_nilai', [
            'id' => $id,
            'kurikulum' => $kurikulum,
            'transkrip' => $transkrip,
            'existingTransfers' => $existingTransfers,
            'totalSksTrpl' => $totalSksTrpl,
            'transferredSks' => $transferredSks,
            'remainingSks' => $remainingSks,
            'hasTransferNilai' => $hasTransferNilai,
            'transferNilai' => $existingTransfers, // Data untuk tampilan statis
        ]);
    }

    public function storeKeputusan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'status' => 'required|boolean',
            'catatan' => 'nullable|string',
        ]);
        $asesor_id = Auth::check() ? Auth::user()->id : 2;
        $keputusan = \App\Models\Keputusan::create([
            'user_id' => $request->user_id,
            'asesor_id' => $asesor_id,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);
        return response()->json(['success' => true, 'keputusan' => $keputusan]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        try {
            $user = Auth::user();
            User::where('id', $user->id)->update([
                'user_name' => $request->user_name,
                'email' => $request->email,
            ]);

            // Refresh the user instance
            $user = User::find($user->id);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui!',
                'user' => $user
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        try {
            $user = Auth::user();

            // Delete old photo if exists
            if ($user->photo && file_exists(public_path('storage/profile_photos/' . $user->photo))) {
                unlink(public_path('storage/profile_photos/' . $user->photo));
            }

            $photo = $request->file('photo');
            $photoName = time() . '_' . $user->id . '.' . $photo->getClientOriginalExtension();

            // Create directory if not exists
            $uploadPath = public_path('storage/profile_photos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $photo->move($uploadPath, $photoName);

            User::where('id', $user->id)->update(['foto' => $photoName]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profile berhasil diperbarui!',
                'photo_url' => asset('storage/profile_photos/' . $photoName)
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

    /**
     * Update status for all transfer nilai of a specific user.
     */
    public function updateTransferStatus(Request $request, $userId)
    {
        $request->validate([
            'status' => 'required|in:prosess,sukses,pending,gagal'
        ]);

        try {
            // Get all transfer nilai for this user through transkrip_nilai relationship
            $updated = \App\Models\TransferNilai::whereHas('transkripNilai', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->update(['status' => $request->status]);

            // If AJAX request, return JSON
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status transfer nilai berhasil diperbarui',
                    'updated_count' => $updated
                ]);
            }

            // For regular form submission, redirect back with success message
            return redirect()->back()->with('success', 'Status transfer nilai berhasil diperbarui');
        } catch (\Exception $e) {
            // If AJAX request, return JSON error
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui status transfer nilai: ' . $e->getMessage()
                ], 500);
            }

            // For regular form submission, redirect back with error message
            return redirect()->back()->with('error', 'Gagal memperbarui status transfer nilai: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function datadiri($id)
    {
        try {
            $dataDiri = DataDiri::with(['user', 'pendidikan', 'pengalamanKerja'])
                ->findOrFail($id);

            return view('admin.pendaftar.datadiri', compact('dataDiri'));
        } catch (\Exception $e) {
            return redirect()->route('admin.pendaftar.index')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Update status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:prosess,sukses,pending,gagal'
            ]);

            $dataDiri = DataDiri::findOrFail($id);
            $dataDiri->update(['status' => $request->status]);

            $statusLabels = [
                'prosess' => 'Proses',
                'sukses' => 'Sukses',
                'pending' => 'Pending',
                'gagal' => 'Gagal'
            ];

            return redirect()->back()->with('success', 'Status berhasil diubah menjadi: ' . $statusLabels[$request->status]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}
