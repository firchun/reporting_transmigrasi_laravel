<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\Perusahaan;
use App\Models\TenagaAsing;
use App\Models\TenagaLokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PerusahaanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Perusahaan',
        ];
        return view('admin.perusahaan.index', $data);
    }
    public function perusahaan()
    {
        $data = [
            'title' => 'Data Perusahaan',
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.perusahaan.perusahaan', $data);
    }
    public function getPerusahaanDataTable(Request $request)
    {
        $Perusahaan = Perusahaan::orderByDesc('id');
        $aktif = $request->input('aktif');
        if (isset($aktif)) {
            $aktif = (int) $aktif;
            $Perusahaan->where('aktif', $aktif);
        }
        return DataTables::of($Perusahaan)

            ->addColumn('jumlah_tka', function ($Perusahaan) {
                $tka = TenagaAsing::where('id_perusahaan', $Perusahaan->id)->count();
                return $tka;
            })
            ->addColumn('jumlah_tkl', function ($Perusahaan) {
                $tkl = TenagaLokal::where('id_perusahaan', $Perusahaan->id)->count();
                return $tkl;
            })
            ->addColumn('jumlah_oap', function ($Perusahaan) {
                $tkl = TenagaLokal::where('id_perusahaan', $Perusahaan->id)->where('tenaga_kerja', 'OAP')->count();
                return $tkl;
            })
            ->addColumn('jumlah_loker', function ($Perusahaan) {
                $loker = LowonganKerja::where('id_perusahaan', $Perusahaan->id)->count();
                return $loker;
            })
            ->addColumn('action', function ($Perusahaan) {
                $aktif = '<a href="' . route('perusahaan.non-aktifkan', $Perusahaan->id) . '" class="btn btn-danger">Non aktifkan</a>';
                $non_aktif = '<a href="' . route('perusahaan.aktifkan', $Perusahaan->id) . '" class="btn btn-primary">Aktifkan</a>';
                return $Perusahaan->aktif == 1 ? $aktif : $non_aktif;
            })

            ->rawColumns(['jumlah_tka', 'jumlah_tkl', 'action', 'jumlah_oap', 'jumlah_loker'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'string|max:255',
            'tahun_berdiri' => 'string|max:255',
            'jenis_usaha' => 'string|max:255',
            'no_hp' => 'string|max:255',
        ]);

        $perusahaanData = [
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'no_hp' => $request->input('no_hp'),
            'alamat_perusahaan' => $request->input('alamat_perusahaan'),
            'tahun_berdiri' => $request->input('tahun_berdiri'),
            'jenis_usaha' => $request->input('jenis_usaha'),
            'id_user' => Auth::id(),
        ];

        if ($request->filled('id')) {
            $Perusahaan = Perusahaan::find($request->input('id'));
            if (!$Perusahaan) {
                return response()->json(['message' => 'Perusahaan not found'], 404);
            }

            $Perusahaan->update($perusahaanData);
            session()->flash('success', 'Berhasil mengubah data perusahaan');
            return back();
        } else {
            Perusahaan::create($perusahaanData);
            session()->flash('success', 'Berhasil mengajukan data perusahaan');
            return back();
        }
    }
    public function aktifkan($id)
    {
        // Temukan perusahaan berdasarkan ID
        $perusahaan = Perusahaan::find($id);

        // Periksa jika perusahaan ditemukan
        if ($perusahaan) {
            // Set kolom 'aktif' menjadi 1
            $perusahaan->aktif = 1;

            // Simpan perubahan ke database
            $perusahaan->save();

            // Pesan sukses
            session()->flash('success', 'Perusahaan berhasil diaktifkan.');
        } else {
            // Pesan kesalahan jika perusahaan tidak ditemukan
            session()->flash('error', 'Perusahaan tidak ditemukan.');
        }

        // Kembali ke halaman sebelumnya
        return redirect()->back();
    }
    public function non_aktifkan($id)
    {
        // Temukan perusahaan berdasarkan ID
        $perusahaan = Perusahaan::find($id);

        // Periksa jika perusahaan ditemukan
        if ($perusahaan) {
            // Set kolom 'aktif' menjadi 0
            $perusahaan->aktif = 0;

            // Simpan perubahan ke database
            $perusahaan->save();

            // Pesan sukses
            session()->flash('success', 'Perusahaan berhasil dinonaktifkan.');
        } else {
            // Pesan kesalahan jika perusahaan tidak ditemukan
            session()->flash('error', 'Perusahaan tidak ditemukan.');
        }

        // Kembali ke halaman sebelumnya
        return redirect()->back();
    }
}
