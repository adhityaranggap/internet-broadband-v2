<form method="post" action="{{ route('customer-update', $data['user']->id)  }}">
@csrf
    <div class="form-group ">
        <label for="username">Username</label>
        <input class="form-control" name="username" type="text" value="{{$data['user']->username}}" id="username">
    </div>
    <div class="form-group ">
        <label for="name">Name</label>
        <input class="form-control" name="name" type="text" value="{{$data['user']->name}}" id="name">
    </div>
    <div class="form-group ">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Package</th>
                <th scope="col">Harga Package</th>
                <th scope="col">Kecepatan Upload</th>
                <th scope="col">Kecepatan Download</th>
                </tr>
            </thead>
            <tbody>
            @forelse($data['package'] as $key => $package)
                <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $package->package_name }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->upload  . ' ' .$package->upload_unit . 'bps'}}</td>
                <td>{{ $package->download  . ' ' .$package->download_unit . 'bps' }}</td>
                </tr>
            @empty
                <tr>Data Paket Kosong</tr>
            @endforelse
            </tbody>
            </table>
        
    </div>
    <div class="form-group ">
        <label for="name">Address</label>
        <textarea class="form-control" name="address" placeholder="Required">{{$data['user']->address}}</textarea>
    </div>    
    <div class="form-group ">
        <label for="name">Daftar Paket</label>
        <select id="list-packages" class="form-control">
            @forelse($data['package'] as $package)
            <option value="{{$package->id}}">{{$package->package_name}}</option>
            @empty
            @endforelse
        </select>        
    </div>
    <div class="form-group ">
        <div class="" id="table-package"></div>
    </div>
    
</form>

<script>
    $('.select2').select2();

    $('#list-packages').on('change', function(){       
        var url = "{{ route('customer-package-show-by-user-package') }}";

        $.ajax({
            url: url,
            type: "GET",
            data: {
                'user_package_id': $(this).val()
            },

            success: function(response) {

                // debugging
                // console.log(response);

               
                if(response.length > 0){                    
                    var data = '';
                    $.each(response, function(key,value){
                        var buttonId = 'button-'+value.id;
                        var url = "{{route("all-transaction-edit", 0)}}",
                            newurl = url.split('/').slice(0,-1).join('/')+'/'+value.id;
                            console.log(newurl);

                        var button = '<a id="'+buttonId+'" href="'+newurl+'" class="btn btn-outline-warning modal-show edit"><i class="fas fa-edit"></i> Ubah</a>';
            

                        data += '<tr>'+
                                '<td>'+value.id+'</td>'+
                                '<td>'+value.expired_date+'</td>'+
                                '<td>'+value.status+'</td>'+
                                '<td>'+button+
                            '</tr>';
                    });


                    $('#table-package').empty().append(
                    '<table class="table">'+
                        '<tr>'+
                            '<td>'+
                                'No'+
                            '</td>'+
                            '<td>'+
                                'Expired Date'+
                            '</td>'+
                            '<td>'+
                                'Status'+
                            '</td>'+
                            '<td>'+
                                'Action'+
                            '</td>'+
                        '</tr>'+
                        data+
                    '</table>');
                }
                console.log(response);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });

    });
</script>