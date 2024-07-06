<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function perusahaan_tka()
    {
        $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
        $data = [
            'title' => 'Laporan Data Tenaga Asing : ' . $perusahaan->nama_perusahaan,

        ];
        return view('admin.laporan.perusahaan_tka', $data);
    }
    public function perusahaan_tkl()
    {
        $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
        $data = [
            'title' => 'Laporan Data Tenaga Lokal : ' . $perusahaan->nama_perusahaan,

        ];
        return view('admin.laporan.perusahaan_tkl', $data);
    }
}
