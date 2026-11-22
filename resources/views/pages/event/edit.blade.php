@extends('layouts.theme')

@section('title')
    Edit Acara
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
                                <div class="col-sm-6"><h3 class="h5 mt-2">Tambah Acara/Event</h3></div>
                                <div class="col-sm 6"></div>
                                <hr>
                                <div class="divider"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('event.update', $event->slug) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" placeholder="Nama Event/Acara">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="location">Lokasi Acara</label>
                                                        <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}" placeholder="Lokasi Event/Acara">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="price">Harga Utama Event</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input type="number" name="price" id="price" class="form-control" placeholder="Harga Event" value="{{ $event->price }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="photos">Photo Cover</label>
                                                        <input type="file" name="photos" id="photos" class="form-control" placeholder="Lokasi Acara">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_date">Tanggal Mulai Acara</label>
                                                        <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $event->start_date->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_date">Tanggal Selesai Acara</label>
                                                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $event->end_date->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chapter_id">Diadakan Oleh Chapter</label>
                                                        <select name="chapter_id" class="form-control js-example-tags">
                                                            <option value="" selected disabled>Pilih Chapter Sesuai Provinsi/Kota</option>
                                                            @foreach ($chapters as $chapter)
                                                    <option value="{{ $chapter->id }}" @if ($chapter->id == $event->chapter_id)
                                                        selected
                                                    @endif>{{ $chapter->chapter_name }}</option>
                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Deskripsi Acara</label>
                                                        <textarea name="description" class="" placeholder="Deskripsi Acara"
                                                        id="editor">{!! $event->description !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="rundown">Rundown Acara</label>
                                                        <textarea name="rundown" class="" placeholder="Rundown Acara"
                                                        id="editor2">{!! $event->rundown !!}</textarea>
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
    
    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection

@push('addon-script')
   <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
   <script>
      CKEDITOR.replace('editor');
   </script>
   <script>
       CKEDITOR.replace('editor2')
   </script>
@endpush