@extends('layouts.admindashboard-app')
@section('content')

<div class="container div_reload">

    <div id="cisuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none"></div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light">
                <div class="card-header text-center border-bottom"><b>Create Nihon City</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="cityid" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in Arabic</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_ar" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in Arabic</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_ar" rows="3"></textarea>
                                    <small id="info_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in English</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_en" autofocus>
                                    <small id="name_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in English</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_en" rows="3"></textarea>
                                <small id="info_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Photo</label>

                            <div class="col-md-7">
                                <input type="file" class="form-control" name="image[]" multiple>
                                    <small class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="citybtn" class="btn btn-primary">
                                    Send
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
        $(document).on('click','#citybtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#cityid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('city_store') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('cisuccess');
                    div.innerHTML=data.msg;
                    $('#cisuccess').show();
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
@endsection
