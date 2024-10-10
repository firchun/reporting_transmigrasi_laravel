<?php

namespace App\Http\Controllers;

use App\Models\Imta;
use App\Models\LowonganKerja;
use App\Models\Perusahaan;
use App\Models\TenagaAsing;
use App\Models\TenagaLokal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => User::all()
        ];
        return view('admin.users.index', $data);
    }
    public function admin()
    {
        $data = [
            'title' => 'Akun Admin',
            'role' => 'Admin',
            'users' => User::all()
        ];
        return view('admin.users.admin', $data);
    }
    public function kepalaBidang()
    {
        $data = [
            'title' => 'Akun Kepala Bidang',
            'role' => 'Bidang',
            'users' => User::all()
        ];
        return view('admin.users.kepala_bidang', $data);
    }
    public function perusahaan()
    {
        $data = [
            'title' => 'Akun Perusahaan',
            'role' => 'Perusahaan',
            'users' => User::all()
        ];
        return view('admin.users.perusahaan', $data);
    }
    public function getUsersDataTable($role)
    {
        $users = User::where('role', $role)->orderByDesc('id');

        return Datatables::of($users)
            ->addColumn('avatar', function ($user) {
                return view('admin.users.components.avatar', compact('user'));
            })
            ->addColumn('action', function ($user) {
                return view('admin.users.components.actions', compact('user'));
            })
            ->addColumn('role', function ($user) {
                return '<span class="badge bg-label-primary">' . $user->role . '</span>';
            })

            ->rawColumns(['action', 'role', 'avatar'])
            ->make(true);
    }
    public function store(Request $request)
    {
        if ($request->filled('id')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }


        if ($request->filled('id')) {
            $usersData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
            ];
            $user = User::find($request->input('id'));
            if (!$user) {
                return response()->json(['message' => 'user not found'], 404);
            }

            $user->update($usersData);
            $message = 'user updated successfully';
        } else {
            $usersData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ];

            User::create($usersData);
            $message = 'user created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function edit($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($User);
    }
    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Cek apakah user ada atau tidak
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cari perusahaan yang terkait dengan user
        $perusahaan = Perusahaan::where('id_user', $id)->get();

        // Loop melalui setiap perusahaan yang dimiliki user
        foreach ($perusahaan as $item) {
            // Cari tenaga asing yang terkait dengan perusahaan
            $tenagaAsing = TenagaAsing::where('id_perusahaan', $item->id)->get();

            // Hapus data IMTA yang terkait dengan tenaga asing
            foreach ($tenagaAsing as $tenagaAsingItem) {
                Imta::where('id_tenaga_asing', $tenagaAsingItem->id)->delete();
            }

            // Hapus tenaga asing itu sendiri
            TenagaAsing::where('id_perusahaan', $item->id)->delete();

            // Hapus tenaga lokal terkait
            TenagaLokal::where('id_perusahaan', $item->id)->delete();

            // Hapus lowongan kerja terkait
            LowonganKerja::where('id_perusahaan', $item->id)->delete();
        }

        // Hapus perusahaan terkait
        foreach ($perusahaan as $item) {
            $item->delete();
        }

        // Hapus user itu sendiri
        $user->delete();

        // Kembalikan respons sukses
        return response()->json(['message' => 'User deleted successfully']);
    }
}
