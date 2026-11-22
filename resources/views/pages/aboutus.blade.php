@extends('layouts.theme')

@section('title')
    About Us
@endsection

@section('content')
    <main>
        <header class="py-5" style="background: #000;">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <img src="{{ URL::asset('frontend/assets/PATRIOT.png') }}" alt="" class="img-fluid"
                            width="400" height="400">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <h3 style="color: #fff">Sekilas Pione</h3>
                        <div id="carouselContent" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">
                                <div class="carousel-item active text-center p-4 text-white">
                                    <p>Pajero Indonesia ONE disingkat PI-ONE dan dibaca ‘piwan’
                                        didirikan dengan tujuan
                                        membangun jejaring silaturahmi pemilik dan pengguna kendaraan Mitsubishi Pajero
                                        khususnya Pajero Sport untuk bersinergi dan berbagi untuk kemajuan dan kemanfaatan
                                        bersama serta peduli sesama.
                                    </p>
                                </div>
                                <div class="carousel-item text-center p-4 text-white">
                                    <p>PI-ONE di inisiasi oleh beberapa orang pemilik kendaraan Mitsubishi Pajero Sport yang
                                        ingin memberikan pilihan kepada para pemilik dan pengguna kendaraan Mitsubishi
                                        Pajero dari semua generasi dan varian di seluruh Indonesia untuk bersilaturahmi dan
                                        bersinergi bersama dalam sebuah klub dengan suasana yang nyaman, guyub dan penuh
                                        persaudaraan dan kekeluargaan.
                                    </p>
                                </div>
                                <div class="carousel-item text-center p-4 text-white">
                                    <p>PI-ONE PATRIOT adalah salah satu chapter di PI-ONE untuk wilayah Bekasi Raya dan
                                        sekitarnya ; Cibitung, Cikarang, Karawang & Purwakarta
                                    </p>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselContent" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon mr-5" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselContent" role="button" data-slide="next">
                                <span class="carousel-control-next-icon ml-5" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <a href="#history" class="btn btn-register text-white mt-3 mr-3 fw-700">Next</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="container py-2" id="history">
            <div class="col-12 py-3">
                <center>
                    <h1 class="h5 fw-700 mb-0" style="width: 1200px">PI-ONE merupakan perkumpulan berbadan hukum yang telah
                        disahkan oleh KemenkumHAM Nomor : 0028420.AH.01.07 Tahun 2015 dan terdaftar di Ikatan Motor
                        Indonesia
                        (IMI) sebagai Anggota Asosiasi Klasifikasi B. Diperbaharui dengan Kepengurusan yang baru sesuai SK
                        Kemenkum HAM Nomor : AHU-0000988.AH.01.08
                    </h1>
                </center>
            </div>
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <img src="{{ URL::asset('frontend/assets/Picture1.png') }}" class="img-fluid" width="300"
                        height="400">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <img src="{{ URL::asset('frontend/assets/Picture2.png') }}" class="img-fluid" width="300"
                        height="400">
                </div>
            </div>
            <div class="col-12 py-5">
                <center>
                    <h1 class="h5 fw-700 mb-2" style="width: 1100px">PI-ONE dideklarasikan secara resmi pada tanggal 17
                        Agustus 2013 yang lalu dan saat ini anggota PI1 telah mencapai lebih dari 5000 anggota dan 33
                        chapters tersebar di
                        seluruh Indonesia, dari Aceh hingga Nusa Tenggara Timur.
                    </h1>
                </center>
                <img src="{{ URL::asset('frontend/assets/Picture3.jpg') }}" alt="Peta Chapters" class="img-fluid">
            </div>
            <div class="text-center mb-3">
                <a href="#kegiatan" class="btn btn-register text-white text-center fw-700">Next</a>
            </div>
        </section>
        <section class="container" id="kegiatan">
            <h1 class="h3 fw-900 text-center">Kegiatan PI-ONE</h1>
            <h3 class="h5 fw-700 text-center">TOURING | KOPDAR | RALLY WISATA | BAKSOS</h3>
            <center>
                <p class="fw-700" style="width: 1100px;">
                    Berbagai kegiatan telah dilakukan oleh PI-ONE yang sesuai dengan visi dan misi berupa touring, coaching
                    clinic, bakti sosial dan peduli lingkungan. Kegiatan dilakukan secara nasional maupun lokal oleh
                    masing-masing chapter.
                </p>
            </center>
            <section class="mb-5">
                <div class="owl-carousel feature-carousel dots-inside owl-theme mt-5">
                    <div class="card">
                        <img class="item" src="{{ URL::asset('frontend/assets/Picture4.jpg') }}"
                            alt="First slide" style="min-width: 370px; height: 15rem">
                    </div>
                    <div class="card">
                        <img class="item" src="{{ URL::asset('frontend/assets/Picture5.jpg') }}"
                            alt="First slide" style="min-width: 370px; height: 15rem">
                    </div>
                    <div class="card">
                        <img class="item" src="{{ URL::asset('frontend/assets/Picture6.jpg') }}"
                            alt="First slide" style="min-width: 370px; height: 15rem">
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script>
        jQuery(document).ready(function($) {
            $('.feature-carousel').owlCarousel({
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 8000,
                loop: true,
                margin: 15,
                center: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    991: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    }
                }
            })
        })
    </script>
@endsection
