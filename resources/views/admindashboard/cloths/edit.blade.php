@extends('layouts.admindashboard-app')
@section('content')

<div class="container">

    <div id="clUpdatesuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light px-2">
                <div class="card-header text-center border-bottom"><b>Create Nihon Cloths</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="clothsUpdateid" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in Arabic</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_ar" value="{{ $food_edit->name_ar }}" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="id" style="display:none;" value="{{ $food_edit->id }}">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in Arabic</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_ar" rows="3">{{ $food_edit->info_ar }}</textarea>
                                    <small id="info_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in English</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_en" value={{ $food_edit->name_en }} autofocus>
                                    <small id="name_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in English</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_en" rows="3">{{ $food_edit->info_en }}</textarea>
                                <small id="info_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Photo</label>

                                <img class="img-fluid ml-3" style="width:100px; height:100px" src="{{asset('img/food/'.$food_edit->photo)}}">

                                <div class="col-md-5 mt-5">
                                    <input type="file" class="form-control mt-2" name="photo">
                                        <small class="small-text text-danger font-weight-bold" role="alert"></small>
                                </div>


                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-3">
                                <button id="clothsUpdatebtn" class="btn btn-primary">
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
        $(document).on('click','#clothsUpdatebtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#clothsUpdateid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('cloths_update') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('clUpdatesuccess');
                    div.innerHTML=data.msg;
                    $('#clUpdatesuccess').show();
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
