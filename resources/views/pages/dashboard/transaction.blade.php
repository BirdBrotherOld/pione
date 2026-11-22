@extends('layouts.theme')

@section('title')
    Profile
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
                            {{-- <ul class="profile-sub-menu">
                            <li class="active"><a href="#">Biodata</a></li>
                            <li><a href="#">Daftar Alamat</a></li>
                            <li><a href="#">Keamanan</a></li>
                        </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (Auth::user()->roles == 'Admin')
                    @include('includes.sidebar-admin')
                @else
                    @include('includes.sidebar')
                @endif
                <div class="col-lg-9 pt-2">
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="h5 mt-2">Daftar Transaksi</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover w-100 yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Total Harga</th>
                                            <th>Status Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $item)
                                            <tr>
                                                <td>{{ $item->code }}</td>
                                                <td>@currency($item->shipping_price + $item->total_price)</td>
                                                <td>{{ $item->transaction_status }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#exampleModalCenter-{{ $item->id }}">
                                                        Detail
                                                    </button>

                                                    <div class="modal fade" id="exampleModalCenter-{{ $item->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-hover table-striped table-borderless">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>Code</th>
                                                                                    <td>{{ $item->code }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Total Belanja</th>
                                                                                    <td>{{ $item->total_price }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Biaya Ongkir</th>
                                                                                    <td>{{ $item->shipping_price }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pembeli</th>
                                                                                    <td>{{ Auth::user()->name }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Detail Belanja</th>
                                                                                    <td>
                                                                                        <table class="table table-bordered">
                                                                                            <tr>
                                                                                                <th>Nama</th>
                                                                                                <th>Harga</th>
                                                                                                <th>Jumlah</th>
                                                                                                <th>Code</th>
                                                                                            </tr>
                                                                                            @foreach ($item->transaction_detail as $detail)
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        @if (isset($detail->product_id))
                                                                                                            {{ $detail->product->name }}
                                                                                                        @else
                                                                                                            {{ $detail->event->name }}
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    <td>@currency($detail->price)
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        @if (isset($detail->product_id))
                                                                                                            {{ $detail->price / $detail->product->price }}
                                                                                                        @else
                                                                                                            {{ $detail->price / $detail->event->price }}
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    <td>{{ $detail->code }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Belum Ada Transaksi
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.yajra-datatable').DataTable();
        })
    </script>
@endpush
