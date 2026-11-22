@extends('layouts.success')

@section('title')
    Berhasil berbelanja
@endsection
@section('content')
    <div class="page-content page-success">
        <section class="section-success">
            <div class="container">
                <div class="row align-items-center row-success justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="{{ URL::asset('frontend/assets/pione_logotext.png') }}" alt="" class="mb-4" />
                        <h2>Transaction Processed!</h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan kami akan
                            menginformasikan resi secepat mungkin!
                        </p>
                        <div>
                            <a href="{{ route('profile') }}" class="btn btn-success w-50 mt-4">My
                                Dashboard</a>
                            <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2">Go To
                                Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
