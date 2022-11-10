@extends('layouts.admindashboard-app')
@section('content')

<div class="container">

    <div id="adsuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light">
                <div class="card-header text-center border-bottom"><b>Advertisement</b></div>

                <div class="card-body">
                    <form method="POST" action="" id="ad_id" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Text</label>

                            <div class="col-md-7">
                                <textarea type="text" class="form-control" name="text" row="3" autofocus></textarea>
                                    <small id="text_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-center">Media (Only video)</label>

                            <div class="col-md-7">
                                <input type="file" class="form-control" name="media">
                                    <small id="media_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button id="ad_btn" class="btn btn-primary">
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
        $(document).on('click','#ad_btn',function(e){
            e.preventDefault();

            var formData = new FormData($('#ad_id')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('ad_store') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){

                    if(data.status==true){
                        var div = document.getElementById('adsuccess');
                    div.innerHTML=data.msg;
                    $('#adsuccess').show();
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
