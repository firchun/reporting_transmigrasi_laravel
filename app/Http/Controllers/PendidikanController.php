<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendidikanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pendikan',
        ];
        return view('admin.pendidikan.index', $data);
    }
    public function getPendidikanDataTable()
    {
        $pendidikan = Pendidikan::orderByDesc('id');

        return DataTables::of($pendidikan)
            ->addColumn('action', function ($pendidikan) {
                return view('admin.pendidikan.components.actions', compact('pendidikan'));
            })
            ->addColumn('pendidikan', function ($pendidikan) {
                return '<strong>' . $pendidikan->nama_pendidikan . '</strong><br><small>' . $pendidikan->kepanjangan . '</small>';
            })

            ->rawColumns(['action', 'pendidikan'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_pendidikan' => 'required|string|max:255',
            'kepanjangan' => 'string|max:255',

        ]);

        $pendidikanData = [
            'nama_pendidikan' => $request->input('nama_pendidikan'),
            'kepanjangan' => $request->input('kepanjangan'),

        ];

        if ($request->filled('id')) {
            $pendidikan = Pendidikan::find($request->input('id'));
            if (!$pendidikan) {
                return response()->json(['message' => 'pendidikan not found'], 404);
            }

            $pendidikan->update($pendidikanData);
            $message = 'pendidikan updated successfully';
        } else {
            Pendidikan::create($pendidikanData);
            $message = 'pendidikan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $pendidikan = Pendidikan::find($id);

        if (!$pendidikan) {
            return response()->json(['message' => 'Pendidikan not found'], 404);
        }

        $pendidikan->delete();

        return response()->json(['message' => 'Pendidikan deleted successfully']);
    }
    public function edit($id)
    {
        $pendidikan = Pendidikan::find($id);

        if (!$pendidikan) {
            return response()->json(['message' => 'pendidikan not found'], 404);
        }

        return response()->json($pendidikan);
    }
}
