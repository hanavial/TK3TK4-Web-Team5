@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 px-3 align-items-center justify-content-between">
        @if (Auth::guard('web')->check())
            <h4>Data Pembelian</h4>
        @else
            <h4>Data Penjualan</h4>
        @endif
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-inverse table-hover mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th style="border-top: none">Kode Transaksi</th>
                        @if (!Auth::guard('web')->check())
                        <th style="border-top: none">Nama Pembeli</th>
                        @endif
                        <th style="border-top: none">Nama Barang</th>
                        <th style="border-top: none">Jumlah Barang Yang Dibeli</th>
                        <th style="border-top: none">Status</th>
                        <th style="border-top: none">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                        <td scope="row">{{ $item->kode }}</td>
                        @if (!Auth::guard('web')->check())
                        <td>{{ $item->users->name}}</td>
                        @endif
                        <td>
                            @if (Auth::guard('admin')->check())
                                <a href="{{ route('admin.barang.show', $item->barangs->id) }}">{{ $item->barangs->nama}}</a>
                            @elseif (Auth::guard('staff')->check())
                                <a href="{{ route('staff.barang.show', $item->barangs->id) }}">{{ $item->barangs->nama}}</a>
                            @elseif (Auth::guard('web')->check())
                                <a href="{{ route('user.barang.show', $item->barangs->id) }}">{{ $item->barangs->nama}}</a>
                            @endif
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            @if ($item->status == 'Menunggu Konfirmasi')
                                <h5><span class="badge badge-pill badge-primary">{{ $item->status }}</span></h5>
                            @elseif ($item->status == 'Ditolak')
                                <h5><span class="badge badge-pill badge-danger">{{ $item->status }}</span></h5>
                            @elseif ($item->status == 'Dibatalkan Pembeli')
                                <h5><span class="badge badge-pill badge-danger">{{ $item->status }}</span></h5>
                            @elseif ($item->status == 'Terkonfirmasi')
                                <h5><span class="badge badge-pill badge-success">{{ $item->status }}</span></h5>
                            @endif
                        </td>
                        <td>
                            @if (Auth::guard('admin')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('admin.transaksi.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                </div>
                            @elseif (Auth::guard('staff')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('staff.transaksi.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                    @if ($item->status == 'Menunggu Konfirmasi')
                                    <form action="{{ route('staff.transaksi.reject', $item->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah anda yakin untuk menolak transaksi ini?')">Tolak</button>
                                    </form>
                                    <form action="{{ route('staff.transaksi.confirm', $item->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin untuk mengonfirmasi transaksi ini?')">Konfirmasi</button>
                                    </form>
                                    @endif
                                </div>
                            @elseif (Auth::guard('web')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('user.transaksi.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
