@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
       <h4 class="card-header">Tambah Data User</h4>
        @if (Auth::guard('admin')->check())
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @elseif (Auth::guard('staff')->check())
            <form action="{{ route('staff.user.store') }}" method="POST" enctype="multipart/form-data">
        @endif
          @csrf
          <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                @if($errors->has('name'))
                   {{ $errors->first('name') }}
                @endif
            </div>
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}"/>
                        @if($errors->has('tempat_lahir'))
                           {{ $errors->first('tempat_lahir') }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}"/>
                        @if($errors->has('tanggal_lahir'))
                           {{ $errors->first('tanggal_lahir') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required="">
                    <option value=""></option>
                    <option value="Laki-Laki">Laki - Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                @if($errors->has('jenis_kelamin'))
                    {{ $errors->first('jenis_kelamin') }}
                @endif
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" value="{{ old('alamat') }}"></textarea>
                @if($errors->has('alamat'))
                    {{ $errors->first('alamat') }}
                @endif
            </div>
            <div class="form-group">
                <label>Upload Foto KTP</label>
                <input type="file" name="ktp" class="form-control-file"/>
                @if($errors->has('ktp'))
                   {{ $errors->first('ktp') }}
                @endif
             </div>
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @if($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                    @if (Auth::guard('admin')->check())
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    @elseif (Auth::guard('staff')->check())
                        <a href="{{ route('staff.user.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                    @endif
                   <button type="submit" class="btn btn-success">Simpan </button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
