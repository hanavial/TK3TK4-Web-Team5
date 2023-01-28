@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
       <h4 class="card-header">Data Detail - {{ $staff->name }}</h4>
       <form action="" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" readonly/>
                @if($errors->has('name'))
                   {{ $errors->first('name') }}
                @endif
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required="" disabled>
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" required autocomplete="email" readonly>
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
          </div>
          <div class="card-footer">
             <div class="form-group mb-0">
                <div class="row px-3 align-items-center justify-content-end">
                   <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection
