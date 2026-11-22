<div class="col-lg-3">
    <ul class="side-menu-profile">
        <li><span><i class="bi bi-person"></i>Profile
                Pengguna</span>
            <ul class="sub-side-menu">
                <li><a href="{{ route('profile') }}"
                        class="{{ request()->is('profile') ? 'active' : '' }}">Biodata</a></li>
            </ul>
        </li>
        <li><span><i class="bi bi-people"></i>Membership</span>{{-- <span class="badge badge-success" style="border-radius: 6px">Success</span> --}}
            <ul class="sub-side-menu">
                <li><a href="{{ route('membership') }}">Informasi Keanggotaan</a></li>
            </ul>
        </li>
        <li><span><i class="bi bi-cart4"></i>Pembelian</span>
            <ul class="sub-side-menu">
                <li><a href="{{ route('transaction.index') }}"
                        class="{{ request()->is('dashboard/transaction') ? 'active' : '' }}">Daftar Transaksi</a></li>
                <li><a href="#">Menunggu Pembayaran</a></li>
            </ul>
        </li>
        <li><span><i class="bi bi-shop"></i>Toko Saya</span>
            <ul class="sub-side-menu">
                <li><a href="#">Penjualan</a></li>
                <li><a href="{{ route('product.index') }}"
                        class="{{ request()->is('product/*') ? 'active' : '' }}">Daftar Produk</a></li>
                <li><a href="{{ route('ads.index') }}"
                        class="{{ request()->is('dashboard/ads*') ? 'active' : '' }}">Daftar Iklan</a></li>
            </ul>
        </li>
    </ul>
</div>
