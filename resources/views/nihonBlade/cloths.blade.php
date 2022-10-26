@extends('layouts.main-app')
@section('content')
    <div class="container">
        <div class="cloths bg-light rounded my-4">
            @if($posts->isNotEmpty())
                @foreach ($posts as $cloth)
                    <div class="row">
                        <img class="img-fluid col-md-4 my-2 mx-1" src="{{ asset('img/cloths/'.$cloth->photo) }}" style="width:300px; height:300px;">
                        <div class="col-md-6 my-2 mx-1">
                            <h4>{{ $cloth->name }}</h4>
                            <p>{{ $cloth->info }}</p>
                        </div>
                    </div><hr>
                @endforeach
             @else
                 <div>
                     <h2>No posts found</h2>
                 </div>
             @endif

        </div>
    </div>
@endsection



