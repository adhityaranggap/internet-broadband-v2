<form method="post" action="{{ route('all-transaction-store-import') }}">
    @csrf
    <div class="form-group ">
        <div class="form-group ">
        <label>Pilih file excel</label>
        <div class="form-group">
        <input type="file" name="file" required="required">
        </div> 
     
       </div>
    </form>
    