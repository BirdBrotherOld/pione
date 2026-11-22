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
                        <div class="col-md-4">
                            <img @if (Auth::user()->photos == null) src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                        @else
                        src="{{ Auth::user()->photos }}" @endif
                                alt="Admin" class="d-block img-thumbnail mx-auto avatar rounded-circle mb-4"
                                style="max-width:190px; max-height:190px">
                            <a href="#" class="btn btn-sm btn-outline-secondary d-block" data-toggle="modal"
                                data-target="#changeProfilePicture" style="margin-bottom: 20px">Ganti Foto Profil</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary d-block" data-toggle="modal"
                                data-target="#changePasswordModal">
                                <i class="bi bi-lock-fill"></i> Ganti Password
                            </a>
                            @if (isset($membership))
                                <a href="{{ route('edit-membership') }}" class="btn btn-primary btn-sm d-block mt-3">
                                    <i class="bi bi-pencil"></i> Lengkapi Data Membership
                                </a>
                            @else
                                <a href="{{ route('register-membership') }}" class="btn btn-primary btn-sm d-block mt-3">
                                    <i class="bi bi-pencil"></i> Daftarkan Membership
                                </a>
                            @endif
                        </div>
                        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('change-password') }}" autocomplete="off" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body row">
                                            @csrf
                                            <div class="form-group col-sm-12">
                                                <label class="change-password" for="old_password">Password Lama</label>
                                                <input type="password" name="old_password"
                                                    class="form-control form-control-sm" id="old_password" required>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label class="change-password" for="password">Password Baru</label>
                                                <input type="password" name="password" class="form-control form-control-sm"
                                                    id="password" required>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label class="change-password" for="password_confirmation">Konfirmasi
                                                    Password</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control form-control-sm" id="password_confirmation"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('update.profile') }}" autocomplete="off" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body row">
                                            @csrf
                                            <div class="form-group col-sm-12">
                                                <label for="name">Nama Anggota</label>
                                                <input type="text" name="name" class="form-control form-control-sm"
                                                    id="name" value="{{ auth()->user()->name }}">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control form-control-sm"
                                                    id="username" value="{{ auth()->user()->username }}">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="phone_number">No. Handphone</label>
                                                <input type="tel" name="phone_number" class="form-control form-control-sm"
                                                    id="phone_number" value="{{ auth()->user()->phone_number }}"
                                                    maxlength="14">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="address">Alamat</label>
                                                <input type="text" name="address" class="form-control form-control-sm"
                                                    id="address" value="{{ auth()->user()->address }}" maxlength="14">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="provinces_id">Provinsi</label>
                                                <select name="provinces_id" class="form-control" id="province">
                                                    <option value="" selected>Pilih Provinsi</option>
                                                    @if (isset(Auth::user()->provinces_id))
                                                        <option value="{{ Auth::user()->provinces_id }}" selected>
                                                            {{ Auth::user()->province->name }}</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">
                                                                {{ $province->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">
                                                                {{ $province->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label>City</label>
                                                <select name="regencies_id" class="form-control" id="regencies">
                                                    @if (isset(Auth::user()->regencies_id))
                                                        <option value="{{ Auth::user()->regencies_id }}" selected>
                                                            {{ Auth::user()->cities->name }}</option>
                                                    @else
                                                        <option value="" selected>Select City</option>
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="changeProfilePicture" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="upload-image-form" autocomplete="off" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body row">
                                            @csrf
                                            <div class="form-group col-sm-12">
                                                <label for="photos">Foto Profil</label>
                                                <input type="file" name="photos" class="form-control form-control-sm"
                                                    id="photos">
                                                <span class="text-danger" id="image-input-error"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h3 class="h5">Biodata</h3>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="#" class="text-dark float-right text-decoration-none" data-toggle="modal"
                                        data-target="#modalEditProfile">Edit Biodata <span
                                            class="bi bi-pencil"></span></a>
                                </div>
                            </div>
                            <hr>
                            <div class="divider"></div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Nama Lengkap</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">{{ Auth::user()->name }}
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Username</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ Auth::user()->username }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Email</div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ Auth::user()->email }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">No. Handphone
                                </div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ Auth::user()->phone_number }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Alamat
                                </div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    {{ Auth::user()->address }}</div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Kota
                                </div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if (isset(Auth::user()->regencies_id))
                                        {{ Auth::user()->cities->name }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight text-user" style="width: 150px">Provinsi
                                </div>
                                <div class="p-2 flex-grow-1 bd-hightlight text-user">
                                    @if (isset(Auth::user()->provinces_id))
                                        {{ Auth::user()->province->name }}
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#upload-image-form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type: 'POST',
                url: `upload-avatar`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        window.location.reload();
                        swal("", response, "success");
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#image-input-error').text(response.responseJSON.errors.photo);
                }
            });
        });
    </script>
    <script>
        $('#province').change(function() {
            var provId = $(this).val();
            if (provId) {
                $.ajax({
                    type: "GET",
                    url: "/getCity/" + provId,
                    dataType: 'JSON',
                    success: function(res) {
                        console.log(res);
                        if (res) {
                            $("#regencies").empty();
                            $("#regencies").append('<option>---Pilih Kota---</option>');
                            $.each(res, function(nama, kode) {
                                $("#regencies").append('<option value="' + kode.id + '">' + kode
                                    .name +
                                    '</option>');
                            });
                        } else {
                            $("#regencies").empty();
                        }
                    }
                });
            } else {
                $("#regencies").empty();
            }
        });
    </script>
@endsection
