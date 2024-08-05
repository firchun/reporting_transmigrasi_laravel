<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\Perusahaan;
use App\Models\TenagaAsing;
use App\Models\TenagaLokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

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


    public function printPerusahaan(Request $request)
    {
        $perusahaan = Perusahaan::query();
        $aktif = $request->input('aktif');
        if (isset($aktif)) {
            $aktif = (int) $aktif;
            $perusahaan->where('aktif', $aktif);
        }
        $pdf =  \PDF::loadView('admin.laporan.pdf.print_perusahaan', [
            'data' => $perusahaan->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Perusahaan ' . date('Y-m-d H:i') . '.pdf');
    }
    public function printTenagaAsing(Request $request)
    {
        $id_perusahaan = $request->input('id_perusahaan');
        $tenagaAsing = TenagaAsing::with(['perusahaan']);
        if ($id_perusahaan) {
            $TenagaAsing = $tenagaAsing->where('id_perusahaan', $id_perusahaan);
        }
        if ($request->has('start_date') && $request->start_date) {
            $tenagaAsing->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $tenagaAsing->whereDate('created_at', '<=', $request->end_date);
        }
        if (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $tenagaAsing->where('id_perusahaan', $perusahaan->id);
        }
        $pdf =  \PDF::loadView('admin.laporan.pdf.print_tka', [
            'data' => $tenagaAsing->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Tenaga Asing ' . date('Y-m-d H:i') . '.pdf');
    }
    public function printTenagaLokal(Request $request)
    {
        $id_perusahaan = $request->input('id_perusahaan');
        $TenagaLokal = TenagaLokal::with(['pendidikan', 'perusahaan'])->orderByDesc('id');
        if ($id_perusahaan) {
            $TenagaLokal->where('id_perusahaan', $id_perusahaan);
        }
        if ($request->has('start_date') && $request->start_date) {
            $TenagaLokal->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $TenagaLokal->whereDate('created_at', '<=', $request->end_date);
        }
        if (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $TenagaLokal->where('id_perusahaan', $perusahaan->id);
        }
        $pdf =  \PDF::loadView('admin.laporan.pdf.print_tkl', [
            'data' => $TenagaLokal->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Tenaga Lokal ' . date('Y-m-d H:i') . '.pdf');
    }
    public function printLoker(Request $request)
    {
        $LowonganKerja = LowonganKerja::query();
        if (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $LowonganKerja->where('id_perusahaan', $perusahaan->id);
        } else {
            $id_perusahaan = $request->input('id_perusahaan');
            if ($id_perusahaan) {
                $LowonganKerja->where('id_perusahaan', $id_perusahaan);
            }
            if ($request->has('start_date') && $request->start_date) {
                $LowonganKerja->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && $request->end_date) {
                $LowonganKerja->whereDate('created_at', '<=', $request->end_date);
            }
            if (Auth::user()->role == 'Perusahaan') {
                $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
                $LowonganKerja->where('id_perusahaan', $perusahaan->id);
            }
        }
        $pdf =  \PDF::loadView('admin.laporan.pdf.print_lowongan', [
            'data' => $LowonganKerja->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Perusahaan ' . date('Y-m-d H:i') . '.pdf');
    }
}