@extends('layouts.theme')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    <div class="container bg-detail-event py-2 my-5">
        <h3 class="p-5" style="font-weight: 900; font-size: 36px; color: #f00">Keranjang</h3>

        <div class="row pl-5">
            <div class="col-lg-5">
                <ol class="breadcrumb" style="background: #f3f3f3">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-dark">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Keranjang</li>
                </ol>
            </div>
        </div>

        <div class="row pl-5 pt-5">
            <div class="row align-items-center">
                {{-- <div class="col-lg-7">
                    @if (count($carts) > 0)
                        <input type="checkbox" class="m-3" name="id" id="checkedAll"
                            style="width: 20px; height: 20px;" />Pilih Semua
                    @endif
                </div> --}}
            </div>
            <div class="col-lg-7">
                @php
                    $totalEvent = 0;
                    $totalProduct = 0;
                    $totalPrice = 0;
                @endphp
                @foreach ($carts as $cart)
                    @if ($cart->event_id != null)
                        <div class="card-cart-info">
                            <div class="row event_data">
                                {{-- <div class="form-group col-md-1 col-sm-1 text-center">
                                    <input type="checkbox" class="checkSingle" name="id" id="id"
                                        style="width: 20px; height: 20px;">
                                </div> --}}

                                <input type="hidden" class="event_id" value="{{ $cart->event_id }}">
                                <div class="col-md-2 col-sm-2 text-center" style="margin-right: 30px">
                                    <img src="{{ $cart->event->photos }}" class="rounded" alt="" width="96"
                                        height="96">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <span class="font-weight-bold">{{ $cart->event->name }}</span><br>
                                    <span>
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <button class="btn changeQuantity font-weight-bold decrement-btn"
                                                    style="background: #f00; color: #fff" type="button">-</button>
                                            </div>
                                            <input type="number" name="qty" value="{{ $cart->qty }}" min="1" readonly
                                                max="10" class="form-control text-center font-weight-bold qty-input"
                                                style="background: #f00; border-color: #f00; color: #fff; max-width: 75px"
                                                placeholder="Jumlah">
                                            <div class="input-group-append">
                                                <button class="btn changeQuantity font-weight-bold increment-btn"
                                                    style="background: #f00; color: #fff" type="button">+</button>
                                            </div>
                                        </div>
                                    </span><br>
                                    <span class="font-weight-bold">@currency($cart->event->price)</span>
                                </div>
                                <div class="col-md-2 col-sm-2 align-self-end" style="bottom: 0; width: 150px">
                                    <button class="btn btn-sm btn-danger delete-cart-item"><i class="bi bi-trash"></i>
                                        Remove</button>
                                </div>
                            </div>
                        </div>
                        @php
                            $totalEvent += $cart->event->price * $cart->qty;
                        @endphp
                    @elseif($cart->product_id != null)
                        <div class="card-cart-info">
                            <div class="row product_data">
                                {{-- <div class="form-group col-md-1 col-sm-1 text-center">
                                    <input type="checkbox" class="checkSingle" name="id" id="id"
                                        style="width: 20px; height: 20px;">
                                </div> --}}
                                <input type="hidden" class="product_id" value="{{ $cart->product_id }}">
                                <div class="col-md-2 col-sm-2 text-center" style="margin-right: 30px">
                                    <img src="{{ $cart->product->path }}" class="rounded" alt="" width="96"
                                        height="96">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <span class="font-weight-bold">{{ $cart->product->name }}</span><br>
                                    <span>
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <button
                                                    class="btn changeQuantityProduct font-weight-bold decrement-btn-product"
                                                    style="background: #f00; color: #fff" type="button">-</button>
                                            </div>
                                            <input type="number" name="qty" value="{{ $cart->qty }}" id="textVal" min="1"
                                                readonly max="10"
                                                class="form-control text-center font-weight-bold qty-input"
                                                style="background: #f00; border-color: #f00; color: #fff; max-width: 75px"
                                                placeholder="Jumlah">
                                            <div class="input-group-append">
                                                <button
                                                    class="btn changeQuantityProduct font-weight-bold increment-btn-product"
                                                    style="background: #f00 ; color: #fff" type="button">+</button>
                                            </div>
                                        </div>
                                    </span><br>
                                    <span class="font-weight-bold">@currency($cart->product->price)</span>
                                </div>
                                <div class="col-md-2 col-sm-2 align-self-end" style="bottom: 0; width: 150px">
                                    <button class="btn btn-sm btn-danger delete-cart-item"><i class="bi bi-trash"></i>
                                        Remove</button>

                                </div>
                            </div>
                        </div>

                        @php
                            $totalProduct += $cart->product->price * $cart->qty;
                        @endphp
                    @endif
                    {{-- <h5 class="mt-5 text-center">Anda Belum Memasukkan Produk Di Keranjang</h5> --}}
                @endforeach

                @php
                    $totalPrice = $totalEvent + $totalProduct;
                @endphp
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card-price-info">
                    <p class="mb-4 fw-900">Pesanan Kamu</p>
                    <span class="mr-2 fw-700">Total Harga ({{ $carts->count() }} Produk)</span>
                    <span class="fw-700">@currency($totalPrice)</span>
                    <div class="cart-divider"></div>
                    <div class="mt-3 fw-900 py-3" style="font-size: 22px">
                        <span style="margin-right: 56px">TOTAL:</span>
                        <span>@currency($totalPrice)</span>
                    </div>
                    @if (count($carts) <= 0)
                        <a href="{{ route('checkout') }}" class="btn btn-checkout w-100 p-3 disabled"
                            style="color: #fff; font-weight: 900; font-size: 18px;">Bayar</a>
                    @else
                        <a href="{{ route('checkout') }}" class="btn btn-checkout w-100 p-3"
                            style="color: #fff; font-weight: 900; font-size: 18px;">Bayar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".delete-cart-item").click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var prod_id = $(this).closest('.event_data').find('.event_id').val();
            $.ajax({
                method: "POST",
                url: `cart/delete-cart-item`,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'event_id': prod_id,
                },
                success: function(response) {
                    window.location.reload();
                    swal("", response.status, "success");
                }
            });
        });
        $('.increment-btn').click(function(e) {
            e.preventDefault();

            var inc_value = $(this).closest('.event_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                $(this).closest('.event_data').find('.qty-input').val(value);
                console.log(inc_value);
            }
        });

        $('.decrement-btn').click(function(e) {
            e.preventDefault();

            var dec_value = $(this).closest('.event_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).closest('.event_data').find('.qty-input').val(value);
                console.log(dec_value);
            }
        });

        $('.increment-btn-product').click(function(e) {
            e.preventDefault();

            var inc_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                $(this).closest('.product_data').find('.qty-input').val(value);
                console.log(inc_value);
            }
        });

        $('.decrement-btn-product').click(function(e) {
            e.preventDefault();

            var dec_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
                console.log(dec_value);
            }
        });

        $('.changeQuantity').click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var prod_id = $(this).closest('.event_data').find('.event_id').val();
            var qty = $(this).closest('.event_data').find('.qty-input').val();
            data = {
                '_token': "{{ csrf_token() }}",
                'event_id': prod_id,
                'qty': qty,
            }
            $.ajax({
                type: "POST",
                url: "cart/update-cart",
                data: data,
                success: function(response) {
                    window.location.reload();
                    swal("", response.status, "success");
                }
            });
        });

        $('.changeQuantityProduct').click(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var prod_id = $(this).closest('product_data').find('.product_id').val();
            var qty = $(this).closest('.product_data').find('.qty-input').val();
            data = {
                '_token': "{{ csrf_token() }}",
                'product_id': prod_id,
                'qty': qty,
            }
            $.ajax({
                type: "POST",
                url: "cart/update-product-cart",
                data: data,
                success: function(response) {
                    window.location.reload();
                    swal('', response.status, 'success');
                }
            });
        })
    </script>
@endsection
