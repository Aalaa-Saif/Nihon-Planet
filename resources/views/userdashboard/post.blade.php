@extends('layouts.userdashboard-app')

@section('content')
    <div class="container my-2">
        <div class="row">
            <div class="float-left col-md-4 floatleft">
                Hi
            </div>

            <div class="float-right col-md-8">

                @foreach ($posts as $post)
                    <div class="card  my-4 bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <img src="{{ asset('img/userimg/'.$post->user->photo) }}" class="float-left rounded-circle" style="width:50px; height:50px;">
                                    <b><h4 class="userfloat mt-2">{{ $post->user->name }}</h4></b>

                                </div>
                            </div>

                            <p class="sizefontpost">{{ $post->text }}</p>
                            <p class="text-center text-info">{{ $post->id }}</p>

                            @foreach ($post->userpostimgs as $img)
                                <img class="img-fluid my-1 border border-dark" src="{{ asset('img/userpostimg/'.$img->image) }}" style="width:300px; height:300px;">
                            @endforeach

                            <div class="card-footer">
                                <form method="POST" action="">
                                    @csrf
                                    <input class="form-control to_Comment" id="to_Comment" placeholder="Click here to Comment" data-id="{{$post->id}}">
                                </form>
                            </div>

                                <!-- Modal Content (Comments) -->

                            <div id="bigSpace-{{ $post->id }}" class="bigSpace">

                                <div class="reload_div-{{ $post->id }}">

                                    <form method="POST" action="" class="form_comment">
                                        @csrf
                                        <textarea class="form-control col-md-6 offset-md-3 comment-{{ $post->id }} border-dark" name="comment" placeholder="Write a comment" row="3"></textarea>

                                        <button href="" comment_id="{{ $post->id }}" class="btn btn-info offset-md-8 comment_btn my-2">Send</button>
                                    </form>


                                        <div class="row mt-1">
                                            <div class="col-md-8 offset-md-3 mb-2">



                                                <div class="col-md-8 offset-md-1 mb-2">
                                                    @foreach ($post->comments as $comm)

                                                        <img class="float-left img-fluid rounded-circle" src="{{ asset('img/userimg/'.$comm->user['photo']) }}" style="width:40px; height:40px;">
                                                        <b><h5 class="my-2 userfloat text-dark">{{ $comm->user['name'] }}</h5></b>

                                                    <p class="text-dark bg-light border rounded comment_p">{{ $comm->comment }}</p>
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

            </div>
        </div>
    </div>
@endsection


@section('script')
 <script>
    $(document).on('click','.comment_btn',function(e){
        e.preventDefault();

        var post_commentId = $(this).attr('comment_id');
        $.ajax({
            method:"post",
            url:"{{ route('comment_store') }}",
            data:{
                "_token":"{{ csrf_token() }}",
                "comment":$(".comment-"+post_commentId).val(),
                "id":post_commentId,
            },

            success:function(data){
                if(data.status == true){
                    setTimeout( function() {
                        $(".reload_div-"+post_commentId).load(location.href + " .reload_div-"+post_commentId);
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




