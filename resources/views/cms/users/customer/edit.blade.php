<div class="col-12">

    <form action="{{ route('payment-verified-proof-update', $payment->id) }}" method="POST">
    @csrf

        <center>
            <img src="{{ asset($payment->image)  }}" width="700" href="#">
            <img src="data:image/png;base64,{{ $payment->image }}" width="700">            
        </center>

        <br>
        <select name="status" class="form-control">
            <option value="0" {{ $payment->status == 0 ? 'selected' : '' }} >Belum Diverifikasi</option>
            <option value="1" {{ $payment->status == 1 ? 'selected' : '' }} >Verifikasi</option>
        </select>

    </form>

</div>

