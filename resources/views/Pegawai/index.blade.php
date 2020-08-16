@extends('layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Table</h1>

        <!-- DataTales Example -->
       <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="card-header">
                            <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm">Create</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Bagian</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <form action="" id="formDelete" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    <div class="col-4" style="margin-top:50px;">
                        <div class="card">
                            <div class="card-body">
                                    @if (session()->has('alert'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('alert') }}
                                    </div>
                                    @endif
                                    @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif
                                    @if (session()->has('failed'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('failed') }}
                                        </div>
                                    @endif
                                <form action="/buku-tamu/pegawai/laporan" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input-select">Tanggal Awal</label>
                                                <input type="date" name="awal" class="form-control  @error('awal') is-invalid @enderror" >
                                                @error('awal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input-select">Tanggal Akhir</label>
                                                <input type="date" name="akhir" class="form-control @error('akhir') is-invalid @enderror" >
                                                @error('akhir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                                <button type="submit"class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>

    </div>
    <!-- /.container-fluid -->
    @push('script')
    <script>

    let table = $('#data_table').DataTable({
        processing : true,
        serverSide : true,
        ordering : false,
        pageLength : 10,
        ajax : "{{ route('pegawai.index') }}",
          columns : [
            {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
            {data : 'foto', render: function (data, type, full, meta) {
                if(data == null){
                    return "Foto Tidak Ada !"
                }else{
                    return "<img src=\"{{ asset('') }}" + data + "\" height=\"100px\"width=\"100px\">";
                }
                }
            },
            {data : 'nama', name: 'nama'},
            {data : 'nip', name: 'nip'},
            {data : 'jk', name: 'jk'},
            {data : 'bagian', name: 'bagian'},
            {data : 'status', name: 'status'},
            {data : 'action', name: 'action'},
          ]
    });

    function sweet(id){
        const formDelete = document.getElementById('formDelete')
        formDelete.action = '/buku-tamu/pegawai/'+id

        console.log(formDelete.action)
        swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            formDelete.submit();
            swal("Poof! Your data has been deleted!", {
            icon: "success",
            });
        } else {
            swal("Data Doesn't Deleted !");
        }
        });
    }

    </script>
@endpush
@endsection
