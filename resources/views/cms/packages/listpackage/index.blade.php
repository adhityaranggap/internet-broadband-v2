@extends('_layout.app')
@section('title', 'Data Package')
@section('page_header', 'Package')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Data Package</h4>
            <div class="card-header-action">
                <a href="{{ route('list-package-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Package Baru ">(+) Tambah Baru</a>                
            </div>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table id="appTable" class="table table-bordered table-hover dataTable table-striped" >
                    <thead>
                    <tr>
                    <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Speed</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                </table>    
            </div>
        </div>
    </div>

@endsection

@push('css')
<!-- add Css Here -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<!-- datatables -->
<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css'> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>
@endpush

@push('js')
<!-- add Js Script Here -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
 $('#appTable').DataTable({
        //responsive:true,
        processing:true,
        serverSide:true,
        ajax: "{{ url()->current().'/datatables' }}",
        columns:[
            {data: 'DT_RowIndex', name:'name', searchable: false},
            {data: 'name', name:'name'},
            {data: 'speed', name:'speed'},
            {data: 'price', name:'price'},
            {data: 'action', name:'action'},           
        ]
    });
</script>
@endpush