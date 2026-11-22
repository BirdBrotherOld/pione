@extends('layouts.theme')

@section('title')
    List Transaksi
@endsection

@section('content')
<div class="container pb-5">
    <div class="main-body">
        @include('includes.cover')
        <div class="row">
            @include('includes.sidebar-admin')
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
                                            <th>Member ID</th>
                                            <th>Berita Acara Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->membership->user->name }}</td>
                                                <td>{{ $payment->membership->id_member }}</td>
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