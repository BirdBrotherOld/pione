@extends('layouts.theme')

@section('title')
    Edit Produk
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
                                    <h3 class="h5 mt-2">Tambahkan Produk</h3>
                                </div>
                                <div class="col-sm-6"></div>
                            </div>
                            <hr>
                            <div class="divider"></div>
                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Produk</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Kategori Produk</label>
                                            <input type="text" name="category" id="category" class="form-control" value="{{ $product->category }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Harga Produk</label>
                                            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="path">Gambar Produk</label>
                                            <input type="file" accept="image/*" name="path" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi Produk</label>
                                            <textarea name="description"
                                               id="editor">{!! $product->description !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col text-right">
                                      <button type="submit" class="btn btn-success px-5">
                                         Save Now
                                      </button>
                                   </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
   <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
   <script>
      CKEDITOR.replace('editor');
   </script>
@endpush