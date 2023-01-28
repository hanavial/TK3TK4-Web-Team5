@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h4 class="card-header">Tambah Data Barang</h4>
            @if (Auth::guard('admin')->check())
                <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
            @elseif (Auth::guard('staff')->check())
                <form action="{{ route('staff.barang.store') }}" method="POST" enctype="multipart/form-data">
            @endif
        @csrf
          <div class="card-body">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}"/>
                @if($errors->has('nama'))
                   {{ $errors->first('nama') }}
                @endif
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" value="{{ old('deskripsi') }}"></textarea>
                @if($errors->has('deskripsi'))
                    {{ $errors->first('deskripsi') }}
                @endif
            </div>
            <div class="form-group">
                <label>Jenis Barang</label>
                <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}"/>
                @if($errors->has('jenis'))
                   {{ $errors->first('jenis') }}
                @endif
            </div>
            <div class="form-group">
                <label>Stock Barang</label>
                <input type="text" name="stock" class="form-control" value="{{ old('stock') }}"/>
                @if($errors->has('stock'))
                   {{ $errors->first('stock') }}
                @endif
            </div>
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="text" name="harga_beli" class="form-control" value="{{ old('harga_beli') }}"/>
                        @if($errors->has('harga_beli'))
                           {{ $errors->first('harga_beli') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" name="harga_jual" class="form-control" value="{{ old('harga_jual') }}"/>
                        @if($errors->has('harga_jual'))
                           {{ $errors->first('harga_jual') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Upload Foto Barang</label>
                <input type="file" name="foto" class="form-control-file"/>
                @if($errors->has('foto'))
                   {{ $errors->first('foto') }}
                @endif
             </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                    @if (Auth::guard('admin')->check())
                        <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    @elseif (Auth::guard('staff')->check())
                        <a href="{{ route('staff.barang.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    @endif
                   <button type="submit" class="btn btn-success">Simpan</button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
