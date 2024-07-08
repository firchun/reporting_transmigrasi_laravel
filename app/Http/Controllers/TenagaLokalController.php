<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\TenagaLokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TenagaLokalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Tenaga Lokal',
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.tkl.index', $data);
    }
    public function gettklDataTable($id_perusahaan)
    {
        $TenagaLokal = TenagaLokal::with(['pendidikan', 'perusahaan'])->where('id_perusahaan', $id_perusahaan)->orderByDesc('id');

        return DataTables::of($TenagaLokal)
            ->addColumn('action', function ($TenagaLokal) {
                return view('admin.tkl.components.actions', compact('TenagaLokal'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getalltklDataTable(Request $request)
    {
        $id_perusahaan = $request->input('id_perusahaan');
        $TenagaLokal = TenagaLokal::with(['pendidikan', 'perusahaan'])->orderByDesc('id');
        if ($id_perusahaan) {
            $TenagaLokal->where('id_perusahaan', $id_perusahaan);
        }
        return DataTables::of($TenagaLokal)
            ->addColumn('action', function ($TenagaLokal) {
                return view('admin.tkl.components.actions', compact('TenagaLokal'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_perusahaan' => 'required|string|max:255',
            'id_pendidikan' => 'string|max:255',
            'nama' => 'string|max:255',
            'mulai_kerja' => 'string|max:255',
            'no_kartu_kuning' => 'string|max:255',
            'jenis_kelamin' => 'string|max:255',
            'tenaga_kerja' => 'string|max:255',
            'status_karyawan' => 'string|max:255',
            'tampat_lahir' => 'string|max:255',
            'tanggal_lahir' => 'string|max:255',
            'jabatan' => 'string|max:255',
            'LPTKS' => 'string|max:255',
        ]);

        $tenagaLokalData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'id_pendidikan' => $request->input('id_pendidikan'),
            'nama' => $request->input('nama'),
            'mulai_kerja' => $request->input('mulai_kerja'),
            'no_kartu_kuning' => $request->input('no_kartu_kuning'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tenaga_kerja' => $request->input('tenaga_kerja'),
            'status_karyawan' => $request->input('status_karyawan'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jabatan' => $request->input('jabatan'),
            'LPTKS' => $request->input('LPTKS'),
        ];

        if ($request->filled('id')) {
            $TenagaLokal = TenagaLokal::find($request->input('id'));
            if (!$TenagaLokal) {
                return response()->json(['message' => 'Tenaga lokal not found'], 404);
            }

            $TenagaLokal->update($tenagaLokalData);
            $message = 'Tenaga Lokal updated successfully';
        } else {
            TenagaLokal::create($tenagaLokalData);
            $message = 'Tanaga Lokal created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $TenagaLokal = TenagaLokal::find($id);

        if (!$TenagaLokal) {
            return response()->json(['message' => 'Tenaga Lokal not found'], 404);
        }

        $TenagaLokal->delete();

        return response()->json(['message' => 'Tenaga Lokal deleted successfully']);
    }
    public function edit($id)
    {
        $TenagaLokal = TenagaLokal::find($id);

        if (!$TenagaLokal) {
            return response()->json(['message' => 'Tenaga Lokal not found'], 404);
        }

        return response()->json($TenagaLokal);
    }
}
