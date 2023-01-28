@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 px-3 align-items-center justify-content-between">
        <h4>Data Staff</h4>
        <div>
            <a class="btn btn-primary" href="{{ route('admin.staff.create') }}">Tambah Staff</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-inverse table-hover mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th style="border-top: none">Nama</th>
                        <th style="border-top: none">Jenis Kelamin</th>
                        <th style="border-top: none">Email</th>
                        <th style="border-top: none">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $item)
                    <tr>
                        <td scope="row">{{ $item->name }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <div class="row justify-content-start pl-3">
                                <a href="{{ route('admin.staff.show', $item->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                <a href="{{ route('admin.staff.edit', $item->id) }}" class="btn btn-secondary btn-sm mr-1">Edit</a>
                                <form action="{{ route('admin.staff.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin untuk menghapus data staff ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
