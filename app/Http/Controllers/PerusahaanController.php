<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function perusahaan()
    {
        $data = [
            'title' => 'Data Perusahaan',
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.perusahaan.perusahaan', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'string|max:255',
            'tahun_berdiri' => 'string|max:255',
            'jenis_usaha' => 'string|max:255',
        ]);

        $perusahaanData = [
            'nama_perusahaan' => $request->input('nama_perusahaan'),
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
}
