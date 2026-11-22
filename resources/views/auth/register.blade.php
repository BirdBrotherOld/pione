@extends('layouts.auth')

@section('title')
    Register
@endsection
@section('content')
<div class="hero-register">
    <div class="container" style="margin-top: 80px">
        <div class="row ">
            <div class="col-md-8">
                <img src="{{ asset('frontend/assets/pione-logo.png') }}" alt="" class="img-fluid dismiss">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('frontend/assets/pione_text_logo.svg') }}" class="">
                <br><br>
                <h1 class="h3 text-center mb-3">Gabung menjadi member</h1>
                <form method="POST" action="{{ route('register') }}" class="row mb-5">
                    @csrf

                    <div class="col-sm-12 form-group">
                        <input type="email" id="email" class="form-control float-right @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="tel" id="phone_number" class="form-control float-right @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required autofocus>
                        
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="text" id="name" class="form-control float-right @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 form-group">
                        <input type="text" id="username" class="form-control float-right @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                        
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" id="password"/>
                        {{-- <i class="bi bi-eye-slash form-control-feedback" id="togglePassword"></i> --}}
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Password Confirmation" autocomplete="new-password">
                        {{-- <i class="bi bi-eye-slash form-control-feedback" id="togglePasswordConfirmation"></i> --}}
                    </div>
                    
                    <div class="col-sm-12 form-group">
                        <div class="form-check float-right">
                            <input class="form-check-input" type="checkbox" name="agree" id="agree" style="cursor: pointer;">

                            <label class="form-check-label" for="agree" style="cursor: pointer; font-size: 12px">
                                Saya telah menyetujui <a href="https://mypajero.id/terms" target="_blank">Aturan Penggunaan</a> dan <a href="https://mypajero.id/privacy" target="_blank">Kebijakan Privasi</a> Pione.id
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <button type="submit" id="register" disabled class="btn btn-primary" style="width: 100%">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var checker = document.getElementById('agree');
    var sendbtn = document.getElementById('register');
    // when unchecked or checked, run the function
    checker.onchange = function(){
    if(this.checked){
        sendbtn.disabled = false;
    } else {
        sendbtn.disabled = true;
    }

    }
</script>

<script>
    const togglePassword = document.querySelector("#togglePassword");
    const togglePasswordConfirmation = document.querySelector("#togglePasswordConfirmation");
    const password = document.querySelector("#password");
    const passwordConfirmation = document.querySelector("#password-confirm");

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

    togglePasswordConfirmation.addEventListener("click", function () {
    // toggle the type attribute
    const type = passwordConfirmation.getAttribute("type") === "password" ? "text" : "password";
    passwordConfirmation.setAttribute("type", type);
            
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
