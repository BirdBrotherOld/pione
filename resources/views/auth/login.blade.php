@extends('layouts.auth')

@section('title')
    Login
@endsection
@section('content')
<div class="hero">
    <div class="container">
        <div class="row py-5 justify-content-center">
            <div class="col-md-4 justify-content-center">
                <img src="{{ asset('frontend/assets/pione_text_logo.svg') }}">
                <br><br>
                Belum Punya Akun? <a href="{{ route('register') }}" style="text-decoration: none">Daftar Sekarang</a>
                <form method="POST" action="{{ route('login') }}" class="row pt-3">
                    @csrf

                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div class="col-md-12 col-sm-12 form-group">
                        <input id="password" type="password" class="form-custom @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" id="password"/>
                        <i class="bi bi-eye-slash form-control-feedback" id="togglePassword"></i>
                    </div>

                    <div class="col-md-12 col-sm-12 form-group">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                <label class="form-check-label" for="remember" style="cursor: pointer">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="form-check">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="text-decoration: none">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-primary" style="width: 100%">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="col-sm-12 form-group">
                        <div class="row" style="font-size: 13px">
                            <div class="col-6">
                                Belum Punya Akun?
                                <br>
                                <a href="{{ route('register') }}" style="text-decoration: none">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
            
            // toggle the icon
    this.classList.toggle("bi-eye");
    });
        // prevent form submit
        // const form = document.querySelector("form");
        // form.addEventListener('submit', function (e) {
        //     e.preventDefault();
        // });
</script>
@endsection
