@extends('layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Table</h1>

        <!-- DataTales Example -->
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
