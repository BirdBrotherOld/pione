@extends('layouts.theme')

@section('title')
    Edit Iklan
@endsection

@section('content')
    <div class="container pb-3">
        <div class="main-body">
            @include('includes.cover')
            <div class="row">
                @if (Auth::user()->roles == 'Admin')
                    @include('includes.sidebar-admin')
                @else
                    @include('includes.sidebar')
                @endif
                <div class="col-lg-9 pt-2">
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="h5 mt-2">Edit Iklan</h3>
                                </div>
                                <div class="col-sm 6"></div>
                                <hr>
                                <div class="divider"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('ads.update', $ads->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="category">Kategori Iklan</label>
                                                        <input type="text" name="category" id="category"
                                                            class="form-control" value="{{ $ads->category }}"
                                                            placeholder="Kategori Iklan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="url">URL Iklan</label>
                                                        <input type="url" name="url" id="url" class="form-control"
                                                            value="{{ $ads->url }}" placeholder="URL Iklan">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="media">Foto Iklan</label>
                                                        <input type="file" name="media" id="media" class="form-control"
                                                            value="{{ $ads->media }}" placeholder="Foto Iklan">
                                                        <img src="{{ $ads->media }}" width="150">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
