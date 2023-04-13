@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="text-center bg-info">My Profile</div>
    </div>
    <div id="success_message"></div>
    <div class="col-lg-6 text-center">
        <label for="">Information</label>
        <hr>
        <form action="">
            <label for="name">Name</label> <small><b>{{ $user->name }}</b> </small>
            <br>
            <label for="email">Email</label><small><b>{{ $user->email }}</b> </small>
            <br>
            <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Password
                Change</button>
            {{-- <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Open Small Modal</button> --}}


        </form>
    </div>
    <div class="col-lg-3 float-end ">
        <img src="{{ $user->hasMedia('user_image') ?  $user->getMedia('user_image')[0]->getFullUrl() : '' }}" alt=""
            style="height:200px;weight:150px">

        <form action="{{ route('ProfileChange',$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" required>
            <button class="btn btn-info"> Image Change Or Upload</button>
        </form>
    </div>
</div>
{{-- modal  --}}
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Password Change</h4>
            </div>
            <div class="modal-body">
                <form  id="password_change" action="{{ route('user_password',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}" id="user_id">
                    <br>
                    <label for="current_password">Current Password </label>
                    <input type="text" name="current_password" id="current_password" class="form-control">
                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    <br>
                    <label for="new_password">New Password </label>
                    <input type="text" name="new_password" id="new_password" class="form-control">
                    @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror

                    <br>
                    <label for="confirm_password">Confirm Password </label>
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control">
                    @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror

                    <br>
                    {{-- <input type="submit" value="Confirm" class="form-control"> --}}
                    <button class="btn btn-primary">Update</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
{{-- <script>
    $('#password_change').submit(function (e){
        e.preventDefault();
        var data={
                 'current_password':$('#current_password').val(),
                 'new_password' : $('#new_password').val(),
                 'confirm_password' : $('#confirm_password').val(),
            }
         var user_id=$('#user_id').val();
         let url="{{ route('user_password',':id') }}";
         url=url.replace(':id',user_id);
            // debugger;
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    dataType: "Json",
                    success: function (response) {
                        alert('test');
                        if(response.status==200){
                            alert('test');
                            // $('success_message').html("");
                            //         $('#success_message').addClass('alert alert-success');
                            // $('#success_message').text(response.message);
                            // $('#myModal').modal('hide');
                            // $('#myModal').find('input').val("");
                }
                else{
                    alert('test');
                }
            }
        });
      });
          
</script> --}}
@endsection