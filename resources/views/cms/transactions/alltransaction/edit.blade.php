<form method="post" action="{{ route('all-transaction-update', $data->id) }}">
@csrf
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><b>Customer</b></th>
      <th>{{ $data->name }}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Nomor Telpon</b></th>
      <th>{{ $data->contact_person }}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Paket Internet</b></th>
      <th>{{ $data->package_name}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Jatuh Tempo</b></th>
      <th>{{ $data->expired_date}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Biaya Tagihan</b></th>
      <th>{{ $data->payment_billing}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Pembayaran Sebelumnya</b></th>
      <th>{{ $data->paid}}</th>    
    </tr>
    <tr>
      <th scope="col"><b>Admin</b></th>
      <th>{{ auth()->user()->name }}</th>    
     
    </tr>
  </thead> 
</table>
<div class="form-group ">
    <label for="type_payment">Tipe Pembayaran</label>
      <select class="form-control" id="type_payment" name="type_payment">
          <option value="Cash">Cash</option>
          <option value="Transfer">Transfer</option>  
      </select>
    </div>   
    <div class="form-group ">
    <label for="payment_proof">Upload Bukti Bayar</label>
        <input class="form-control-file" name="payment_proof" type="file" id="payment_proof">
    </div>

    <div class="form_group"></div>
      <label for="expired_date">Expired Date</label>
      <input type="text" class="form-control datepicker" name="expired_date" id="datepicker">
    </div>

    <div class="form_group"></div>
    <label for="payment_date">Tanggal Pembayaran</label>
    <input type="text" class="form-control datepicker" name="payment_date" id="datepicker2" value="{{ \Carbon\Carbon::parse(now())->format('Y-m-d h:i') }}">
    </div>
    
    <div class="form-group ">
    <label for="name">Biaya Admin</label>
        <input class="form-control" name="fee" type="number" value="0" id="fee" readonly>
    </div>
    <div class="form-group ">
    <label for="paid">Nominal Dibayar</label>
        <input class="form-control" name="paid" type="number" value="{{ $data->payment_billing - $data->paid}}" id="paid">
    </div>

    <script>
      // $(document).ready(function() {     

        $(".datepicker").daterangepicker({
          locale: {
            // format: 'DD-MM-YYYY HH:mm'
            format:'YYYY-MM-DD HH:mm'
          },
          singleDatePicker: true,
          // // Note : If you want to use time in date picker
          // timePicker: true,
          // timePicker24Hour: true,
        });

        // $('.date').datepicker({dateFormat: "dd-M-yy"});
      // });
    </script>
</form>


