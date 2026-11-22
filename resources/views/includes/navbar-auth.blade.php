<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: #000;">
    <div class="container">
        <a class="navbar-brand" href="{{ Route('home') }}"><img
                src="{{ URL::asset('frontend/assets/PATRIOT.png') }}" alt="" style="height: 70px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-700">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ Route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link align-self-center" href="{{ route('event') }}">Events</a>
                </li>
                <li class="nav-item"><a class="nav-link align-self-center"
                        href="{{ route('marketplace') }}">Market Place</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Membership</a></li> --}}
            </ul>
        </div>
    </div>
</nav>
