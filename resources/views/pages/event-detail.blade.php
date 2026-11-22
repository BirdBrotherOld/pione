@extends('layouts.theme')

@section('title')
    Detail Event
@endsection

@section('content')
    <form action="{{ route('cart.addEvent', $event->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="container bg-detail-event py-2 my-5">
            <div class="row" style="margin-top: 20px;">
                <div class="col-lg-7 col-md-6">
                    <img src="{{ $event->photos }}" alt="event karimun" class="img-fluid img-detail-event">
                </div>
                <div class="col-lg-5 col-md-6">
                    <a href="#" class="btn btn-detail ml-3"><span class="bi bi-share"></span>&nbsp;&nbsp;Bagikan</a>
                    <a href="#" class="btn btn-detail ml-3"><span class="bi bi-heart-fill"></span>&nbsp;&nbsp;Favoritkan</a>

                    <h3 class="font-weight-bold ml-3 mt-3">PI-One Present</h3>

                    <h1 class="text-event">{{ $event->name }}</h1>

                    <div class="ml-3">
                        <b>0</b> Terjual

                        <b class="ml-5">0</b> Booked

                        <b class="ml-5">20</b> Dilihat
                    </div>

                    <div class="divider"></div>

                    <p class="ml-3 mt-2">Diselenggarakan Oleh:</p>
                    <div class="ml-3 mt-2">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3">
                                <img src="{{ URL::asset('frontend/assets/person-icon.png') }}" alt="Admin"
                                    class="rounded-circle" style="max-width: 60px; max-height:70px;">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <span class="font-weight-bold">Admin Chapter
                                    {{ $event->chapter->chapter_name }}</span><br>
                                <span>Ketua Penyelenggara</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="row">
                <div class="col-lg-12 col-md-8 px-5 mt-3 mb-4">
                    <div class="card-online-booking">
                        <p class="text-online-booking">Online Booking</p>
                    </div>
                    <div class="card-price">
                        <div class="row">
                            <div class="col-3 py-3 px-5">
                                <div class="text-price-primary">
                                    <p>{{ $event->location }}</p>
                                </div>
                                <div class="text-price-secondary">
                                    <p><span class="bi bi-geo-alt"></span>&nbsp;&nbsp;Lokasi</p>
                                </div>
                            </div>
                            <div class="col-3 py-3 px-5">
                                <div class="text-price-primary">
                                    @if ($event->is_comingsoon == 1)
                                        <p>Coming Soon</p>
                                    @else
                                        <p>{{ $event->start_date->isoFormat('D MMM') . ' - ' . $event->end_date->isoFormat('D MMM Y') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="text-price-secondary">
                                    <p><span class="bi bi-calendar3"></span>&nbsp;&nbsp;Tanggal</p>
                                </div>
                            </div>
                            <div class="col-3 py-3 px-5">
                                <div class="text-price-primary">
                                    <p>@currency($event->price)</p>
                                </div>
                                <div class="text-price-secondary">
                                    <p><span class="bi bi-tag-fill"></span>&nbsp;&nbsp;Harga Utama</p>
                                </div>
                            </div>
                            <div class="col-3 py-3 px-5">
                                <div class="text-price-primary">
                                    <p>PESAN SEKARANG</p>
                                </div>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn font-weight-bold" style="background: #f00; color: #fff"
                                            type="button" id="btnMinus">-</button>
                                    </div>
                                    <input type="number" name="qty" value="1" id="textVal" min="1" readonly max="10"
                                        class="form-control text-center font-weight-bold"
                                        style="background: #f00; border-color: #f00; color: #fff" placeholder="Jumlah">
                                    <div class="input-group-append">
                                        <button class="btn font-weight-bold" style="background: #f00; color: #fff"
                                            type="button" id="btnPlus">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="container bg-detail-event py-2 my-3">
            <div class="row mt-3 px-5">
                <div class="col-6 mt-2 pb-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Run Down</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Calon Anggota</a>
                        </div>
                    </nav>
                    <div class="card-description">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">{!! $event->description !!}</div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                {!! $event->rundown !!}</div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                ...</div>
                        </div>
                    </div>
                </div>
                <div class="col-5 mt-5">
                    <h3 class="font-weight-bold mx-3">Biaya Tambahan</h3>
                    <br>
                    <div class="card ml-3">
                        <div class="card-body p-4">
                            <h2 class="font-weight-bold">{{ $event->name }}</h2>
                            <p class="mt-3">Kamar Superior (2 PAX)</p>

                        </div>
                    </div>
                    <div class="card ml-3">
                        <div class="card-body p-4">
                            <h2 class="h4 font-weight-bold">Sub Total:</h2>
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <br>
                            @auth
                                <button class="btn btn-checkout w-100"
                                    style="color: #fff; font-weight: 900; font-size: 24px">Add to Cart</button>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" style="color: #fff; font-weight: 900; font-size: 24px"
                                    class="btn btn-checkout w-100">Login</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $('#btnPlus').click(function() {
            let textNow = $('#textVal').val();
            textNow = parseInt(textNow);
            textNow += 1;
            $('#textVal').val(textNow);
        });
    </script>
    <script>
        $('#btnMinus').click(function() {
            let textNow = $('#textVal').val();
            textNow = parseInt(textNow);
            if (textNow == 0) {
                textNow += 0
            } else {
                textNow -= 1;
            }
            $('#textVal').val(textNow);
        });
    </script>
@endsection
