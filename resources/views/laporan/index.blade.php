@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 px-3 align-items-center justify-content-between">
        <h4>Laporan Penjualan</h4>
        <div>
            @if (Auth::guard('admin')->check())
                <a class="btn btn-primary" href="{{ route('admin.laporan.grafik') }}">Lihat Data dalam Grafik</a>
            @elseif (Auth::guard('staff')->check())
                <a class="btn btn-primary" href="{{ route('staff.laporan.grafik') }}">Lihat Data dalam Grafik</a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-inverse table-hover mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th style="border-top: none">Nama Barang</th>
                        <th style="border-top: none">Harga Beli</th>
                        <th style="border-top: none">Harga Jual</th>
                        <th style="border-top: none">Jumlah Barang yang Terjual</th>
                        <th style="border-top: none">Laba Bersih</th>
                        <th style="border-top: none">Laba Kotor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $item)
                    <tr>
                        <td scope="row">{{ $item->barangs->nama }}</td>
                        <td>Rp. {{ number_format($item->barangs->harga_beli)  }}</td>
                        <td>Rp. {{ number_format($item->barangs->harga_jual) }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp. {{ number_format(($item->barangs->harga_jual - $item->barangs->harga_beli) * $item->jumlah) }}</td>
                        <td>Rp. {{ number_format($item->barangs->harga_jual * $item->jumlah) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
