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
                <li class="nav-item"><a
                        class="nav-link align-self-center mr-3 {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ Route('home') }}">Home</a></li>
                <li class="nav-item"><a
                        class="nav-link align-self-center mr-3 {{ request()->is('event') ? 'active' : '' }}"
                        href="{{ route('event') }}">Events</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link align-self-center mr-3 {{ request()->is('marketplace') ? 'active' : '' }}"
                        href="{{ route('marketplace') }}">Market Place</a></li>
                </li>
                <li class="nav-item"><a
                        class="nav-link align-self-center mr-3 {{ request()->is('about-us') ? 'active' : '' }}"
                        href="{{ route('about-us') }}">About Us</a></li>
                </li>
                @guest
                    <li class="nav-item"><a class="btn btn-login nav-link align-self-center mr-3 text-danger fw-700"
                            href="{{ Route('login') }}">Login</a>
                    </li>
                    <li class="nav-item"><a class="btn btn-register nav-link align-self-center mr-3 text-white fw-700"
                            href="{{ Route('register') }}">Register</a></li>
                @else
                    <li class="nav-item"><a class="nav-link align-self-center mr-3"
                            href="{{ route('cart') }}">Cart</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-self-center" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img @if (Auth::user()->photos == null) src="{{ URL::asset('frontend/assets/person-icon.png') }}"
                            @else
                                src="{{ Auth::user()->photos }}" @endif
                                alt="" class="rounded-circle mr-2 profile-picture" />{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu">
                            @if (auth()->user()->roles == 'Admin' || auth()->user()->roles == 'Super Admin')
                                <a href="{{ route('membership.candidate') }}" class="dropdown-item">Profile</a>
                            @else
                                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
