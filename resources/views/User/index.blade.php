@extends('layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Table User</h1>

        <!-- DataTales Example -->
       <div class="card">
           <div class="container">
               <div class="row">
                   <div class="col-12">
                        <div class="card-header">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Create</a>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
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
        ajax : "{{ route('user.index') }}",
          columns : [
            {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
            {data : 'name', name: 'name'},
            {data : 'email', name: 'email'},
            {data : 'action', name: 'action'},
          ]
    });

    function sweet(id){
        const formDelete = document.getElementById('formDelete')
        formDelete.action = '/buku-tamu/user/'+id

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
