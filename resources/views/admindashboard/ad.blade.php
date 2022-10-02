@extends('layouts.admindashboard-app')
@section('content')
    <div class="container">
        <div id="adsuccess" class="alert alert-success" style="display:none"></div>
        <div class="row">
            <form method="POST" id="adid" action="" enctype="multipart/form-data">
                <input type="file" class="form-control" name="ad">

                <button id="adbtn" class="btn btn-info">Send</button>
            </form>
        </div>
    </div>
@stop

<script>
    $(document).on('click','#adbtn',function(e){
        e.preventDefault();

        var formData = new FormData($('#adid')[0]);
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
