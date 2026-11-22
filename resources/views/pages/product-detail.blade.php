@extends('layouts.theme')

@section('title')
    Detail Produk
@endsection

@section('content')
    <form action="{{ route('cart.addProduct', $product->id) }}" method="post">
        @csrf
        <div class="container bg-detail-product my-5 p-md-5">
            <ol class="breadcrumb" style="background: #f3f3f3">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">{{ $product->category }}</li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ $product->path }}" class="img-fluid" alt="" width="400" height="400">
                </div>
                <div class="col-lg-5 col-md-5">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Produk Detail</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Ulasan</a>
                        </div>
                    </nav>
                    <div class="card-description">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="col-lg-12 col-md-12">
                                    <span class="fw-900" style="font-size: 40px">{{ $product->name }}</span><br>
                                    <span style="font-size: 32px">@currency($product->price)</span>
                                    <p class="product-rating" style="font-size: 24px">4.5<i class="bi bi-star-fill"
                                            style="color: #ffff00; margin-left: 4px"></i></p>
                                    <p class="fw-700">Deskripsi</p>
                                    <div class="d-flex bd-highlight">
                                        <div class="bd-highlight text-user" style="width: 72px">Kondisi:</div>
                                        <div class="flex-grow-1 bd-hightlight text-user fw-700">New</div>
                                    </div>
                                    <div class="d-flex bd-highlight">
                                        <div class="bd-highlight text-user" style="width: 72px">Berat (gr):</div>
                                        <div class="flex-grow-1 bd-hightlight text-user fw-700" id="weight">
                                            {{ $product->weight }}
                                        </div>
                                    </div>
                                    <div class="d-flex bd-highlight">
                                        <div class="bd-highlight text-user" style="width: 72px">Kategori:</div>
                                        <div class="flex-grow-1 bd-hightlight text-user fw-700">{{ $product->category }}
                                        </div>
                                    </div>
                                    <p class="mt-2">{!! $product->description !!}</p>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4">
                                            <img @if ($product->user->photos == null) src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                                            @else
                                                src="{{ $product->user->photos }}" @endif
                                                alt="" width="94" height="94" class="rounded-circle img-fluid">
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <span>{{ $product->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                ...</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="card-description">
                        <div class="input-group mb-4 input-item">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm font-weight-bold" style="background: #F5F5F5;" type="button"
                                    id="btnMinus">-</button>
                            </div>
                            <input type="number" name="qty" value="1" id="textVal" min="1" readonly max="10"
                                class="form-control text-center font-weight-bold"
                                style="background: #F5F5F5; border-color: #F5F5F5;" placeholder="Jumlah">
                            <div class="input-group-append">
                                <button class="btn btn-sm font-weight-bold" style="background: #F5F5F5;" type="button"
                                    id="btnPlus">+</button>
                            </div>
                        </div>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if (@isset(Auth::user()->regencies_id))
                            <input type="hidden" name="city_origin" value="{{ Auth::user()->regencies_id }}">
                        @endif
                        <input type="hidden" name="city_destination" value={{ $product->user->regencies_id }}>

                        @auth
                            <div class="form-group">
                                <label>PROVINSI TUJUAN</label>
                                <select class="form-control kurir" name="courier">
                                    <option value="0">-- pilih kurir --</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                            <button class="btn btn-checkout w-100" style="color: #fff; font-weight: 900; font-size: 24px">Add to
                                Cart</button>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" style="color: #fff; font-weight: 700; font-size: 18px"
                                class="btn btn-checkout w-100">Login</a>
                        @endguest
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
    <script>
        $(document).ready(function() {
            let isProcessing = false;

            $('.btn-check').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let city_origin = $('.city_origin').val();
                let city_destination = $('.city_destination').val();
                let courier = $('select[name=courier]').val();
                let weight = $('#weight').val();

                if (isProcessing) {
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "/ongkir",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'city_origin': city_origin,
                        'city_destination': city_destination,
                        'courier': courier,
                        'weight': weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $.each(response[0]['costs'], function(key, value) {
                                $('#ongkir').append('<li class="list-group-item">' +
                                    response[0].code.toUpperCase() + ' : <strong>' +
                                    value.service + '</strong> - Rp. ' + value.cost[
                                        0].value + ' (' + value.cost[0].etd +
                                    ' hari)</li>')
                            });

                        }
                    }
                });
            })
        })
    </script>
@endsection
