@extends('layouts.backend.admin')

@section('content')
    <div class="jumbotron text-center">
        <h5>Selamat Datang di</h5>
        <div class="d-flex justify-content-center  my-3">
            <img src="{{ asset('img/merauke.png') }}" alt="logo" style="width: auto; height:60px;">
            <h1 class="text-warning mx-2" style="font-size: 50px;">| E-REPORT</h1>
        </div>
        <h3 class="text-primary">{{ env('APP_DESC') }}</h3>
    </div>
    <hr>
    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Bidang')
        <div class="row justify-content-center align-items-center">
            @include('admin.dashboard_component.card1', [
                'count' => $admin,
                'title' => 'Admin',
                'subtitle' => 'Total akun admin',
                'color' => 'primary',
                'icon' => 'user',
            ])

            @include('admin.dashboard_component.card1', [
                'count' => $perusahaan,
                'title' => 'Perusahaan',
                'subtitle' => 'Total akun perusahaan',
                'color' => 'primary',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $data_bidang,
                'title' => 'Bidang',
                'subtitle' => 'Total bidang',
                'color' => 'warning',
                'icon' => 'folder',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $data_pendidikan,
                'title' => 'Pendidikan',
                'subtitle' => 'Total data pendidikan',
                'color' => 'warning',
                'icon' => 'folder',
            ])

        </div>
    @elseif(Auth::user()->role == 'Perusahaan')
        @include('admin.dashboard_component.perusahaan')
    @endif
@endsection
