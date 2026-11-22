<div class="col-lg-3">
    <ul class="side-menu-profile">
        <li><span><i class="bi bi-person"></i>Profile
                Pengguna</span>
            <ul class="sub-side-menu">
                <li><a href="{{ route('profile') }}"
                        class="{{ request()->is('dashboard/profile') ? 'active' : '' }}">Biodata</a></li>
            </ul>
        </li>
        <li><span><i class="bi bi-people"></i>Membership</span>{{-- <span class="badge badge-success" style="border-radius: 6px">Success</span> --}}
            <ul class="sub-side-menu">
                @if (auth()->user()->roles == 'Admin')
                    <li><a href="{{ route('membership.candidate') }}"
                            class="{{ request()->is('admin-dashboard/candidate') ? 'active' : '' }}">Pendaftar Baru</a>
                    </li>
                    <li><a href="{{ route('membership.real') }}"
                            class="{{ request()->is('admin-dashboard/membership') ? 'active' : '' }}">Calon Anggota</a>
                    </li>
                @elseif (auth()->user()->roles == 'Super Admin')
                    <li><a href="{{ route('membership.candidate') }}"
                            class="{{ request()->is('admin-dashboard/candidate') ? 'active' : '' }}">Calon Anggota</a>
                    </li>
                    <li><a href="{{ route('membership.real') }}"
                            class="{{ request()->is('admin-dashboard/membership') ? 'active' : '' }}">Anggota
                            Aktif</a></li>
                @endif
                <li><a href="{{ route('membership.transaction') }}"
                        class="{{ request()->is('admin-dashboard/list-payment') ? 'active' : '' }}">List Pembayaran
                        Membership</a></li>
            </ul>
        </li>
        <li><span><i class="bi bi-shop"></i>Market</span>
            <ul class="sub-side-menu">
                <li><a href="#">Penjualan</a></li>
                <li><a href="{{ route('product.index') }}"
                        class="{{ request()->is('dashboard/product*') ? 'active' : '' }}">Daftar Produk</a></li>
                <li><a href="{{ route('event.index') }}"
                        class="{{ request()->is('admin-dashboard/event*') ? 'active' : '' }}">Daftar Event</a></li>
                <li><a href="{{ route('ads.admin') }}"
                        class="{{ request()->is('admin-dashboard/admin-ads*') ? 'active' : '' }}">Daftar Iklan</a>
                </li>
                <li><a href="{{ route('content.index') }}"
                        class="{{ request()->is('admin-dashboard/content*') ? 'active' : '' }}">Daftar Konten</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
