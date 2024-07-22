<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Customer;
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
        if (Auth::user()->role != 'Perusahaan') {
            $data = [
                'title' => 'Dashboard',
                'admin' => User::where('role', 'Admin')->count(),
                'bidang' => User::where('role', 'Bidang')->count(),
                'perusahaan' => User::where('role', 'Perusahaan')->count(),
                'data_bidang' => Bidang::count(),
                'data_pendidikan' => Pendidikan::count(),
            ];
        } else {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $data = [
                'title' => 'Dashboard',
                'tkl' => TenagaLokal::where('id_perusahaan', $perusahaan->id)->count(),
                'tka' => TenagaAsing::where('id_perusahaan', $perusahaan->id)->count(),
            ];
        }
        return view('admin.dashboard', $data);
    }
}
