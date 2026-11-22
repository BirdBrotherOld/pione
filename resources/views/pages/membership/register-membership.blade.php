@extends('layouts.theme')

@section('title')
    Daftar Membership
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
                             <img @if (Auth::user()->photos == null)
                             src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                          @else
                             src="{{ Auth::user()->photos }}"
                          @endif alt="Admin"
                             class="rounded-circle" style="max-width: 115px; max-height:115px">
                          </div>
                          <div class="user-data">
                             <h5 class="mb-2">{{ Auth::user()->name }}</h5>
                             <span>Bergabung Sejak
                                {{ Auth::user()->created_at->isoFormat('D MMMM Y') ?? '' }}</span>
                          </div>
                          <ul class="profile-sub-menu">
                             <li class="{{ request()->is('dashboard/membership') ? 'active' : '' }}"><a href="{{ route('membership') }}">Informasi Keanggotaan</a></li>
                             <li class="{{ request()->is('dashboard/register-membership') ? 'active' : '' }}"><a href="{{ route('register-membership') }}">Daftar Anggota</a></li>
                             {{-- <li><a href="#">Keamanan</a></li> --}}
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
                                    <h3 class="h5 mt-2">Daftar Membership</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="divider"></div>
                            
                            <form action="{{ route('store-membership') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card border-success">
                                    <div class="card-header">Data Pribadi</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="username">Username</label>
                                                <input type="text" readonly name="username" id="username" class="form-control" value="{{ auth()->user()->username }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ktp_num">No. KTP <span class="text-danger">*</span></label>
                                                <input type="text" name="ktp_num" id="ktp_num" class="form-control" value="{{ old('ktp_num') }}" placeholder="16 Digit Angka Kartu Identitas Pengguna" maxlength="16">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="alias">Alias <span class="text-danger">*</span></label>
                                                <input type="text" name="alias" id="alias" class="form-control" value="{{ old('alias') }}" placeholder="3 Huruf Singkatan Dari Nama Anda" maxlength="3">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="born_location">Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" name="born_location" id="born_location" class="form-control" value="{{ old('born_location') }}" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="born_date">Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" name="born_date" id="born_date" class="form-control date" value="{{ old('born_date') }}" placeholder="Tanggal Lahir">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nickname">Nama Panggilan <span class="text-danger">*</span></label>
                                                <input type="text" name="nickname" id="nickname" class="form-control" value="{{ old('nickname') }}" placeholder="Nama Panggilan">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                                <input type="tel" name="phone_number" readonly id="phone_number" value="{{ auth()->user()->phone_number }}" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="radio" name="gender" value="male"> Male<br>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="radio" name="gender" value="female"> Female<br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="religion">Agama <span class="text-danger">*</span></label>
                                                <select class="form-control js-example-tags" name="religion">
                                                    <option value="" selected>Pilih Agama</option>
                                                    <option value="konghucu">Konghucu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="katolik">Kristen Katolik</option>
                                                    <option value="protestan">Kristen Protestan</option>
                                                    <option value="other">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="size">Ukuran Baju</label>
                                                <select class="form-control js-example-tags" name="size">
                                                    <option value="" selected>Ukuran Baju</option>
                                                    <option value="s">S</option>
                                                    <option value="m">M</option>
                                                    <option value="l">L</option>
                                                    <option value="xl">XL</option>
                                                    <option value="xxl">XXL</option>
                                                    <option value="xxxl">XXL</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label for="address">Alamat Rumah</label>
                                                <textarea name="address" class="" placeholder="Alamat Rumah"
                                                id="editor">{{ old('address') }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="city">Kota</label>
                                                <input type="text" name="city" id="city" value="{{ old('city') }}" placeholder="Kota" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="province">Provinsi</label>
                                                <input type="text" name="province" id="province" class="form-control" value="{{ old('province') }}" placeholder="Provinsi">
                                            </div>
                                        </div>
                                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">Data Kendaraan</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="police_num">No. Polisi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="police_num" value="{{ old('police_num') }}" placeholder="No. Polisi">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="type">Tipe Pajero <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="type" value="{{ old('type') }}" placeholder="Tipe Mobil Pajero">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="color">Warna Pajero <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="color" value="{{ old('color') }}" placeholder="Warna Mobil Pajero">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="year_production">Tahun Pembuatan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="year_production" value="{{ old('year_production') }}" placeholder="Tahun Pembuatan Kendaraan">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="vehicle_tax">Masa Berlaku Pajak STNK <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="vehicle_tax" value="{{ old('vehicle_tax') }}" placeholder="Tahun Pembuatan Kendaraan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">Penutup</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="chapter_id">Prefered Chapter</label>
                                                <select name="chapter_id" class="form-control js-example-tags">
                                                    <option value="" selected>Pilih Chapter Sesuai Provinsi/Kota</option>
                                                    @foreach ($chapters as $chapter)
                                                        <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="photo_car">Foto dengan Banteng Pajero Kesayangan <span class="text-danger">*</span></label>
                                                <input type="file" name="photo_car" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="photo_identity">Foto KTP</label>
                                                <input type="file" name="photo_identity" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="photo_license">Foto STNK</label>
                                                <input type="file" name="photo_license" class="form-control">
                                            </div>
                                            <div class="col-md-12 mt-2 form-group">
                                                <p>Pernyataan & Pakta Integritas</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check float-right">
                                                            <input class="form-check-input" type="checkbox" name="agree" id="agree" style="cursor: pointer;">
                                                            <label class="form-check-label" for="agree" style="cursor: pointer;">
                                                                Saya menyatakan bahwa semua keterangan yang tertulis di formulir ini adalah benar, dan dengan mengklik tombol 'REGISTER', maka saya menyatakan telah membaca, memahami Anggaran Dasar dan Anggaran Rumah Tangga Perkumpulan Pajero Indonesia ONE dan menyetujui untuk mematuhi dan melaksanakannya beserta semua peraturan dan ketentuan lain yang ditetapkan oleh Kepengurusan.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check float-right">
                                                            <input class="form-check-input" type="checkbox" name="sure" id="sure" style="cursor: pointer;">
                                                            <label class="form-check-label" for="sure" style="cursor: pointer;">
                                                                Saya Bersedia membayar Pengganti Biaya Starter Kit (Seragam, Sticker dan KTA) sebesar Rp. 600rb yang ditetapkan oleh Pengurus Nasional.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" disabled id="register" class="btn btn-primary w-100">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
    
   <script type="text/javascript">
    $('.date').datepicker({
       format: 'yyyy-mm-dd'
    });
    </script>

    <script>
        var checker = document.getElementById('agree');
        var sure = document.getElementById('sure');
        var sendbtn = document.getElementById('register');
        // when unchecked or checked, run the function
        checker.onchange = function(){
        sure.onchange = function(){
            if(this.checked){
                sendbtn.disabled = false;
            } else {
                sendbtn.disabled = true;
            }
        }
    }
    </script>
@endsection

@push('addon-script')
   <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
   <script>
      CKEDITOR.replace('editor');
   </script>
@endpush