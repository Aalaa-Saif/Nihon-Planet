@extends('layouts.admindashboard-app')
@section('content')

<div class="container div_reload">

    <div id="nisuccess" class="alert alert-success col-md-6 offset-md-3 font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-light">
                <div class="card-header text-center"><b>Create Nihon Info</b></div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Name in Arabic</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name_ar" autofocus>
                                    <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Info in Arabic</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="info_ar" rows="3"></textarea>
                                    <small id="info_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Name in English</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name_en" autofocus>
                                    <small id="name_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Info in English</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="info_en" rows="3"></textarea>
                                <small id="info_en_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="nihonbtn" class="btn btn-primary">
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
        $(document).on('click','#nihonbtn',function(e){
            e.preventDefault();

            $('#name_ar_error').text('');
            $('#info_ar_error').text('');
            $('#name_en_error').text('');
            $('#info_en_error').text('');


            $.ajax({
                method:'POST',
                url:"{{ route('nihon_store') }}",
                data:{
                    '_token':'{{ csrf_token() }}',
                    'name_ar':$("input[name='name_ar']").val(),
                    'info_ar':$("textarea[name='info_ar']").val(),
                    'name_en':$("input[name='name_en']").val(),
                    'info_en':$("textarea[name='info_en']").val(),
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('nisuccess');
                        div.innerHTML=data.msg;
                        $('#nisuccess').show();
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
@stop
