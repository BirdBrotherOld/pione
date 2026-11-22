@extends('layouts.theme')

@section('title')
    Update Konten
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
                                        <form action="{{ route('content.update', $content->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="url">Foto Konten</label>
                                                        <input type="file" name="url" id="url" class="form-control"
                                                            value="{{ old('url') }}" placeholder="Foto Iklan">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"><label for="is_video">Video
                                                            <p>
                                                                <input type="checkbox" value="1" id="is_video"
                                                                    name="is_video"
                                                                    {{ $content['is_video'] == 1 ? 'checked' : '' }} />
                                                            </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"><label for="is_picture">Picture
                                                            <p>
                                                                <input type="checkbox" value="1" id="is_picture"
                                                                    name="is_picture"
                                                                    {{ $content['is_picture'] == 1 ? 'checked' : '' }} />
                                                            </p>
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
