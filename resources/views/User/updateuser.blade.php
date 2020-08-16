@extends('layouts.master')

@section('content')
<div class="content">
    <div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Update User</h4>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg p-3 mb-5 bg-black rounded">
                        <form action="{{ route('update.user',$user->id) }}" method="post" enctype="multipart/form-data">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-floating-label">
                                        <label>Name</label>
                                        <input type="text" class="form-control border-dark @error('name') is-invalid @enderror" name="name" value = "{{ $user->name }}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Email</label>
                                        <input type="email" class="form-control border-dark @error('email') is-invalid @enderror" name="email" value = "{{ $user->email }}">
                                        @error('email')
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
