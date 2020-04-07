<form method="post" action="{{ route('customer-store') , $data->id }}">
@csrf
    <div class="form-group ">
        <label for="name">Username</label>
        <input class="form-control" name="username" type="text" value="{{$data->username}}" id="username">
    </div>
    <div class="form-group ">
        <label for="name">Name</label>
        <input class="form-control" name="name" type="text" value="{{$data->name}}" id="name">
    </div>
</form>
