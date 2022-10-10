@extends('layouts.userdashboard-app')

@section('content')
<div class="container my-4">

            <div class="card-body">
                <img src="{{ asset('img/userimg/'.$user->photo) }}" style="width: 200px; height:200px;" class='rounded-circle img-fluid mx-auto d-block border border-dark'>

                <div class="text-center my-2">
                    <h3>{{$user->name }}</h3>
                </div>
            </div>



            <div id="posuccess" class="alert alert-success" style="display:none;"></div>

                <form method="POST" action="" id="postid" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-light">
                        <div class="card-body">
                            <textarea class="form-control" placeholder="Write here what's in your mind" name="text" rows="4"></textarea>

                            <div class="image_upload offset-md-10">
                                <label for="file-input">
                                    <img src="{{ asset('img/upload_icon.png') }}" style="width:50px; height:50px;">
                                </label>

                                <input id="file-input" type="file" name="image[]" multiple>
                            </div>
                            <div class="offset-md-10">
                                <button id="postbtn" class="btn btn-info">Send</button>
                            </div>
                        </div>
                    </div>

                </form>


                <br>
                <br>


                @foreach ($posts as $post)
                    <div class="card my-4 bg-light ll{{ $post->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                        <img class="float-left img-fluid rounded-circle" src="{{ asset('img/userimg/'.$user->photo) }}" style="width:50px; height:50px;">
                                        <b><h4 class="my-2 userfloat">{{ $user->name }}</h4></b>
                                </div>
                            </div>


                            <p class="sizefontpost">{{ $post->text }}</p>

                            <p>{{ $post->id }}</p>

                            @foreach ($post->userpostimgs as $img)
                                <img class="img-fluid my-1" src="{{ asset('img/userpostimg/'.$img->image) }}" style="width:300px; height:300px;">
                            @endforeach

                            <div class="card-footer">
                                <form method="POST" action="">
                                    @csrf
                                    <input class="form-control to_Comment" placeholder="Click here to comment" data-id={{ $post->id }}>
                                </form>
                            </div>

                            <div id="bigSpace-{{ $post->id }}" class="bigSpace">

                                <div class="reload_div-{{ $post->id }}">

                                    <form method="POST" action="" class="form_comment">
                                        @csrf
                                        <textarea class="form-control col-md-6 offset-md-3 comment-{{ $post->id }} border-dark" name="comment" placeholder="Write a comment" row="3"></textarea>

                                        <button href="" comment_id="{{ $post->id }}" class="btn btn-info offset-md-8 comment_btn my-2">Send</button>
                                    </form>


                                        <div class="row mt-1">
                                            <div class="col-md-8 offset-md-3 mb-2">
                                                @foreach ($post->comments as $comm)
                                                <img class="float-left img-fluid rounded-circle" src="{{ asset('img/userimg/'.$comm->user->photo) }}" style="width:40px; height:40px;">
                                                <b><h5 class="my-2 userfloat text-dark">{{ $comm->user->name }}</h5></b>
                                                <div class="col-md-8 offset-md-1 mb-2">
                                                    <p class="text-dark bg-light border rounded comment_p">{{ $comm->comment }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>


                                </div>

                                <button class="close text-light" type="button">
                                    <span>&times</span>
                                </button>

                            </div>

                        </div>
                    </div>
                @endforeach


</div>
@endsection


@section('script')
    <script>
        $(document).on('click','#postbtn',function(e){
            e.preventDefault();

            var formData = new FormData($('#postid')[0]);
            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('post_store') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('posuccess');
                    div.innerHTML=data.msg;
                    $('#posuccess').show();
                    location.reload(true);
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
        $(document).on('click','.comment_btn',function(e){
            e.preventDefault();

            var commentId = $(this).attr('comment_id');
            $.ajax({
                method:"post",
                url:"{{ route('comment_store') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "comment":$(".comment-"+commentId).val(),
                    "id":commentId,
                },

                success:function(data){
                    if(data.status == true){
                        setTimeout( function() {
                            $(".reload_div-"+commentId).load(location.href + " .reload_div-"+commentId);
                         }, 400 );
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



