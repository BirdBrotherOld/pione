@extends('layouts.theme')

@section('title')
    Informasi Membership
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
                                @if (isset($membership))
                                    <li class="{{ request()->is('dashboard/membership') ? 'active' : '' }}"><a
                                            href="{{ route('detail-membership') }}">Keanggotaan</a></li>
                                    <li class="{{ request()->is('dashboard/payment') ? 'active' : '' }}"><a
                                            href="{{ route('pay-membership') }}">Pembayaran Membership</a></li>
                                    <li class="{{ request()->is('dashboard/history-payment') ? 'active' : '' }}"><a
                                            href="{{ route('history-membership') }}">History Pembayaran</a></li>
                                @else
                                    <li class="{{ request()->is('dashboard/register-membership') ? 'active' : '' }}"><a
                                            href="{{ route('register-membership') }}">Daftar Anggota</a></li>
                                @endif
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
                                    <h3 class="h5 mt-2">Informasi Pendaftaran</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="divider"></div>
                            <p>Keanggotaan Klub Pajero Indonesia ONE (PI.ONE) adalah bersifat terbuka untuk
                                pemilik dan pengguna kendaraan Mitsubishi Pajero dari semua generasi dan varian yang ada
                                /dipasarkan di Indonesia.</p>
                            <p>Beberapa keuntungan bergabung bersama Klub Pajero Indonesia ONE (PI.ONE) :</p>
                            <ul>
                                <li><b>Learning.</b> Kesempatan belajar yang pastinya selalu terbuka luas bagi setiap
                                    anggota klub PI.ONE melalui berbagai kegiatan sharing knowledge dan forum diskusi.</li>
                                <li><b>Networking.</b> Adanya kesempatan untuk memperluas jaringan dan koneksi, dan tentunya
                                    peluang untuk mendapatkan teman-teman baru dan sinergi bisnis ataupun non bisnis.</li>
                                <li><b>Sharing Experiences.</b> Dengan bergabung ke dalam komunitas akan mendapat banyak
                                    kesempatan untuk berbagi pengalaman dengan anggota yang lain.</li>
                                <li><b>Discount.</b> Dengan bergabung ke dalam klub akan mendapatkan keuntungan secara
                                    materi berupa potongan harga dari rekanan-rekanan PI.ONE khusus Bengkel Resmi
                                    MITSUBISHI.</li>
                            </ul>
                            <p><b>Syarat menjadi Anggota PI.ONE :</b></p>
                            <ol>
                                <li>Warga Negara Indonesia atau Warga Negara Asing yang memiliki KITAS. (Lampirkan KTP atau
                                    KITAS)</li>
                                <li>Memiliki dan/atau menggunakan kendaraan Mitsubishi Pajero. (Lampirkan STNK)</li>
                                <li>Memiliki minimal Surat Izin Mengemudi (SIM A).</li>
                                <li>Mengganti Biaya STARTER KIT KEANGGOTAAN senilai Rp 600rb (enam ratus ribu rupiah)</li>
                                <ul>
                                    <li>Seragam Nasional (Merah)</li>
                                    <li>Sticker PI*ONE</li>
                                    <li>Kartu Tanda Anggota (diberikan setelah mengikuti 1x Kopdar & 1x Touring)</li>
                                </ul>
                            </ol>
                            <p><b>Untuk bergabung dengan PI.ONE klik DAFTAR ONLINE dan email bukti transfer STARTER KIT ke
                                    email admin atau nomor telphone</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
