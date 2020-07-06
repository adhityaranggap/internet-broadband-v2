<form method="post" action="{{ route('customer-store-import') }}">
@csrf
<div class="form-group ">
    <label for="package_id">Package Name</label>
    <select class="form-control" name="package_id">
    @foreach($package as $package)
      <option value="{{$package->id}}">{{$package->name}}</option>
    @endforeach
    </select>
    </div>
    <div class="form-group ">
    <label>Pilih file excel</label>
	<div class="form-group">
	<input type="file" name="file" required="required">
	</div> 
 
   </div>
</form>
