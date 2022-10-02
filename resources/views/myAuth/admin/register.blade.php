@extends('layouts.main-app')

@section('content')
<div class="container my-5">

    <div id="adminregsuccess" class="alert alert-success col-md-6 offset-md-3 text-center font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><b>Admin Register</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="adminregid" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('messages.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" autofocus>
                                    <small id="name_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email">
                                    <small id="email_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                    <small id="password_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row-md-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('messages.photo') }}</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                                <small id="photo_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>

                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="adminregbtn" class="btn btn-primary">
                                    {{ __('messages.registerbtn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        $(document).on('click','#adminregbtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#adminregid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('admin_store') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('adminregsuccess');
                    div.innerHTML=data.msg;
                    $('#adminregsuccess').show();
                    location.reload(true,4000);
                    }
                },
                error:function(reject){
                    var ajaxresponse = $.parseJSON(reject.responseText);
                    $.each(ajaxresponse.errors,function(key,val){
                        $("#"+key+"_error").text(val[0]);
                    });
                }
            });
        });
    </script>
@endsection
