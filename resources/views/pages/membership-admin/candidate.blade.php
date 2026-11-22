@extends('layouts.theme')

@section('title')
    List Calon Anggota Membership
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
                            <form action="{{ route('membership.candidate') }}" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="h5 mt-2">List Calon Anggota</h3>
                                    </div>
                                    <div class="col-sm-6">

                                        <button type="submit" class="float-right">Filter</button>
                                        <input type="text" name="search" id="" class="float-right" placeholder="Search">
                                    </div>
                                    <hr>
                                    <div class="divider"></div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered w-100">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIK</th>
                                                    <th>TTL</th>
                                                    {{-- <th>Alamat Lengkap</th> --}}
                                                    <th>Kendaraan</th>
                                                    <th>Chapter</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($candidates as $candidate)
                                                    <tr>
                                                        <td class="text-capitalize">{{ $candidate->user->name }}</td>
                                                        <td>{{ $candidate->ktp_num }}</td>
                                                        <td class="text-capitalize">{{ $candidate->born_location }},
                                                            {{ $candidate->born_date->format('d-m-Y') }}</td>
                                                        {{-- <td class="text-capitalize">{!! $candidate->address !!}</td> --}}
                                                        <td>{{ $candidate->type . ', ' . $candidate->color . ', ' . $candidate->year_production }}
                                                        </td>
                                                        <td>{{ $candidate->chapter->chapter_name }}</td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#exampleModalCenter-{{ $candidate->id }}">
                                                                Detail
                                                            </button>

                                                            <div class="modal fade"
                                                                id="exampleModalCenter-{{ $candidate->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-capitalize"
                                                                                id="exampleModalLongTitle">Detail
                                                                                {{ $candidate->user->name }}</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">

                                                                                <table
                                                                                    class="table table-hover table-striped table-borderless">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th>Nama</th>
                                                                                            <td class="text-capitalize">
                                                                                                {{ $candidate->user->name }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>ID Member</th>
                                                                                            <td class="text-capitalize">
                                                                                                {{ $candidate->id_member }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>NIK</th>
                                                                                            <td>{{ $candidate->ktp_num }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>TTL</th>
                                                                                            <td class="text-capitalize">
                                                                                                {{ $candidate->born_location }},
                                                                                                {{ $candidate->born_date->format('d-m-Y') }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Alamat Lengkap</th>
                                                                                            <td class="text-capitalize">
                                                                                                {!! $candidate->address !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Size Baju</th>
                                                                                            <td class="text-uppercase">
                                                                                                {{ $candidate->size }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kendaraan</th>
                                                                                            <td>{{ $candidate->type . ', ' . $candidate->color . ', ' . $candidate->year_production }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Chapter</th>
                                                                                            <td>{{ $candidate->chapter->chapter_name }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Photo Dengan Pajero</th>
                                                                                            <td class="text-center"><img
                                                                                                    src="{{ $candidate->url_photo_car }}"
                                                                                                    width="150px"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Status Membership</th>
                                                                                            <td class="text-capitalize">
                                                                                                {{ $candidate->status }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <a href="{{ route('membership.setStatus', $candidate->id) }}"
                                                                                class="btn btn-primary"
                                                                                onclick="return confirm('Apakah Anda Yakin?')">Ubah
                                                                                Status Membership</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {!! $candidates->links() !!}
                                        </div>
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
