<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail Buku</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('rom/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rom/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('rom/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('rom/css/jquery.mCustomScrollbar.min.css') }}">
</head>

<body>
    <div class="header_section">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand">
                    <img src="{{ asset('uploads/logoo (5).png') }}"
                         height="100px" width="150px">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/beranda') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/beranda#buku') }}">Buku</a>
                        </li>
                    </ul>

                    <form class="form-inline my-2 my-lg-0">
                        <div class="login_bt">
                            <a href="{{ url('/login') }}">
                                Login <span style="color: #222222;"><i class="fa fa-user"></i></span>
                            </a>
                        </div>
                    </form>

                </div>
            </nav>

        </div>

        <!-- Detail Section -->
        <div class="banner_section layout_padding mb-5">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <div class="about_img">
                            <img src="{{ asset('uploads/' . $buku->foto) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h1 class="about_taital">{{ $buku->judul }}</h1>

                        <p class="about_text">Pengarang: {{ $buku->pengarang }}</p>
                        <p class="about_text">Tahun Terbit: {{ $buku->tahun_terbit }}</p>
                        <p class="about_text">Keterangan: {{ $buku->keterangan }}</p>
                        <p class="about_text">Stok: {{ $buku->stok }}</p>

                        <div class="cart_bt">
                            <a href="{{ url('/beranda') }}">Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="copyright_section mt-5">
        <div class="container">
            <p class="copyright_text">
                2025 All Rights Reserved. Design by Free Html Templates | Distributed by ThemeWagon
            </p>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('rom/js/jquery.min.js') }}"></script>
    <script src="{{ asset('rom/js/popper.min.js') }}"></script>
    <script src="{{ asset('rom/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('rom/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('rom/js/plugin.js') }}"></script>
    <script src="{{ asset('rom/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('rom/js/custom.js') }}"></script>

</body>

</html>