@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 px-3 align-items-center justify-content-between">
        <h4>Data Barang</h4>
        <div>
            @if (Auth::guard('admin')->check())
                <a class="btn btn-primary" href="{{ route('admin.barang.create') }}">Tambah Barang</a>
            @elseif (Auth::guard('staff')->check())
                <a class="btn btn-primary" href="{{ route('staff.barang.create') }}">Tambah Barang</a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-inverse table-hover mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th style="border-top: none">Nama Barang</th>
                        <th style="border-top: none">Jenis Barang</th>
                        <th style="border-top: none">Stock</th>
                        <th style="border-top: none">Harga Beli</th>
                        <th style="border-top: none">Harga Jual</th>
                        <th style="border-top: none">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                    <tr>
                        <td scope="row">{{ $item->nama }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>Rp. {{ number_format($item->harga_beli) }}</td>
                        <td>Rp. {{ number_format($item->harga_jual) }}</td>
                        <td>
                            @if (Auth::guard('admin')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('admin.barang.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                    <a href="{{ route('admin.barang.edit', $item->id) }}" class="btn btn-secondary btn-sm mr-1">Edit</a>
                                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin untuk menghapus data barang ini?')">Hapus</button>
                                    </form>
                                </div>
                            @elseif (Auth::guard('staff')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('staff.barang.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                    <a href="{{ route('staff.barang.edit', $item->id) }}" class="btn btn-secondary btn-sm mr-1">Edit</a>
                                    <form action="{{ route('staff.barang.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin untuk menghapus data barang ini?')">Hapus</button>
                                    </form>
                                </div>
                            @elseif (Auth::guard('web')->check())
                                <div class="row justify-content-start pl-3">
                                    <a href="{{ route('user.barang.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                    @if ($item->stock > 0)
                                        <a href="{{ route('user.transaksi.create', $item->id) }}" class="btn btn-success btn-sm">Beli</a>
                                    @endif
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
