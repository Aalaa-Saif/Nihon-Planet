@extends('layouts.admindashboard-app')
@section('content')

<div class="container div_reload">

    <div id="niUpdatesuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light px-2">
                <div class="card-header text-center border-bottom"><b>Edit Nihon Info</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="nihonUpdateid" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in Arabic</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_ar" value="{{ $nihon->name_ar }}" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="id" style="display:none;" value="{{ $nihon->id }}">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in Arabic</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_ar" rows="3">{{ $nihon->info_ar }}</textarea>
                                    <small id="info_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Name in English</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_en" value={{ $nihon->name_en }} autofocus>
                                    <small id="name_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Info in English</label>

                            <div class="col-md-7">
                                <textarea class="form-control" name="info_en" rows="3">{{ $nihon->info_en }}</textarea>
                                <small id="info_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3 offset-md-3">
                                <button id="nihonUpdatebtn" class="btn btn-primary">
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
        $(document).on('click','#nihonUpdatebtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#nihonUpdateid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('nihon_update') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('niUpdatesuccess');
                        div.innerHTML=data.msg;
                        $('#niUpdatesuccess').show();
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
