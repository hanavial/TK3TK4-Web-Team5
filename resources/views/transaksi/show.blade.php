@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        @if (Auth::guard('web')->check())
            <h4 class="card-header">Detail Pembelian - {{ $transaksi->kode }}</h4>
        @else
            <h4 class="card-header">Detail Transaksi - {{ $transaksi->kode }}</h4>
        @endif
          <div class="card-body">
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Kode Transaksi</label>
                        <input type="text" name="kode" class="form-control" value="{{ $transaksi->kode }}" readonly/>
                        @if($errors->has('kode'))
                           {{ $errors->first('kode') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control" value="{{ $transaksi->status }}" readonly/>
                        @if($errors->has('status'))
                           {{ $errors->first('status') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Nama Pembeli</label>
                <input type="text" name="user_id" class="form-control" value="{{ $transaksi->users->name }}" readonly/>
                @if($errors->has('user_id'))
                   {{ $errors->first('user_id') }}
                @endif
            </div>
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="barang_id" class="form-control" value="{{ $transaksi->barangs->nama }}" readonly/>
                        @if($errors->has('barang_id'))
                           {{ $errors->first('barang_id') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Jumlah Barang Yang Dibeli</label>
                        <input type="text" name="jumlah" class="form-control" value="{{ $transaksi->jumlah }}" readonly/>
                        @if($errors->has('jumlah'))
                           {{ $errors->first('jumlah') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" value="" readonly>{{ $transaksi->keterangan }}</textarea>
                @if($errors->has('keterangan'))
                    {{ $errors->first('keterangan') }}
                @endif
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                    @if (Auth::guard('web')->check())
                        <a href="{{ route('user.transaksi.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        @if ($transaksi->status == 'Menunggu Konfirmasi')
                            <form action="{{ route('user.transaksi.cancel', $transaksi->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk membatalkan pembelian ini?')">Batalkan</button>
                            </form>
                        @endif
                    @elseif (Auth::guard('staff')->check())
                        <a href="{{ route('staff.transaksi.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        @if ($transaksi->status == 'Menunggu Konfirmasi')
                            <form action="{{ route('staff.transaksi.reject', $transaksi->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-danger mr-2" onclick="return confirm('Apakah anda yakin untuk menolak transaksi ini?')">Tolak</button>
                            </form>
                            <form action="{{ route('staff.transaksi.confirm', $transaksi->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-success" onclick="return confirm('Apakah anda yakin untuk mengonfirmasi transaksi ini?')">Konfirmasi</button>
                            </form>
                        @endif
                    @elseif (Auth::guard('admin')->check())
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    @endif
                </div>
             </div>
          </div>
    </div>
 </div>
@endsection
