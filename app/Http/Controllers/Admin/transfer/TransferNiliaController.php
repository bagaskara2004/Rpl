<?php

namespace App\Http\Controllers\Admin\transfer;

use App\Http\Controllers\Controller;
use App\Models\TransferNilai;
use App\Models\User;
use App\Models\Kurikulum;
use App\Models\TranskripNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransferNiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Transfer.index');
    }

    /**
     * Get data for DataTable - Summary by user
     */
    public function getData()
    {
        try {

            $transferData = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->join('users', 'transkrip_nilai.user_id', '=', 'users.id')
                ->join('kurikulum', 'transfer_nilai.kurikulum_id', '=', 'kurikulum.id')
                ->leftJoin('pendidikan', 'users.id', '=', 'pendidikan.user_id')
                ->select(
                    'users.id',
                    'users.user_name as name',
                    DB::raw('MAX(pendidikan.jurusan) as major'),
                    DB::raw('MAX(pendidikan.prodi) as program_study'),
                    DB::raw('SUM(kurikulum.sks) as total_sks'),
                    DB::raw('COUNT(transfer_nilai.id) as total_transfer')
                )
                ->where('transfer_nilai.status', 1) // 1 = approved
                ->groupBy('users.id', 'users.user_name')
                ->orderBy('users.user_name', 'asc')
                ->get();

            $data = $transferData->map(function ($item, $index) {
                return [
                    'id' => $item->id,
                    'no' => $index + 1,
                    'name' => $item->name,
                    'major' => $item->major ?? 'Belum Diisi',
                    'program_study' => $item->program_study ?? 'Belum Diisi',
                    'total_sks' => $item->total_sks ?? 0,
                    'total_transfer' => $item->total_transfer
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error in TransferNilai getData: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get detailed transfer data for specific user
     */
    public function getDetailTransfer($userId)
    {
        try {
            $transferDetails = DB::table('transfer_nilai')
                ->join('kurikulum', 'transfer_nilai.kurikulum_id', '=', 'kurikulum.id')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->join('users as asesor', 'transfer_nilai.asesor_id', '=', 'asesor.id')
                ->where('transkrip_nilai.user_id', $userId)
                ->where('transfer_nilai.status', 1) // 1 = approved
                ->select(
                    'transfer_nilai.*',
                    'kurikulum.mata_kuliah_trpl',
                    'kurikulum.sks as sks_kurikulum',
                    'transkrip_nilai.mata_kuliah as mata_kuliah_asal',
                    'transkrip_nilai.sks as sks_asal',
                    'transkrip_nilai.nilai_huruf as nilai_huruf_asal',
                    'transkrip_nilai.nilai_angka as nilai_angka_asal',
                    'asesor.user_name as asesor_name'
                )
                ->orderBy('kurikulum.mata_kuliah_trpl', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $transferDetails
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getDetailTransfer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail transfer: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $transferNilai = TransferNilai::with(['kurikulum', 'transkripNilai', 'asesor'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $transferNilai
            ]);
        } catch (\Exception $e) {
            Log::error('Error in TransferNilai show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Test method for debugging
     */
    public function testQuery()
    {
        try {
            $result = [];

            // Test individual table counts
            $result['transfer_count'] = DB::table('transfer_nilai')->count();
            $result['transkrip_count'] = DB::table('transkrip_nilai')->count();
            $result['user_count'] = DB::table('users')->count();
            $result['kurikulum_count'] = DB::table('kurikulum')->count();

            // Test approved transfers
            $result['approved_transfers'] = DB::table('transfer_nilai')->where('status', 1)->count();

            // Test simple join
            $result['simple_join'] = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->where('transfer_nilai.status', 1)
                ->count();

            // Test full query step by step
            $query = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->join('users', 'transkrip_nilai.user_id', '=', 'users.id')
                ->join('kurikulum', 'transfer_nilai.kurikulum_id', '=', 'kurikulum.id')
                ->where('transfer_nilai.status', 1);

            $result['full_join_count'] = $query->count();

            // Test with pendidikan
            $result['with_pendidikan'] = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->join('users', 'transkrip_nilai.user_id', '=', 'users.id')
                ->join('kurikulum', 'transfer_nilai.kurikulum_id', '=', 'kurikulum.id')
                ->leftJoin('pendidikan', 'users.id', '=', 'pendidikan.user_id')
                ->where('transfer_nilai.status', 1)
                ->count();

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Test detailed transfer query for debugging
     */
    public function testDetailQuery($userId = 1)
    {
        try {
            $result = [];

            // Test if user exists
            $user = DB::table('users')->where('id', $userId)->first();
            $result['user_exists'] = $user ? true : false;
            $result['user_data'] = $user;

            // Test if user has transkrip_nilai
            $transkripCount = DB::table('transkrip_nilai')->where('user_id', $userId)->count();
            $result['transkrip_count'] = $transkripCount;

            // Test if there are transfer_nilai for this user
            $transferCount = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->where('transkrip_nilai.user_id', $userId)
                ->count();
            $result['transfer_count'] = $transferCount;

            // Test approved transfers for this user
            $approvedCount = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->where('transkrip_nilai.user_id', $userId)
                ->where('transfer_nilai.status', 1)
                ->count();
            $result['approved_count'] = $approvedCount;

            // Test basic query without complex selects
            $basicQuery = DB::table('transfer_nilai')
                ->join('transkrip_nilai', 'transfer_nilai.transkrip_id', '=', 'transkrip_nilai.id')
                ->where('transkrip_nilai.user_id', $userId)
                ->where('transfer_nilai.status', 1)
                ->select('transfer_nilai.id', 'transkrip_nilai.mata_kuliah')
                ->get();
            $result['basic_query'] = $basicQuery;

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
