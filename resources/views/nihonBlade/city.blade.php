@extends('layouts.main-app')
@section('content')
    <div class="container my-4">

        @foreach ($posts as $city)
            <div class="row my-2 py-2 px-2 border-bottom border-dark">
                <div class="col-md-12">
                    <h5>{{ $city->name }}</h5>
                    <p>{{ $city->info }}</p>
                </div>
                <div class="img_scroll">
                    @foreach ($city->images as $img)
                        <img href="" src="{{ asset('img/city/'.$img->image) }}" class="border border-dark show_image" style="width:200px; height:200px; cursor: pointer;" data-id={{ $img->id }}>

                        <div id="bigSpace-{{ $img->id }}" class="bigSpace">
                            <!-- Close Button -->
                            <button class="close" type="button">
                                <span class="close_span">&times</span>
                            </button>

                            <!-- Modal Content (Image) -->
                            <img class="modal-content img-fluid mx-auto d-block" id="img01-{{ $img->id }}" style="width:590px; height:590px;">

                            <div class="img_scroll col-md-5 mt-1 scroll_small_img">
                                @foreach ($city->images as $img)
                                   <img src="{{ asset('img/city/'.$img->image) }}" class="border border-dark show_image2" style="width:50px; height:50px;" data-id={{ $img->id }}>
                                @endforeach
                            </div>


                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach
    </div>
@endsection
