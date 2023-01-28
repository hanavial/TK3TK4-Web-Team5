@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h4 class="card-header">Beli Barang</h4>
        <form action="{{ route('user.transaksi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="form-group">
                <label>Kode Transaksi</label>
                <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly/>
                @if($errors->has('kode'))
                   {{ $errors->first('kode') }}
                @endif
            </div>
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>ID Barang</label>
                        <input type="text" name="barang_id" class="form-control" value="{{ $barang->id }}" readonly/>
                        @if($errors->has('barang_id'))
                           {{ $errors->first('barang_id') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>ID User Pembeli</label>
                        <input type="text" name="user_id" class="form-control" value="{{ $user->id }}" readonly/>
                        @if($errors->has('user_id'))
                           {{ $errors->first('user_id') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Jumlah Barang Yang Dibeli</label>
                <input type="text" name="jumlah" class="form-control" value="{{ old('jumlah') }}"/>
                @if($errors->has('jumlah'))
                   {{ $errors->first('jumlah') }}
                @endif
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" value="{{ old('keterangan') }}"></textarea>
                @if($errors->has('keterangan'))
                    {{ $errors->first('keterangan') }}
                @endif
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                    <a href="{{ route('user.barang.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
