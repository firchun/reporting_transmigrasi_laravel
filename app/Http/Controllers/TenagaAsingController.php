<?php

namespace App\Http\Controllers;

use App\Models\Imta;
use App\Models\Perusahaan;
use App\Models\TenagaAsing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TenagaAsingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Tenaga Asing',
            'perusahaan' => Perusahaan::where('id_user', Auth::id())->first(),
        ];
        return view('admin.tka.index', $data);
    }
    public function gettkaDataTable($id_perusahaan)
    {
        $TenagaAsing = TenagaAsing::with(['perusahaan'])->where('id_perusahaan', $id_perusahaan)->orderByDesc('id');

        return DataTables::of($TenagaAsing)
            ->addColumn('action', function ($TenagaAsing) {
                return view('admin.tka.components.actions', compact('TenagaAsing'));
            })
            ->addColumn('no_imta', function ($tenagaAsing) {
                $imtaList = Imta::where('id_tenaga_asing', $tenagaAsing->id)->pluck('no_imta')->toArray();
                $olList = '<ol>';
                foreach ($imtaList as $imta) {
                    $olList .= '<li>' . $imta . '</li>';
                }
                $olList .= '</ol>';
                return $olList;
            })
            ->rawColumns(['action', 'no_imta'])
            ->make(true);
    }
    public function getalltkaDataTable(Request $request)
    {
        $id_perusahaan = $request->input('id_perusahaan');
        $TenagaAsing = TenagaAsing::with(['perusahaan'])->orderByDesc('id');
        if ($id_perusahaan) {
            $TenagaAsing->where('id_perusahaan', $id_perusahaan);
        }
        return DataTables::of($TenagaAsing)
            ->addColumn('action', function ($TenagaAsing) {
                return view('admin.tka.components.actions', compact('TenagaAsing'));
            })
            ->addColumn('no_imta', function ($tenagaAsing) {
                $imtaList = Imta::where('id_tenaga_asing', $tenagaAsing->id)->pluck('no_imta')->toArray();
                $olList = '<ol>';
                foreach ($imtaList as $imta) {
                    $olList .= '<li>' . $imta . '</li>';
                }
                $olList .= '</ol>';
                return $olList;
            })
            ->rawColumns(['action', 'no_imta'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_perusahaan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'kebangsaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_passport' => 'required|string|max:255',
            'no_kitas' => 'required|string|max:255',
            'no_imta.*' => 'required|string|max:255',
            'sponsor' => 'nullable|string|max:255',
        ]);

        $TenagaAsingData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'kebangsaan' => $request->input('kebangsaan'),
            'jabatan' => $request->input('jabatan'),
            'no_passport' => $request->input('no_passport'),
            'no_kitas' => $request->input('no_kitas'),
            'sponsor' => $request->input('sponsor'),
        ];

        if ($request->filled('id')) {
            $TenagaAsing = TenagaAsing::find($request->input('id'));
            if (!$TenagaAsing) {
                return response()->json(['message' => 'Tenaga Asing not found'], 404);
            }

            $TenagaAsing->update($TenagaAsingData);
            $message = 'Tenaga Asing updated successfully';
        } else {
            $TenagaAsing = TenagaAsing::create($TenagaAsingData);

            $noImtas = $request->input('no_imta');

            // Simpan data ke database
            foreach ($noImtas as $noImta) {
                $imta = new Imta();
                $imta->id_tenaga_asing = $TenagaAsing->id;
                $imta->no_imta = $noImta;
                $imta->save();
            }

            $message = 'Tanaga Asing created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $TenagaAsing = TenagaAsing::find($id);

        if (!$TenagaAsing) {
            return response()->json(['message' => 'Tenaga Asing not found'], 404);
        }

        $TenagaAsing->delete();

        return response()->json(['message' => 'Tenaga Asing deleted successfully']);
    }
    public function edit($id)
    {
        $TenagaAsing = TenagaAsing::find($id);

        if (!$TenagaAsing) {
            return response()->json(['message' => 'Tenaga Asing not found'], 404);
        }

        return response()->json($TenagaAsing);
    }
}
