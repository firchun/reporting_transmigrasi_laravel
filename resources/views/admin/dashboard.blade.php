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
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <canvas id="barChart" width="200" height="100"></canvas>
            </div>
        </div>
    </div>
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
            {{-- @include('admin.dashboard_component.card1', [
                'count' => $data_bidang,
                'title' => 'Bidang',
                'subtitle' => 'Total bidang',
                'color' => 'warning',
                'icon' => 'folder',
            ]) --}}
            {{-- @include('admin.dashboard_component.card1', [
                'count' => $data_pendidikan,
                'title' => 'Pendidikan',
                'subtitle' => 'Total data pendidikan',
                'color' => 'warning',
                'icon' => 'folder',
            ]) --}}
            @include('admin.dashboard_component.card1', [
                'count' => $loker,
                'title' => 'Lowongan Kerja',
                'subtitle' => 'Total data Lowongan Kerja',
                'color' => 'primary',
                'icon' => 'folder',
            ])

        </div>
        <div class="row justify-content-center align-items-center">
            @include('admin.dashboard_component.card1', [
                'count' => $oap,
                'title' => 'Tenaga Lokal OAP',
                'subtitle' => 'Total OAP',
                'color' => 'warning',
                'icon' => 'user',
            ])

            @include('admin.dashboard_component.card1', [
                'count' => $non_oap,
                'title' => 'Tenaga Lokal NON OAP',
                'subtitle' => 'Total NON OAP',
                'color' => 'warning',
                'icon' => 'user',
            ])


        </div>
    @elseif(Auth::user()->role == 'Perusahaan')
        @include('admin.dashboard_component.perusahaan')
    @endif
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        // Get the canvas element
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data dari endpoint
            fetch('/grafik') // Ganti dengan endpoint yang sesuai
                .then(response => response.json())
                .then(data => {
                    const labels = Object.keys(data.tenaga_asing); // Mengambil label dari data
                    const tenagaAsingData = Object.values(data.tenaga_asing); // Mengambil data tenaga asing
                    const tenagaLokalData = Object.values(data.tenaga_lokal); // Mengambil data tenaga lokal

                    // Membuat grafik batang menggunakan Chart.js
                    new Chart(document.getElementById('barChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Tenaga Asing',
                                    data: tenagaAsingData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Tenaga Lokal',
                                    data: tenagaLokalData,
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Bulan'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Jumlah'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
@endpush
