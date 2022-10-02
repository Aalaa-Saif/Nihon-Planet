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
                    <div class="card  my-4 bg-light">
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
                                    <input class="form-control to_Comment" id="to_Comment" placeholder="Click here to Comment" data-id="{{$post->id}}">
                                </form>
                            </div>

                                <!-- Modal Content (Comments) -->
                                <div id="bigSpace-{{ $post->id }}" class="bigSpace py-4">
                                    <form method="POST" id="commentid" action="">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2 my-4">
                                                <textarea class="form-control" name="comment" placeholder="Comment here" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-2 my-5">
                                                <button comment_id="{{ $post->id }}" class="btn btn-info commentbtn">Send</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div>
                                        <p class="text-center text-info">{{ $post->id }}</p>
                                        @foreach ($post->comments as $comm)
                                            <div class="row mt-1">
                                                <div class="col-md-8 offset-md-2 mb-2 border border-info">
                                                    <img class="float-left img-fluid rounded-circle" src="{{ asset('img/userimg/'.$user->photo) }}" style="width:40px; height:40px;">
                                                    <b><h4 class="my-2 userfloat text-success">{{ $user->name }}</h4></b>
                                                    <p class="text-info text-center">{{ $comm->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
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
        $(document).on('click','.commentbtn',function(e){
            e.preventDefault();

            var commentidData = $(this).attr('comment_id');
            $.ajax({
                method:"post",
                url:"{{ route('comment_store') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "comment":$("textarea[name='comment']").val(),
                    "id":commentidData,
                },

                success:function(data){

                    if(data.status == true){
                        location.reload();
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


