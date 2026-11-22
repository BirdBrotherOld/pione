@extends('layouts.theme')

@section('title')
    Checkout Belanja
@endsection

@section('content')
    <div class="container bg-detail-event py-2 my-5">
        <h3 class="p-5" style="font-weight: 900; font-size: 36px; color: #f00">Checkout</h3>

        <div class="row pl-5">
            <div class="col-lg-5">
                <div class="card-user-info">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 text-center">
                            <img @if (Auth::user()->photos == null) src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                                @else
                                    src="{{ Auth::user()->photos }}" @endif
                                alt="" width="37px" class="rounded-circle">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                            <span>{{ Auth::user()->phone_number }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background: #EFEFEF; border-radius: 21px;">
                        <div class="container">
                            <div class="text-center">
                                <p class="fw-700">Scan Barcode</p>
                                <img src="{{ URL::asset('frontend/assets/qris.png') }}" alt="Qris" class="mb-3">
                                <a href="#" class="btn btn-checkout mb-3 text-white fw-700">Konfirmasi Pembayaran</a>
                                <button type="button" class="btn btn-cancel w-50 fw-700" data-dismiss="modal"
                                    aria-label="Close">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row pl-5 pt-5">
            <div class="col-lg-7">
                @php
                    $totalEvent = 0;
                    $totalProduct = 0;
                    $totalPrice = 0;
                @endphp
                @forelse ($cartItems as $cart)
                    @if ($cart->event_id != null)
                        <div class="card-cart-info">
                            {{-- <div class="row align-items-center">
                                    <div class="form-group col-md-4 col-sm-4 text-center">
                                        <input type="checkbox" name="id" id="id" style="width: 20px; height: 20px;">
                                        <label for="id" class="ml-3">Barang Anda</label>
                                    </div>
                                </div> --}}
                            <div class="row">
                                <div class="col-md-1 col-sm-1"></div>
                                <div class="col-md-2 col-sm-2" style="margin-left: -16px; margin-right: 30px">
                                    <img src="{{ $cart->event->photos }}" class="rounded" alt="" width="96"
                                        height="96">
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <span class="font-weight-bold">{{ $cart->event->name }}</span><br>
                                    <span>{{ $cart->qty }} Tiket</span><br>
                                    <span class="font-weight-bold">@currency($cart->event->price)</span>
                                </div>
                            </div>
                        </div>
                        @php
                            $totalEvent += $cart->event->price * $cart->qty;
                        @endphp
                    @elseif ($cart->product_id != null)
                        <div class="card-cart-info">
                            {{-- <div class="row align-items-center pb-4">
                                    <div class="col-md-2 col-sm-2 text-center">
                                        <input type="checkbox" name="id" id="id" style="width: 20px; height: 20px;">
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="margin-left: -32px;">
                                        <span class="ml-3 font-weight-bold">Barang Anda</span>
                                    </div>
                                </div> --}}
                            <div class="row">
                                <div class="col-md-1 col-sm-1"></div>
                                <div class="col-md-2 col-sm-2" style="margin-left: -16px; margin-right: 30px">
                                    <img src="{{ $cart->product->path }}" class="rounded" alt="" width="96"
                                        height="96">
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <span class="font-weight-bold">{{ $cart->product->name }}</span><br>
                                    <span>{{ $cart->qty }} Barang ({{ $cart->product->weight }} gram)</span><br>
                                    <span class="font-weight-bold">@currency($cart->product->price)</span>
                                </div>
                            </div>
                        </div>
                        @php
                            $totalProduct += $cart->product->price * $cart->qty;
                        @endphp
                    @endif
                    @php
                        $totalPrice = $totalEvent + $totalProduct;
                    @endphp
                @empty
                @endforelse
            </div>
            <div class="col-lg-4 col-md-4">
                <form action="{{ route('post.checkout') }}" method="post">
                    @csrf
                    <div class="card-price-info">
                        @php
                            $totalOngkir = 15000;
                            $totalLastPrice = $totalPrice + $totalOngkir;
                        @endphp
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="shipping_price" value="{{ $totalOngkir }}">
                        <p class="mb-4 fw-900">Pesanan Kamu</p>
                        <span class="mr-2 fw-700">Total Harga ({{ $cartItems->count() }} Produk)</span>
                        <span class="fw-700">@currency($totalPrice)</span>
                        <div class="cart-divider"></div>
                        <span class="mr-5 fw-700">Total Ongkos Kirim</span>
                        <span class="fw-700">Rp 15.000</span>
                        <div class="cart-divider"></div>
                        <div class="mt-3 fw-900 py-3" style="font-size: 22px">
                            <span style="margin-right: 56px">TOTAL:</span>
                            <span>@currency($totalLastPrice)</span>
                        </div>
                        <div class="py-5 ">
                            <button type="submit" class="btn btn-checkout w-100"
                                style="color: #fff; font-weight: 900; font-size: 18px; padding: 25px 64px 25px 64px">Bayar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function alignModal() {
                var modalDialog = $(this).find(".modal-dialog");

                // Applying the top margin on modal to align it vertically center
                modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
            }
            // Align modal when it is displayed
            $(".modal").on("shown.bs.modal", alignModal);

            // Align modal when user resize the window
            $(window).on("resize", function() {
                $(".modal:visible").each(alignModal);
            });
        });
    </script>
@endsection
