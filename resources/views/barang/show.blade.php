@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
       <h4 class="card-header">Detail Barang - {{ $barang->nama }}</h4>
       <form action="" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
                <div class="col-md-6 pl-0">
                    <img width="auto" height="200" src="{{ url('storage/foto/' . $barang->foto) }}"/>
                </div>
                @if($errors->has('foto'))
                   {{ $errors->first('foto') }}
                @endif
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" readonly/>
                @if($errors->has('nama'))
                   {{ $errors->first('nama') }}
                @endif
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" value="" readonly>{{ $barang->deskripsi }}</textarea>
                @if($errors->has('deskripsi'))
                    {{ $errors->first('deskripsi') }}
                @endif
            </div>
            <div class="form-group">
                <label>Jenis Barang</label>
                <input type="text" name="jenis" class="form-control" value="{{ $barang->jenis }}" readonly/>
                @if($errors->has('jenis'))
                   {{ $errors->first('jenis') }}
                @endif
            </div>
            <div class="form-group">
                <label>Stock Barang</label>
                <input type="text" name="stock" class="form-control" value="{{ $barang->stock }}" readonly/>
                @if($errors->has('stock'))
                   {{ $errors->first('stock') }}
                @endif
            </div>
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="text" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" readonly/>
                        @if($errors->has('harga_beli'))
                           {{ $errors->first('harga_beli') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" readonly/>
                        @if($errors->has('harga_jual'))
                           {{ $errors->first('harga_jual') }}
                        @endif
                    </div>
                </div>
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                    @if (Auth::guard('admin')->check())
                        <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">Kembali</a>
                    @elseif (Auth::guard('staff')->check())
                        <a href="{{ route('staff.barang.index') }}" class="btn btn-secondary">Kembali</a>
                    @elseif (Auth::guard('web')->check())
                        <a href="{{ route('user.barang.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        @if ($barang->stock > 0)
                            <a href="{{ route('user.transaksi.create', $barang->id) }}" class="btn btn-success">Beli</a>
                        @endif
                    @endif
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
