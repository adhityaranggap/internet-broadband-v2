<form method="post" action="{{ route('customer-package-update', $data->id) }}">
@csrf

    <div class="form-group ">
    <label for="username">Username</label>
        <input class="form-control" name="username" type="text" value="{{$data->username}}" id="username" readonly>
    </div>
    <div class="form-group ">
    <label for="package_id">Package Name</label>
    <select class="form-control select2" name="package_id">
    @foreach($package as $package)
      <option value="{{$package->id}}"  {{ $package->id == $data->package_id ? 'selected' : '' }}>{{$package->name}}</option>
    @endforeach
  </select>
    </div>
    <!-- <div class="form-group ">
    <label for="speed">Speed</label>
        <input class="form-control" name="speed" type="speed" value="{{$data->speed}}" id="speed" readonly>
    </div>
    <div class="form-group ">
    <label for="price">Price</label>
        <input class="form-control" name="price" type="text" placeholder="Required" value="{{$data->price}}" id="price" readonly>
    </div> -->
</form>


