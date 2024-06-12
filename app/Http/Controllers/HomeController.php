<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Customer;
use App\Models\Pendidikan;
use App\Models\User;
use Illuminate\Http\Request;

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
        $data = [
            'title' => 'Dashboard',
            'admin' => User::where('role', 'Admin')->count(),
            'bidang' => User::where('role', 'Bidang')->count(),
            'perusahaan' => User::where('role', 'Perusahaan')->count(),
            'data_bidang' => Bidang::count(),
            'data_pendidikan' => Pendidikan::count(),

        ];
        return view('admin.dashboard', $data);
    }
}
