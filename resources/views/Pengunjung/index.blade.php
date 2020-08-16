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
                            <a href="{{ route('pengunjungBackend.create') }}" class="btn btn-primary btn-sm">Create</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Asal Instansi</th>
                                                <th>Telepon</th>
                                                <th>Tujuan</th>
                                                <th>Kunjungan</th>
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
                                <form action="{{ route('pengunjung.laporan') }}" method="post">
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
        ajax : "{{ route('pengunjungBackend.index') }}",
          columns : [
            {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
            {data : 'nama', name: 'nama'},
            {data : 'nik', name: 'nik'},
            {data : 'jk', name: 'jk'},
            {data : 'instansi', name: 'instansi'},
            {data : 'telp', name: 'telp'},
            {data : 'tujuan', name: 'tujuan'},
            {data : 'kunjungan', name: 'kunjungan'},
            {data : 'action', name: 'action'},
          ]
    });

    function sweet(id){
        const formDelete = document.getElementById('formDelete')
        formDelete.action = '/buku-tamu/pengunjungBackend/'+id

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
