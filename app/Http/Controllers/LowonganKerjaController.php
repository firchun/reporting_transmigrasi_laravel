<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LowonganKerjaController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Lowongan Pekerjaan',
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.lowongan_kerja.index', $data);
    }
    public function getAllLowonganKerjaDataTable(Request $request)
    {
        $id_perusahaan = $request->input('id_perusahaan');
        $loker = LowonganKerja::with(['perusahaan'])->orderByDesc('id');
        if (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('id_user', Auth::id())->first();
            $loker = $loker->where('id_perusahaan', $perusahaan->id);
        } else {
            if ($id_perusahaan) {
                $loker = $loker->where('id_perusahaan', $id_perusahaan);
            }
            if ($request->has('start_date') && $request->start_date) {
                $loker->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && $request->end_date) {
                $loker->whereDate('created_at', '<=', $request->end_date);
            }
        }
        return DataTables::of($loker)
            ->addColumn('brosur', function ($loker) {
                return '<a  href="' . Storage::url($loker->brosur) . '" target="__blank"><img src="' . Storage::url($loker->brosur) . '" style="width: 100px;height: 100px;object-fit:cover;"></a>';
            })
            ->addColumn('action', function ($loker) {
                return view('admin.lowongan_kerja.components.actions', compact('loker'));
            })
            ->rawColumns(['brosur', 'action'])
            ->make(true);
    }
    public function getLowonganKerjaDataTable($id_perusahaan)
    {
        $loker = LowonganKerja::where('id_perusahaan', $id_perusahaan)->orderByDesc('id');

        return DataTables::of($loker)
            ->addColumn('action', function ($loker) {
                return view('admin.lowongan_kerja.components.actions', compact('loker'));
            })
            ->addColumn('brosur', function ($loker) {
                return '<a href="' . Storage::url($loker->brosur) . '" target="__blank"><img src="' . Storage::url($loker->brosur) . '" style="width: 100px;height: 100px;object-fit:cover;"></a>';
            })
            ->rawColumns(['action', 'brosur'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'required|string',
            'persyaratan' => 'required|string',
            'pengiriman_berkas' => 'required|string',
            'tanggal_buka' => 'required|string',
            'tanggal_tutup' => 'required|string',
            'brosur' => 'nullable|file',
        ]);

        $lokerData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'posisi' => $request->input('posisi'),
            'deskripsi_pekerjaan' => $request->input('deskripsi_pekerjaan'),
            'kualifikasi' => $request->input('kualifikasi'),
            'persyaratan' => $request->input('persyaratan'),
            'pengiriman_berkas' => $request->input('pengiriman_berkas'),
            'tanggal_buka' => $request->input('tanggal_buka'),
            'tanggal_tutup' => $request->input('tanggal_tutup'),
        ];
        if ($request->hasFile('brosur')) {
            // Simpan file brosur
            $file = $request->file('brosur');
            $filePath = $file->store('brosur', 'public'); // Simpan ke storage/app/public/brosur
            $lokerData['brosur'] = $filePath; // Simpan path file di data yang akan diinsert/update
        }

        if ($request->filled('id')) {
            $LowonganKerja = LowonganKerja::find($request->input('id'));
            if (!$LowonganKerja) {
                return response()->json(['message' => 'Lowongan Kerja not found'], 404);
            }

            $LowonganKerja->update($lokerData);
            $message = 'Lowongan Kerja updated successfully';
        } else {
            LowonganKerja::create($lokerData);
            $message = 'Lowongan Kerja created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $loker = LowonganKerja::find($id);

        if (!$loker) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $loker->delete();

        return response()->json(['message' => 'data deleted successfully']);
    }
    public function edit($id)
    {
        $LowonganKerja = LowonganKerja::find($id);

        if (!$LowonganKerja) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json($LowonganKerja);
    }
    public function detail($id)
    {
        $LowonganKerja = LowonganKerja::with(['perusahaan'])->find($id);
        $data = [
            'title' => 'Detail Formulir Lowongan Kerja ',
            'loker' => $LowonganKerja,
        ];

        return view('admin.lowongan_kerja.detail', $data);
    }
    public function print($id)
    {
        $LowonganKerja = LowonganKerja::with(['perusahaan'])->find($id);
        // dd($imageUrl);

        $pdf =  \PDF::loadView('admin.lowongan_kerja.print', [
            'data' => $LowonganKerja,
        ])->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan detail Lowongan kerja ' . date('Y-m-d H:i') . '.pdf');
    }
}