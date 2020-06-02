<form method="post" action="{{ route('all-ticket-store') }}">
@csrf

    <div class="row">
        <div class="form-group col-6">
        <label for="name">Name</label>
            <input class="form-control" name="name"  type="text" value="{{ auth()->user()->name }}" id="name">
        </div>
        <div class="form-group col-6">
        <label for="email">Email</label>
            <input class="form-control" name="email"  type="text" value="{{ auth()->user()->email }}" id="email" disabled>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
        <label for="created_at">Created At </label>
            <input class="form-control" name="created_at"  type="text" value="{{ now() }}" id="created_at" disabled>
        </div>
        <div class="form-group col-6">
        <label for="priority">Priority</label>
        <select name="priority" class=form-control id="priority">
            <option value="{{ App\Ticket::PRIORITY_LOW }}">LOW</option>
            <option value="{{ App\Ticket::PRIORITY_MEDIUM }}">MEDIUM</option>
            <option value="{{ App\Ticket::PRIORITY_HIGH }}">HIGH</option>
        </select>
        </div>
    </div>
    
    <div class="form-group ">
    <label for="Package">Package</label>
        <select name="package" class=form-control id="package">
             @foreach($packages as $package)
            <option value="{{$package->user_has_package_id}}">{{$package->name}}</option>
                @endforeach       
        </select>
    </div>
    <div class="form-group ">
    <label for="subject">Subject</label>
        <input class="form-control" name="subject"  type="text" value="" placeholder="Required" id="subject">
    </div>
   
    <div class="form-group ">
    <label for="description">Deskripsi</label>
         <textarea id="description" class="form-control" name="description" rows="10" cols="50"></textarea>
    </div>

    <div class="form-group ">
    <label for="attachment">Attachment</label>
        <input class="form-control" name="file"  type="file" value="" id="attachment">
    </div>
   
</form>




<script src="{{asset('assets/vendors/stisla/ckeditor/ckeditor.js')}}"></script>
<script>
  var description = document.getElementById("description");
    CKEDITOR.replace(description,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>