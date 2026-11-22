@extends('layouts.theme')

@section('title')
    Event
@endsection

@section('content')
    <header class="py-5" style="background: #000;">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8">
                    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($eventlimited as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                    style="background: rgba(0, 0, 0, 0.6);">
                                    <div class="text-center">
                                        <img src="{{ $slider->photos }}" class="rounded" width="860" height="380">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $slider->name }}</h5>
                                            <p>{{ $slider->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
    </header>
    <div class="container mt-3">
        {{-- <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-8 col-md-8">
                <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($eventlimited as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                style="background: rgba(0, 0, 0, 0.6);">
                                <div class="text-center">
                                    <img src="{{ $slider->photos }}" class="rounded" width="860" height="380">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $slider->name }}</h5>
                                        <p>{{ $slider->location }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div> --}}

        <div class="row my-5 bg-event-list">
            <div class="container">
                <div class="search-bar-event">
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <input type="text" name="search" id="search" placeholder="Cari Acara"
                                style="border: 0; padding: 8px">
                        </div>
                        <div class="col-lg-3 text-center">
                            <input type="date" name="tanggal" id="tanggal" style="border: 0; padding: 8px">
                        </div>
                        <div class="col-lg-3 text-center">
                            <span class="bi bi-geo-alt-fill"></span>
                            <input type="text" name="location" id="location" placeholder="Lokasi Acara"
                                style="border: 0; padding: 8px">
                        </div>
                        <div class="col-lg-3 text-center">
                            <button type="submit" class="btn btn-danger" style="color: #fff">Search</button>
                        </div>
                    </div>
                </div>
                <h2 class="font-weight-bold">Event Yang Belum Dimulai</h2>
                <div class="row">
                    @forelse ($eventsunfinished as $event)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="card shadow border-0">
                                <img class="card-img-top" src="{{ $event->photos }}" alt="{{ $event->name }}"
                                    style="min-height: 219px; max-height: 219px" />
                                <div class="card-body">
                                    {{-- <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div> --}}
                                    <a class="text-decoration-none link-dark stretched-link"
                                        href="{{ route('detail.event', $event->slug) }}">
                                        <p class="card-title mb-3">{{ Str::limit($event->name, 25, '...') }}</p>
                                    </a>
                                    @if ($event->is_comingsoon == 1)
                                        <p class="product-date mb-1">Coming Soon</p>
                                    @else
                                        <p class="product-date mb-1">{{ $event->start_date->isoFormat('D MMMM Y') ?? '' }}
                                            - {{ $event->end_date->isoFormat('D MMMM Y') ?? '' }}</p>
                                    @endif
                                    <p class="product-location"><i class="bi bi-geo-alt"></i> {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5">Belum Ada Acara Terbaru</div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {!! $eventsunfinished->links() !!}
                </div>
            </div>
            <div class="container">
                <h2 class="font-weight-bold">Event Yang Telah Selesai</h2>
                <div class="row">
                    @forelse ($eventsfinished as $event)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="card shadow border-0">
                                <img class="card-img-top" src="{{ $event->photos }}" alt="{{ $event->name }}"
                                    style="min-height: 219px; max-height: 219px" />
                                <div class="card-body">
                                    {{-- <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div> --}}
                                    <a class="text-decoration-none link-dark stretched-link"
                                        href="{{ route('detail.event', $event->slug) }}">
                                        <p class="card-title mb-3">{{ Str::limit($event->name, 25, '...') }}</p>
                                    </a>
                                    <p class="product-date mb-1">{{ $event->start_date->isoFormat('D MMMM Y') ?? '' }}
                                        - {{ $event->end_date->isoFormat('D MMMM Y') ?? '' }}</p>
                                    <p class="product-location"><i class="bi bi-geo-alt"></i> {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5">Belum Ada Acara Terbaru</div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center">
                    {!! $eventsfinished->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
