@extends('_layout.app') 
@section('title', 'All Transaction') 
@section('page_header', 'Transaction') 
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h4>All Transaction</h4>

        @if(!empty(request()->range))
        <div class="card-header-action">
          <a class="btn btn-outline-primary" href="{{route('all-transaction-index') }} " title="Reset Data"> Reset Data </i></a>
        </div>
        @endif
        <div class="card-header-action">
            {{-- <button id="lunas" class="btn btn-info">Set Lunas</button> --}}
            <a class="btn btn-outline-primary btn-confirm" href="{{route('all-transaction-sync') }} " title="Sync Data"><i class="fas fa-sync"> Sync Data </i></a>
            <a href="{{ route('all-transaction-create') }}" class="btn btn-outline-primary modal-show" title="Tambah Transaction Baru ">(+) Tambah Baru</a>
           
        </div>
        {{-- Start Date Filter --}}
        <div class="card-header-action">
            <input type="text" name="datefilter" class="form-control datefilter" placeholder="Search by date range.."/> 
        </div>

        
    </div>
    <div class="card-body ">
        
        <div class="table">
            
            <table id="appTable" class="table nowrap table-bordered table-hover dataTable table-striped" style="width:100%">
                
                <thead>
                    
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Expired Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection

@push('css')
<!-- Daterange -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" />

<!-- Datepicker -->
<link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css" /> 

<!-- add Css Here -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<!-- datatables -->
<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css'> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>


@endpush 
@push('js')
<!-- Moment Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>

<!-- add Js Script Here -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/stringMonthYear.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <!-- Start Midtrans -->

    <script src="{{
        !config('services.midtrans.isProduction') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey')}}">
    </script>

    {{-- End Midtrans --}}

<!-- Start Datepicker -->
<script src="https://demo.getstisla.com/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="https://demo.getstisla.com/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
{{-- End DatePicker --}}

<script type="text/javascript">
    $(function() {
    
      $('.datefilter').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });
    
      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        document.location.href = "{{ route('all-transaction-index') }}" +'?range='+picker.startDate.format('YYYY-MM-DD')+' - '+picker.endDate.format('YYYY-MM-DD');
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                  

      });
    
      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
    
    });
</script>


<script>
    $(document).ready(function() {
        var table = $('#appTable').DataTable({
            rowReorder: {
            selector: 'td:nth-child(2)'
        },    
        responsive: true, 
        dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        processing:true,
        
        serverSide:true,
            ajax: "{{ url()->current().'/datatables'.(empty(request()->range) == true ? null : ('?range='.request()->range)) }}",
            columns: [{
                    data: 'id',
                    name: 'name',
                    searchable: false
             
                }, {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'expired_date',
                    name: 'expired_date'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'action',
                    name: 'action',
                    searchable: false
                }
            ],
            'order': [
                [2, 'desc']
            ]
        });

    });
    
</script>
@endpush