@extends('layouts.userdashboard-app')

@section('content')
    <div class="container my-2">
        <div class="row">
            <div class="float-left col-md-4 floatleft">
                Hi
            </div>

            <div class="float-right col-md-8">
                @foreach ($user as $post)
                    <div class="card  my-4 bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <img src="{{ asset('img/userimg/'.$post->user->photo) }}" class="float-left rounded-circle" style="width:50px; height:50px;">
                                    <b><h4 class="userfloat mt-2">{{ $post->user->name }}</h4></b>

                                </div>
                            </div>

                            <p class="sizefontpost">{{ $post->text }}</p>

                            @foreach ($post->userpostimgs as $img)
                                <img class="img-fluid my-1 border border-dark" src="{{ asset('img/userpostimg/'.$img->image) }}" style="width:300px; height:300px;">
                            @endforeach

                            <div class="card-footer">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    @csrf

                                    <input class="form-control toComment" id="toComment" placeholder="Click here to Comment" data-id="{{$post->id}}">
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
                                                <img class="float-left img-fluid rounded-circle" src="{{ asset('img/userimg/'.$comm->$user->photo) }}" style="width:40px; height:40px;">
                                                <b><h4 class="my-2 userfloat text-success">{{ $comm->$user->name }}</h4></b>
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
        </div>
    </div>
@endsection
