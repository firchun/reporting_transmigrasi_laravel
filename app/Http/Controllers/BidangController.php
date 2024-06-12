<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BidangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Bidang',
        ];
        return view('admin.bidang.index', $data);
    }
    public function getBidangDataTable()
    {
        $Bidang = Bidang::orderByDesc('id');

        return DataTables::of($Bidang)
            ->addColumn('action', function ($Bidang) {
                return view('admin.Bidang.components.actions', compact('Bidang'));
            })
            ->addColumn('bidang', function ($Bidang) {
                return '<strong>' . $Bidang->nama_bidang . '</strong><br><small>' . $Bidang->keterangan_bidang . '</small>';
            })

            ->rawColumns(['action', 'bidang'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'keterangan_bidang' => 'string|max:255',

        ]);

        $BidangData = [
            'nama_bidang' => $request->input('nama_bidang'),
            'keterangan_bidang' => $request->input('keterangan_bidang'),

        ];

        if ($request->filled('id')) {
            $Bidang = Bidang::find($request->input('id'));
            if (!$Bidang) {
                return response()->json(['message' => 'Bidang not found'], 404);
            }

            $Bidang->update($BidangData);
            $message = 'Bidang updated successfully';
        } else {
            Bidang::create($BidangData);
            $message = 'Bidang created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Bidang = Bidang::find($id);

        if (!$Bidang) {
            return response()->json(['message' => 'Bidang not found'], 404);
        }

        $Bidang->delete();

        return response()->json(['message' => 'Bidang deleted successfully']);
    }
    public function edit($id)
    {
        $Bidang = Bidang::find($id);

        if (!$Bidang) {
            return response()->json(['message' => 'Bidang not found'], 404);
        }

        return response()->json($Bidang);
    }
}
