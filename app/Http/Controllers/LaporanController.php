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
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.laporan.perusahaan_tka', $data);
    }
    public function perusahaan_tkl()
    {
        $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
        $data = [
            'title' => 'Laporan Data Tenaga Lokal : ' . $perusahaan->nama_perusahaan,
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),

        ];
        return view('admin.laporan.perusahaan_tkl', $data);
    }
    public function all_tka()
    {
        $data = [
            'title' => 'Laporan Data Tenaga Asing ',
        ];
        return view('admin.laporan.all_tka', $data);
    }
    public function all_tkl()
    {
        $data = [
            'title' => 'Laporan Data Tenaga Lokal ',
        ];
        return view('admin.laporan.all_tkl', $data);
    }
    public function all_perusahaan()
    {
        $data = [
            'title' => 'Laporan Data perusahaan ',
        ];
        return view('admin.laporan.all_perusahaan', $data);
    }
    public function all_lowongan_kerja()
    {
        $data = [
            'title' => 'Laporan Data lowongan kerja ',
        ];
        return view('admin.laporan.all_lowongan_kerja', $data);
    }
}
