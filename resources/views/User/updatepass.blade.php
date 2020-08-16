@extends('layouts.master')
@section('content')
<div class="content">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Ganti Password</h4>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('update.pass',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @elseif (session()->has('fail'))
                                <div class="alert alert-danger">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group form-floating-label">
                                            <label>Password Lama</label>
                                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-floating-label">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" >
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group form-floating-label">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" >
                                            @error('new_password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success btn-sm" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
