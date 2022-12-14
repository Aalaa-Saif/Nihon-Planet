@extends('layouts.userdashboard-app')

@section('content')
<div class="container my-4">
    <div id="changeProfile" class="changeProfile">

        <form method="POST" action="" id="profile_update_id" class="div_reload" enctype="multipart/form-data">
            @csrf
            <div id="success_msg" class='alert alert-info mx-5 text-center' style="display: none;">
            </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-center">User Name</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
                            <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                    </div>
                </div>
                <input type="text" class="form-control" name="id" style="display:none;" value="{{ $user->id }}" reload_id="{{ $user->id }}">

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-center">User Photo</label>

                        <img class="img-fluid ml-3" style="width:100px; height:100px" src="{{asset('img/userimg/'.$user->photo)}}">

                        <div class="col-md-5 mt-5">
                            <input type="file" class="form-control mt-2" name="photo">
                                <small class="small-text text-danger font-weight-bold" role="alert"></small>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-3">
                        <button id="profile_update_btn" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
        </form>
        <button class="close text-light profile_close" type="button">
            <span>&#8594</span>
        </button>

    </div>

            <div class="card-body img_name reload">
                <img src="{{ asset('img/userimg/'.$user->photo) }}" style="width: 200px; height:200px;" class='rounded-circle img-fluid mx-auto d-block border border-dark'>
                <div class="text-center my-2">
                    <h3>{{$user->name }}</h3>
                </div>
            </div>
            <img src="{{ asset('img/edit.png') }}" style="width:15px; height:15px;" class="click_pen" alt="edit">
                <form method="POST" action="" id="postid" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-light col-md-8 offset-md-2">
                        <div class="card-body">
                            <textarea class="form-control" placeholder="{{ __('messages.postWrite') }}" name="text" rows="4"></textarea>

                            <div class="image_upload offset-md-10">
                                <label for="file-input">
                                    <img src="{{ asset('img/upload_icon.png') }}" style="width:50px; height:50px;">
                                </label>

                                <input id="file-input" type="file" name="image[]" multiple>
                            </div>
                            <div class="offset-md-10">
                                <button id="postbtn" class="btn btn-info">{{ __('messages.send') }}</button>
                            </div>
                        </div>
                    </div>

                </form>


                <br>
                <br>

            @if($posts->isNotEmpty())
                @foreach ($posts as $post)
                    <div class="card my-4 col-md-8 offset-md-2 bg-light post_content{{ $post->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                        <img class="float-left img-fluid border border-dark rounded-circle" src="{{ asset('img/userimg/'.$user->photo) }}" style="width:50px; height:50px;">
                                        <b><h4 class="my-2 userfloatname">{{ $user->name }}</h4></b>
                                </div>
                                <div class="col-md-1 offset-md-3">
                                    <img src="{{ asset('img/options.png') }}"style="width:15px; height:15px;" class="dropdown-toggle" href="#" id="drop2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-menu" aria-labelledby="drop2" role="menu">
                                          <a postDelete_id="{{ $post->id }}" class="btn post_delete" role="button">{{ __('messages.delete') }}</a>
                                    </div>
                                </div>
                            </div>

                            <p class="sizefontpost">{{ $post->text }}</p>

                            @foreach ($post->userpostimgs as $img)
                                <img class="img-fluid my-1 multiImg" src="{{ asset('img/userpostimg/'.$img->image) }}" style="width:300px; height:300px;" data-id={{ $img->id }}>
                                <div id="bigSpaceImg-{{ $img->id }}" class="bigSpaceImg">

                                    <button class="close text-light" type="button">
                                        <span>&times</span>
                                    </button>

                                    <img class="modal-content img-fluid mx-auto d-block" id="Image-{{ $img->id }}" style="width:600px; height:600px;">
                                </div>
                            @endforeach

                            <div class="card-footer">
                                <form method="POST" action="">
                                    @csrf
                                    <input class="form-control to_Comment" placeholder="{{ __('messages.clickHere') }}" data-id={{ $post->id }}>
                                    <p class="blockqoute offset-md-9">{{ $post->created_at }}</p>
                                </form>
                            </div>

                            <div id="bigSpace-{{ $post->id }}" class="bigSpace">

                                <div class="reload_div-{{ $post->id }}  mx-1">

                                    <form method="POST" action="" class="form_comment">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control col-md-6 offset-md-3 comment-{{ $post->id }} border-dark" name="comment" placeholder="Write a comment" row="3"></textarea>
                                        </div>


                                        <button href="" comment_id="{{ $post->id }}" class="btn btn-info pull-right comment_btn my-2">Send</button>
                                    </form>

                                        <div class="row">
                                            <div class="col-md-6 offset-md-3 comment_space">
                                                <div class="scroll_post">
                                                    @foreach ($post->comments as $comm)
                                                    <img class="float-left img-fluid border border-dark rounded-circle" src="{{ asset('img/userimg/'.$comm->user->photo) }}" style="width:40px; height:40px;">
                                                    <b><h5 class="my-2 userfloat text-dark">{{ $comm->user->name }}</h5></b>
                                                    <div class="col-xs-2 ml-5 mb-2">
                                                        <p id="comment_p" class="text-dark bg-light border rounded comment_p">{{ $comm->comment }}</p>
                                                    </div>
                                                    @endforeach
                                                </div>
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
            @else
                <div>
                    <h2 class="text-center">No posts found</h2>
                </div>
            @endif
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
                success:function(){
                    location.reload();
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

                        scrollTop: $(".comment_p").offset().top;
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
        $(document).on('click','.post_delete',function(e){
            e.preventDefault();

            var formData = $(this).attr('postDelete_id');
            $.ajax({
                method:"post",
                url:"{{ route('post_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formData
                },

                success:function(data){
                    if(data.status==true){
                    }
                    else {
                    }
                    $('.post_content'+data.id).remove();
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
        $(document).on('click','#profile_update_btn',function(e){
            e.preventDefault();

            var formData = new FormData($('#profile_update_id')[0]);

            $.ajax({
                method:"post",
                enctype:"multipart/form-data",
                url:"{{ route('profile_user_update') }}",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if(data.status==true){
                        var div =  document.getElementById('success_msg');
                        div.innerHTML=data.msg;
                        $('#success_msg').show();
                        setTimeout( function() {
                            $(".reload").load(location.href + " .reload");
                        }, 800 );
                        setTimeout( function() {
                            $(".div_reload").load(location.href + " .div_reload");
                         }, 2000 );
                    }
                },
                error:function(reject){

                }
            });
        });

    </script>
@endsection



