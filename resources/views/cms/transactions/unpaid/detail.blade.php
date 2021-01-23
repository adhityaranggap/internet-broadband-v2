<form>
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
      <th scope="col"><b>Tanggal Bayar</b></th>
      @if(empty($data->payment_date))
      <th>Belum Pembayaran</th>    
      @else
      <th>{{Carbon\Carbon::parse($data->payment_date)->format('d M Y')}}</th> 
      @endif      
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
      <!-- TODO auth 
        auth()->user()->name
      -->
    </tr>
  </thead> 
</table>
<!-- <a href="{{url('storage/app/'.$data->file)}}" src="{{ asset('storage/app/'.$data->file) }}" class="btn pop btn-primary btn-sm" size="25%" title="{{$data->file}}">{{ $data->file }}</a> -->
<div class="form-group">

 <img class="img-fluid" src="{{ url('storage/'.$data->file) }}" alt="" style="50%">

</div>
@if($data->status == \EnumTransaksi::STATUS_LUNAS)
<a href="{{ route('invoice-print',  $data->id) }}" target="_blank" class="btn btn-warning  form-control" title="Cetak Invoice"><i class="fas fa-edit"></i> Print Invoice</a> 
@else
<a href="{{ route('unpaid-wa',  $data->id) }}" target="_blank" class="btn btn-success form-control" title="Send Notification"><i class="fab fa-whatsapp"></i> Send WhatsApp Notification</a> 

@endif
<div class="p-1">

  {!!
    \Component::btnDelete(route('unpaid-destroy', $data->id), 'Hapus Transaction '. $data->name . ' '. Carbon\Carbon::parse($data->expired_date)->format('M Y'), true)
  !!}
</form>


