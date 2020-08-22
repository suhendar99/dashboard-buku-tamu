@extends('layouts.master')

@section('content')
<div class="content">
        <div class="page-inner">
            <div class="container">
                <div class="page-header">
                    <h4 class="page-title">Create User</h4>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
               <div class="container">
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @elseif (session()->has('failed'))
                    <div class="alert alert-danger">
                        {{ session()->get('failed') }}
                    </div>
                    @endif
               </div>
                <div class="card shadow">
                   <div class="container">
                        <div class="card-header">
                            <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                   </div>
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="container">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-floating-label">
                                        <label>Nama User</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value = "{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value = "{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value = "123123" readonly>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <span>*Password default 123123</span>
                                    <div class="card-action">
                                        <button class="btn btn-success btn-sm" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
