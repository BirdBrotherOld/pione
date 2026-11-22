@extends('layouts.theme')

@section('title')
    Market Place
@endsection

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <section class="ads mb-5">
                    <div class="owl-carousel feature-carousel dots-inside owl-theme mt-5">
                        <div class="card">
                            <a href="https://jke.co.id" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_jke.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://www.cakracorp.co.id/surya-cakra-buana-2" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_scb.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://pt-nugra-telitindo-mandiri-jasa-repair-container.business.site"
                                target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_ntm.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://minyaku.id" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_minyaku.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://www.cakracorp.co.id/surya-cakra-buana-2/perawatan-mobil" target="_blank">
                                <img class="item"
                                    src="https://mypajero.id/cdn/homeSliderTop/ads_cakrahomeservice.png" alt="First slide"
                                    style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://www.cakracorp.co.id/alex-cakra-mandiri" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_acm.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://www.cakracorp.co.id/myamenities" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_myamenities.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://kopipitu.id" target="_blank">
                                <img class="item"
                                    src="https://mypajero.id/cdn/homeSliderTop/kopipitu_banner01.jpg" alt="First slide"
                                    style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://kopipitu.id" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_cakragps.jpg"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                        <div class="card">
                            <a href="https://www.cakracorp.co.id/cakra-jasa-pasific" target="_blank">
                                <img class="item" src="https://mypajero.id/cdn/homeSliderTop/ads_cjp.png"
                                    alt="First slide" style="min-width: 370px;">
                            </a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-8 col-md-8">

                <section class="category mb-5">
                    <h2 class="fw-900 mb-3">Kategori</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Car.svg') }}" alt="">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Oil.svg') }}" alt="">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Otomotif.svg') }}" alt="">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Home.svg') }}" alt="">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Health.svg') }}" alt="">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3 text-center">
                            <img src="{{ URL::asset('frontend/assets/Membership.svg') }}" alt="">
                        </div>
                    </div>
                </section>
                <section class="product-marketplace mb-5">
                    <h2 class="fw-900 mb-3">Produk</h2>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-12 col-12 mb-3">
                                <div class="card h-100 shadow border-0"
                                    style="width: 250px; height: 300px; margin-bottom: 16px">
                                    <img class="card-img-top" src="{{ $product->path }}" width="180" height="180" />
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
                    <div class="d-flex justify-content-center">
                        {!! $products->links() !!}
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-md-4">
                <section class="event-market">
                    <h2 class="fw-900 text-center">Recent Event</h2>
                    <div class="col-lg-12 col-md-12 mt-3">
                        @foreach ($events as $event)
                            <div class="card shadow border-0">
                                <img class="card-img-top" src="{{ $event->photos }}" alt="{{ $event->name }}"
                                    style="min-height: 219px; max-height: 219px" />
                                <div class="card-body">
                                    {{-- <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div> --}}
                                    <a class="text-decoration-none link-dark stretched-link"
                                        href="{{ route('detail.event', $event->slug) }}">
                                        <p class="card-title mb-3">{{ $event->name }}</p>
                                    </a>
                                    @if ($event->is_comingsoon == 1)
                                        <p class="product-date mb-1">Coming Soon</p>
                                    @else
                                        <p class="product-date mb-1">
                                            {{ $event->start_date->isoFormat('D MMMM Y') ?? '' }}
                                            - {{ $event->end_date->isoFormat('D MMMM Y') ?? '' }}</p>
                                    @endif
                                    <p class="product-price">@currency($event->price)</p>
                                    <p class="product-location"><i class="bi bi-geo-alt"></i> {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>

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
