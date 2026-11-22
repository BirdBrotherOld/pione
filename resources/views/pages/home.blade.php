@extends('layouts.theme')

@section('title')
    Pione.id
@endsection
@section('content')
    <main class="flex-shrink-0" style="background: #fff">
        <!-- Header-->
        <header class="py-5" style="background: #000;">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 d-none d-xl-block text-center">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-thumbnail"
                                        src="{{ asset('frontend/assets/asset_pione (1).JPG') }}" alt="First slide"
                                        style="width: 400px; height: 400px">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 img-thumbnail"
                                        src="{{ asset('frontend/assets/asset_pione (2).JPG') }}" alt="Second slide"
                                        style="width: 400px; height: 400px">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 img-thumbnail"
                                        src="{{ asset('frontend/assets/asset_pione (3).JPG') }}" alt="Third slide"
                                        style="width: 400px; height: 400px">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="embed-responsive embed-responsive-4by3">
                            <video width="320" height="240" controls autoplay muted loop>
                                <source src="{{ URL::asset('frontend/assets/videos1.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
        </header>

        <div class="container py-5">
            <div class="col-12">
                <center>
                    <h1 class="h5 fw-900 mb-0" style="width: 1100px">Pajero Indonesia ONE disingkat PI*ONE (piwan) sering
                        disebut "PAJERO ONE"
                        adalah Perkumpulan pemilik dan pengguna kendaraan Mitsubishi Pajero yang didirikan di tahun 2013 dan
                        secara organisasi telah disahkan sebagai Perkumpulan Berbadan Hukum oleh KemenkumHAM RI.</h1>
                </center>
            </div>
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <section class="mb-5">
                    <div class="owl-carousel feature-carousel dots-inside owl-theme mt-5">
                        @foreach ($ads as $item)
                            <div class="card">
                                <a href="{{ $item->url }}" target="_blank">
                                    <img class="item" src="{{ $item->media }}" alt="First slide"
                                        style="min-width: 370px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <!-- Features section-->
            <section class="py-2" id="features"
                style="background: url(https://myclub.id/public/templates/assets/img/hero-bg.png)">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h3 class="fw-700">Our Event</h3>
                        <p class="fw-700">Earn your experience by join our community</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="owl-carousel feature-carousel owl-theme">
                                @foreach ($events as $event)
                                    <div class="card shadow border-0" style="min-height: 370px; max-height: 371px;">
                                        <img class="card-img-top" src="{{ $event->photos }}" alt="{{ $event->name }}"
                                            style="min-height: 219px; max-height: 219px" />
                                        <div class="card-body">
                                            {{-- <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div> --}}
                                            <a class="text-decoration-none link-dark stretched-link"
                                                href="{{ route('detail.event', $event->slug) }}">
                                                <p class="card-title mb-3">{{ Str::limit($event->name, 25, '...') }}</p>
                                            </a>
                                            <p class="product-date mb-1">
                                                @if ($event->is_comingsoon == 1)
                                                    <p class="product-date mb-1">Coming Soon</p>
                                                @else
                                                    <p class="product-date mb-1">
                                                        {{ $event->start_date->isoFormat('D MMMM Y') ?? '' }}
                                                        - {{ $event->end_date->isoFormat('D MMMM Y') ?? '' }}</p>
                                                @endif
                                            <p class="product-location"><i class="bi bi-geo-alt"></i>
                                                {{ $event->location }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('event') }}" class="btn btn-register text-white fw-700">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product preview section-->
            <section class="py-2" id="blog">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder text-uppercase">Marketplace</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row bg-marketplace">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-2 mr-3">
                                <div class="card h-100 shadow border-0" style="width: 175px; height: 260px;">
                                    <img class="card-img-top" src="{{ $product->path }}" style="min-height: 175px;" />
                                    <div class="card-body">
                                        {{-- <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div> --}}
                                        <a class="text-decoration-none link-dark stretched-link"
                                            href="{{ route('detail.product', $product->slug) }}">
                                            <h5 class="card-title mb-1" style="font-size: 16px">{{ $product->name }}</h5>
                                        </a>
                                        <p class="product-price">@currency($product->price)</p>
                                    </div>
                                    <div class="product-rating mb-2">
                                        4.5<i class="bi bi-star-fill pr-3 pl-1" style="color: #ffff00"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
