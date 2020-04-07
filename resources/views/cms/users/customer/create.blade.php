<form method="post" action="{{ route('customer-store') }}">
@csrf
    <div class="form-group ">
        <label for="name">Status</label>
        <select name="status" class="form-control">
            <option value="0" >Not Verified</option>
            <option value="1">Verified</option>                
        </select>
    </div>
    <div class="form-group ">
        <label for="name">Status</label>
        <input type="text" class="form-control">
    </div>
</form>
