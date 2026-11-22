@extends('layouts.theme')

@section('title')
    Daftar Content
@endsection

@section('content')
    <div class="container pb-3">
        <div class="main-body">
            @include('includes.cover')
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
                                    <h3 class="h5 mt-2">Daftar Kontent</h3>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('content.create') }}" class="btn btn-success btn-sm float-right"><i
                                            class="bi bi-plus"></i>Tambah Konten</a>
                                </div>
                            </div>
                            <hr>
                            <div class="divider"></div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover w-100 yajra-datatable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Photo Konten</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                // processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [{
                        data: 'url',
                        name: 'url',
                        className: 'text-center',
                        render: function(data) {
                            return '<img src="' + data + '" style="width: 150px">'
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        width: '35%'
                    },
                ]
            });

        });
    </script>
@endpush
