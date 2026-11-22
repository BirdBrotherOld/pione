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
                 {{-- <ul class="profile-sub-menu">
                    <li class="active"><a href="#">Daftar Produk</a></li>
                 </ul> --}}
            </div>
        </div>
    </div>
</div>
