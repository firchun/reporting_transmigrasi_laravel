<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Customer;
use App\Models\LowonganKerja;
use App\Models\Pendidikan;
use App\Models\Perusahaan;
use App\Models\TenagaAsing;
use App\Models\TenagaLokal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->to('/login');
        }
        if (Auth::user()->role != 'Perusahaan') {
            $data = [
                'title' => 'Dashboard',
                'admin' => User::where('role', 'Admin')->count(),
                'bidang' => User::where('role', 'Bidang')->count(),
                'perusahaan' => User::where('role', 'Perusahaan')->count(),
                'data_bidang' => Bidang::count(),
                'data_pendidikan' => Pendidikan::count(),
                'loker' => LowonganKerja::count(),
                'oap' => TenagaLokal::where('tenaga_kerja', 'OAP')->count(),
                'non_oap' => TenagaLokal::where('tenaga_kerja', 'NON-OAP')->count(),
                'tka' => TenagaAsing::count(),
            ];
        } else {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            if ($perusahaan) {

                $data = [
                    'title' => 'Dashboard',
                    'tkl' => TenagaLokal::where('id_perusahaan', $perusahaan->id)->count(),
                    'tka' => TenagaAsing::where('id_perusahaan', $perusahaan->id)->count(),
                    'loker' => LowonganKerja::where('id_perusahaan', $perusahaan->id)->count(),
                    'oap' => TenagaLokal::where('id_perusahaan', $perusahaan->id)->where('tenaga_kerja', 'OAP')->count(),
                    'non_oap' => TenagaLokal::where('id_perusahaan', $perusahaan->id)->where('tenaga_kerja', 'NON-OAP')->count(),
                ];
            } else {
                $data = [
                    'title' => 'Dashboard'
                ];
            }
        }
        return view('admin.dashboard', $data);
    }
    public function grafik()
    {

        $tenaga_asing = TenagaAsing::query();

        $tenaga_lokal = TenagaLokal::query();
        if (Auth::user()->role == 'Perusahaan') { // Perbaiki perbandingan
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $tenaga_asing = $tenaga_asing->where('id_perusahaan', $perusahaan->id);
            $tenaga_lokal = $tenaga_lokal->where('id_perusahaan', $perusahaan->id);
        }
        // Mengelompokkan data berdasarkan bulan
        $tenaga_asing = $tenaga_asing
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    sprintf('%d-%02d', $item->year, $item->month) => $item->count
                ];
            });

        $tenaga_lokal = $tenaga_lokal
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    sprintf('%d-%02d', $item->year, $item->month) => $item->count
                ];
            });
        $data = [
            'tenaga_asing' => $tenaga_asing,
            'tenaga_lokal' => $tenaga_lokal,
        ];
        return response()->json($data);
    }
}
