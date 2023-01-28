@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
       <h4 class="card-header">Edit Data Staff</h4>
       <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $staff->name }}"/>
                @if($errors->has('name'))
                   {{ $errors->first('name') }}
                @endif
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required="">
                    <option value=""></option>
                    <option value="Laki-Laki" {{$staff->jenis_kelamin === "Laki-Laki" ? "selected" : ""}}>Laki - Laki</option>
                    <option value="Perempuan" {{$staff->jenis_kelamin === "Perempuan" ? "selected" : ""}}>Perempuan</option>
                </select>
                @if($errors->has('jenis_kelamin'))
                    {{ $errors->first('jenis_kelamin') }}
                @endif
            </div>
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" required autocomplete="email">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                @if($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                   <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                   <button type="submit" class="btn btn-success">Simpan </button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
