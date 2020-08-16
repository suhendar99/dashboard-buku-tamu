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
                            <a href="{{ route('pegawai.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                   </div>
                    <form action="/buku-tamu/pegawai/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="container">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group form-floating-label">
                                        <label>Nama Pegawai</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value = "{{ $data->nama }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value = "{{ $data->nip }}">
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Bagian</label>
                                        <input type="text" class="form-control @error('bagian') is-invalid @enderror" name="bagian" value = "{{ $data->bagian }}">
                                        @error('bagian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Status</label>
                                        <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" value = "{{ $data->status }}">
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Jenis Kelamin</label>
                                        <select name="jk" id=""class="form-control @error('jk') is-invalid @enderror">
                                            <option value="{{ $data->jk }}" {{ $data->jk == 'L' ? 'selected' : false }}>Laki-Laki</option>
                                            <option value="{{ $data->jk }}" {{ $data->jk == 'P' ? 'selected' : false }}>Perempuan</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <label>Foto</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value = "{{ $data->foto }}">
                                        @error('foto')
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
