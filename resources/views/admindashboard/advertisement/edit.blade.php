@extends('layouts.admindashboard-app')
@section('content')

<div class="container">

    <div id="adUpdatesuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light px-2">
                <div class="card-header text-center border-bottom"><b>Create Nihon Advertisement</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="adUpdateid" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Title or Text</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="text" value="{{ $ad->text }}" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="id" style="display:none;" value="{{ $ad->id }}">

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Vedio</label>

                            <video id="my-video" class="video-js" controls preload="auto" width="150" height="150" data-setup="{}">
                                <source src="{{ asset('img/ad/'.$ad->media) }}" type="video/mp4" />
                            </video>
                                <div class="col-md-5 mt-5">
                                    <input type="file" class="form-control mt-2" name="media">
                                        <small class="small-text text-danger font-weight-bold" role="alert"></small>
                                </div>


                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-3">
                                <button id="foodUpdatebtn" class="btn btn-primary">
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
        $(document).on('click','#foodUpdatebtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#foodUpdateid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('food_update') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('foUpdatesuccess');
                    div.innerHTML=data.msg;
                    $('#foUpdatesuccess').show();
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
