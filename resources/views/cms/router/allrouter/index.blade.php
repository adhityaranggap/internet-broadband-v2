@extends('_layout.app')
@section('title', 'Data Router')
@section('page_header', 'Router')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Data Router</h4>
            <div class="card-header-action">
                <a href="{{ route('all-router-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Router Baru ">(+) Tambah Baru</a>                
            </div>
        </div>

        <div class="card-body ">
            <div class="table">
                <table id="appTable" class="table nowrap table-bordered table-hover dataTable table-striped" style="width:100%">
                    <thead>
                    <tr>
                    <th scope="col">No</th>
                        <th scope="col">Router Name</th>
                        <th scope="col">IP Public</th>
                        <th scope="col">Port</th>
                        <th scope="col">Address</th>
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
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>

@endpush

@push('js')
<!-- add Js Script Here -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
 $('#appTable').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive:true,
        processing:true,
        serverSide:true,
        ajax: "{{ url()->current().'/datatables' }}",
        columns:[
            {data: 'DT_RowIndex', name:'router_name', searchable: false},
            {data: 'router_name', name:'router_name'},
            {data: 'host', name:'host'},
            {data: 'port', name:'port'},
            {data: 'address', name:'address'},
             {data: 'action', name:'action', searchable: false}           
        ]
    });
</script>
@endpush
