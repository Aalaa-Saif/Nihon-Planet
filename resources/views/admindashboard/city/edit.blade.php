@extends('layouts.admindashboard-app')
@section('content')

<div class="container div_reload">

    <div id="ciUpdatesuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light px-2">
                <div class="card-header text-center border-bottom"><b>Create Nihon Foods</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="cityUpdateid" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in Arabic</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_ar" value="{{ $city_edit->name_ar }}" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="id" style="display:none;" value="{{ $city_edit->id }}">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in Arabic</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_ar" rows="3">{{ $city_edit->info_ar }}</textarea>
                                    <small id="info_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in English</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_en" value={{ $city_edit->name_en }} autofocus>
                                    <small id="name_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in English</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_en" rows="3">{{ $city_edit->info_en }}</textarea>
                                <small id="info_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>
                        <div id="cisuim" class="alert alert-sussess" style="display:none;"></div>
                        <div id="cifalim" class="alert alert-danger" style="display:none;"></div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Photo</label>

                                @foreach ($city_edit->images as $img)
                                    <div class="mx-1 city_img{{ $img->id }}">
                                        <img class="mb-1" style="width:80px; height:80px" src="{{asset('img/city/'.$img->image)}}"><br>
                                        <a href="" class="btn btn-danger cityimg_delete text-light mb-1" cityimg_deleteid="{{ $img->id }}">Delete</a>
                                    </div>
                                @endforeach


                                <div class="offset-md-3">
                                    <input type="file" class="form-control" name="image[]" multiple>
                                    <small class="small-text text-danger font-weight-bold" role="alert"></small>
                                </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-3">
                                <button id="cityUpdatebtn" class="btn btn-primary">
                                    Update
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
        $(document).on('click','#cityUpdatebtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#cityUpdateid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('city_update') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('ciUpdatesuccess');
                    div.innerHTML=data.msg;
                    $('#ciUpdatesuccess').show();
                    setTimeout( function() {
                        $(".div_reload").load(location.href + " .div_reload");
                     }, 800 );
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



    <script>
        $(document).on('click','.cityimg_delete',function(e){
            e.preventDefault();

            var formDatadel = $(this).attr('cityimg_deleteid');
            $.ajax({
                method:"post",
                url:"{{ route('city_deleteimg') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formDatadel
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('cisuim');
                        div.innerHTML=data.msg;
                        $('#cisuim').show();
                    }
                    else {
                        var div = document.getElementById('cifalim');
                        div.innerHTML=data.msg;
                        $('#cifalim').show();
                    }

                    $('.city_img'+data.id).remove();
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




