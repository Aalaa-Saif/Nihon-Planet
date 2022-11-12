@extends('layouts.main-app')
@section('content')
    <div class="container my-4">
        <div class="row food">
            @if($posts->isNotEmpty())
                @foreach ($posts as $food)
                    <div class="col-md-4 my-1">
                        <div class="card-body">
                            <img class="img-fluid card-img-top mx-auto d-block" src="{{ asset('img/food/'.$food->photo) }}" style="width:300px; height:300px;">
                            <h3 class="text-center my-1">{{ $food->name }}</h3>
                            <h5 class="text-center my-1">{{ $food->info }}</h5>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <h2>No posts found</h2>
                </div>
            @endif

        </div>
    </div>

@endsection

