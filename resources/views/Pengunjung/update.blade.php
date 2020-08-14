@extends('layouts.master')

@section('content')
<div class="content">
        <div class="page-inner">
            <div class="container">
                <div class="page-header">
                    <h4 class="page-title">Update Pengunjung</h4>
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
                            <a href="{{ route('pengunjungBackend.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                   </div>
                    <form action="{{ route('pengunjungBackend.update',$pengunjung->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="container">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-floating-label">
                                        <label>Nama Pengunjung</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value = "{{ $pengunjung->nama }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value = "{{ $pengunjung->nik }}">
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Asal Instansi</label>
                                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" value = "{{ $pengunjung->instansi }}">
                                        @error('instansi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value = "{{ $pengunjung->telp }}">
                                        @error('telp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Tujuan</label>
                                        <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" value = "{{ $pengunjung->tujuan }}">
                                        @error('tujuan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Kunjungan</label>
                                        <input type="text" class="form-control @error('kunjungan') is-invalid @enderror" name="kunjungan" value = "{{ $pengunjung->kunjungan }}">
                                        @error('kunjungan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
