<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perpustakaan Agape</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('rom/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('rom/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('rom/css/responsive.css') }}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('rom/css/jquery.mCustomScrollbar.min.css') }}">

    <style>
        /* --- Tambahan perapian layout --- */
        .banner_img img {
            width: 100%;
            max-width: 350px;
            height: auto;
            display: block;
            margin: auto;
        }

        .banner_section {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        #buku .cream_section_2 {
            margin-top: 20px;
        }

        .cream_taital {
            text-align: center !important;
        }

        .cream_text {
            text-align: center !important;
            margin-bottom: 40px;
        }

        .cream_box {
            text-align: center;
        }

        .price_text {
            font-weight: bold;
            margin-top: 10px;
        }

        .cart_bt {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand">
                    <img src="{{ asset('uploads/logoo (5).png') }}" height="100px" width="150px">
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
                            <a class="nav-link" href="#buku">Buku</a>
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

        <!-- banner section -->
        <div class="banner_section layout_padding home mb-5">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row align-items-center">
                                <div class="col-sm-6 mt-5">
                                    <h1 class="banner_taital">Never Alone</h1>
                                    <p class="banner_text">
                                        Max Lacudo menciptakan buku ini karena dia sudah merasakan kesendirian...
                                    </p>
                                    <div class="started_text"><a href="#buku">Selengkapnya</a></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="banner_img">
                                        <img src="{{ asset('uploads/1765503141.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end banner -->
    </div>

    <!-- buku section -->
    <div class="cream_section layout_padding mt-5" id="buku" style="margin-bottom: 120px;">
        <div class="container">
            <center>
            <h1 class="cream_taital">Buku Yang Ada di Perpustakaan</h1>
            </center>
            <p class="cream_text">Selamat melihat buku yang ada :)</p>

            <div class="cream_section_2">
                <div class="row">

                    @foreach ($buku as $b)
                        <div class="col-md-4 mb-4">
                            <div class="cream_box">
                                <div class="cream_img">
                                    <img src="{{ asset('uploads/' . $b->foto) }}" width="100%" height="250px"
                                        style="object-fit: cover;">
                                </div>

                                <div class="price_text">Stok: {{ $b->stok }}</div>
                                <h6 class="strawberry_text">{{ $b->judul }}</h6>

                                <div class="cart_bt">
                                    <a href="{{ url('/beranda/detail/' . $b->id_buku) }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="copyright_section">
        <center>
            <div class="location_text">
                <ul>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Tanya Kapan Saja dan Dimana Saja</a></li>
                    <li><a href="#"><i class="fa fa-phone"></i> Wa : 0895562323910</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> Email : agape@gmail.com</a></li>
                </ul>
            </div>
        </center>

        <div class="container">
            <p class="copyright_text">
                Copyright © 2025. Made with gugge and love
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
