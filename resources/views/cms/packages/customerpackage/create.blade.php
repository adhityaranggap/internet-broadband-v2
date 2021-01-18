<form method="post" action="{{ route('customer-package-store') }}">
@csrf

    <div class="form-group ">
        <label for="name">Username</label>
        <div class="form-group" style="margin-top:5px; ">
            <select class="form-control cari" id="user_id" name="user_id" style="width:100%;">
            
            </select>
        </div>
    </div>
    <div class="form-group ">
    <label for="package_id">Package Name</label>
    <select class="form-control" name="package_id">
    @foreach($package as $package)
      <option value="{{$package->id}}">{{$package->name}}</option>
    @endforeach
    </select>
    </div>
 
   
</form>

<script type="text/javascript">
$( document ).ready(function(){
	$('.cari').select2({
		placeholder: 'Username...',
		ajax: {
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // }
        url: "{{route ('customer-package-load')}}",
        dataType: 'json',
		delay: 250,
		processResults: function (data) {
 
			return {
			results:  $.map(data, function (item) {
                $('#name').empty().val(item.name).attr('readonly', true);
                // $('#price').empty().val(item.price).attr('readonly', true);
				return {
                text: item.username,
				id: item.id
				}
			})
			};
		},
        
		cache: true
		}
	});
}   );
	</script>
