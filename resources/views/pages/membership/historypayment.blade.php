@extends('layouts.theme')

@section('title')
    History Pembayaran
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
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="h5 mt-2">List Pembayaran Membership</h3>
                                    </div>
                                    <div class="col-sm-6">

                                        {{-- <button type="submit" class="float-right">Filter</button>
                                <input type="text" name="search" id="" class="float-right" placeholder="Search"> --}}
                                    </div>
                                    <hr>
                                    <div class="divider"></div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered w-100">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Berita Acara Pembayaran</th>
                                                    <th>Tanggal</th>
                                                    <th>Photo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($histories as $payment)
                                                    <tr>
                                                        <td>{{ $payment->membership->user->name }}</td>
                                                        <td>{{ $payment->payment_for }}</td>
                                                        <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                                        <td><img src="{{ $payment->photo }}" alt="" width="150px"></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            Belum Ada Pembayaran
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
