@extends('layouts.theme')

@section('title')
    Pembayaran Membership
@endsection

@section('content')
    <div class="container pb-5">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12 col-md-4 col-sm-2">
                    <div class="user-info-wrapper">
                        <div class="user-cover"></div>
                        <div class="user-info">
                            <div class="user-avatar">
                                <img @if (Auth::user()->photos == null) src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                          @else
                             src="{{ Auth::user()->photos }}" @endif
                                    alt="Admin" class="rounded-circle" style="max-width: 115px; max-height:115px">
                            </div>
                            <div class="user-data">
                                <h5 class="mb-2">{{ Auth::user()->name }}</h5>
                                <span>Bergabung Sejak
                                    {{ Auth::user()->created_at->isoFormat('D MMMM Y') ?? '' }}</span>
                            </div>
                            <ul class="profile-sub-menu">
                                <li class="{{ request()->is('dashboard/information-membership') ? 'active' : '' }}"><a
                                        href="{{ route('membership') }}">Informasi</a></li>
                                <li class="{{ request()->is('dashboard/membership') ? 'active' : '' }}"><a
                                        href="{{ route('membership') }}">Keanggotaan</a></li>
                                <li class="{{ request()->is('dashboard/payment') ? 'active' : '' }}"><a
                                        href="{{ route('pay-membership') }}">Pembayaran Membership</a></li>
                                <li class="{{ request()->is('dashboard/history-payment') ? 'active' : '' }}"><a
                                        href="{{ route('history-membership') }}">History Pembayaran</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('includes.sidebar')
                <div class="col-lg-9 pt-2">
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="h5 mt-2">Pembayaran Membership</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="divider"></div>

                            <form action="{{ route('payment') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="membership_id" value="{{ $membership->id }}">
                                <div class="card">
                                    <div class="card-header">Form Pembayaran</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="payment_for">Berita Acara Pembayaran</label>
                                                <input type="text" name="payment_for" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="photo">Bukti Transfer</label>
                                                <input type="file" name="photo" class="form-control" accept="images/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100">Kirim Bukti Pembayaran</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
