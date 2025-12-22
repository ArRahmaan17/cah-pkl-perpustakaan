@extends('temp.temp')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <!-- Judul -->
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat Datang di Perpustakaan Agape</h3>
                        <h6 class="font-weight-normal mb-0">
                            Tempat yang membuat kita bijaksana dan mengerti hal baru
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo + Statistik -->
        <div class="row">

            <!-- Logo Card -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto mb-5 text-center">
                        <img style="margin-bottom: 80px;" height="100px" 
                             src="{{ asset('uploads/logoo (5).png') }}" alt="logo">
                        <div class="weather-info"></div>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="col-md-6 grid-margin transparent">
                <div class="row">

                    <!-- Total User -->
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body d-flex align-items-center">
                                <i class="icon-head" style="font-size: 22px; margin-right: 12px;"></i>
                                <div>
                                    <p class="fs-30 mb-1">{{ $user }}</p>
                                    <p class="mb-0">Total User</p>
                                    <small class="text-light">Yang Ada</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Buku -->
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body d-flex align-items-center">
                                <i class="icon-book" style="font-size: 22px; margin-right: 12px;"></i>
                                <div>
                                    <p class="fs-30 mb-1">{{ $buku }}</p>
                                    <p class="mb-0">Total Buku</p>
                                    <small class="text-light">Yang Tersedia Untuk Dipinjam</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Total Peminjaman -->
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body d-flex align-items-center">
                                <i class="icon-contract" style="font-size: 22px; margin-right: 12px;"></i>
                                <div>
                                    <p class="fs-30 mb-1">{{ $peminjaman }}</p>
                                    <p class="mb-0">Total Peminjaman</p>
                                    <small class="text-light">Yang Belum Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
</div>
@endsection
