@extends('layouts.theme')

@section('title')
    Membership
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
                                        href="{{ route('detail-membership') }}">Keanggotaan</a></li>
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
                    <div class="modal fade" id="alertStnk" tabindex="-1" role="dialog" aria-labelledby="alertStnkLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="alertStnkLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-sm-4">
                            <div class="container-idcard">
                                <img src="{{ URL::asset('frontend/assets/pione-id-card.png') }}"
                                    class="idcard-bg d-block" alt="Kartu Tanda Anggota" width="240px">
                                <span class="idcard-fullname">{{ auth()->user()->name }}</span>
                                <span class="idcard-chapter">{{ $membership->chapter->chapter_name }}</span>
                                <span class="idcard-id">{{ $membership->id_member }}</span>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6>Keanggotaan</h6>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('edit-membership') }}"
                                        class="text-decoration-none text-black float-right">Edit <span
                                            class="bi bi-pencil"></span></a>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">No. Keanggotaan</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->id_member }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Alias</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if (isset($membership->alias))
                                        {{ $membership->alias }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Chapter</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ $membership->chapter->chapter_name }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Tanggal Bergabung</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">-</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Kadaluwarsa</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">-</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Mobil</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">-</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">No. Polisi</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->police_num }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Status</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if ($membership->status == 'pending')
                                        <span class="badge badge-warning badge-pill">Menunggu Pembayaran Iuran
                                            Keanggotaan</span>
                                    @else
                                        <span class="badge badge-success badge-pill">Membership Anda Sudah Aktif</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Membership Points</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ $membership->points }} Points
                                </div>
                            </div>
                            <h6 class="d-block w-100 mt-3">Data Pribadi</h6>
                            <hr>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Nama Lengkap</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ auth()->user()->name }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">No KTP</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->ktp_num }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Tempat Lahir</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->born_location }}
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Tanggal Lahir</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ $membership->born_date->isoFormat('D MMMM Y') }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Agama</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user text-capitalize">
                                    {{ $membership->religion }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Ukuran Baju</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user text-uppercase">
                                    {{ $membership->size }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Alamat Lengkap</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{!! $membership->address !!}</div>
                            </div>
                            <div class="d-flex bd-highlight" style="margin-top: -16px;">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Kota</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->city }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Provinsi</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->province }}</div>
                            </div>
                            <h6 class="d-block w-100 mt-3">Data Kendaraan</h6>
                            <hr>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Tipe Pajero</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->type }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Warna Mobil</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->color }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Tahun Produksi</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->year_production }}
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">No. Polisi</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ $membership->police_num }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Pajak STNK</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if ($membership->vehicle_tax != null)
                                        {{ $membership->vehicle_tax->isoFormat('D MMMM YYYY') }} @if ($membership->vehicle_tax <= \Carbon\Carbon::now())
                                            <span class="badge badge-warning badge-pill" id="show-alertstnk"
                                                data-toggle="modal" data-target="#alertStnk"
                                                style="cursor: pointer;">!</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <h6 class="d-block w-100 mt-3">Data Foto Kendaraan</h6>
                            <hr>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Foto Pajero</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if ($membership->photo_car != null)
                                        <a href="{{ $membership->photo_car }}" target="_blank">Foto Dengan Pajero</a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Foto KTP</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if ($membership->photo_identity != null)
                                        <a href="{{ $membership->photo_identity }}" target="_blank">Foto KTP</a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Foto STNK</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if ($membership->photo_license != null)
                                        <a href="{{ $membership->photo_license }}" target="_blank">Foto STNK</a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
