@extends('layouts.main-app')
@section('content')
    <div class="container">
        <div class="cloths rounded my-4 border-top border-bottom border-dark">
            @if($posts->isNotEmpty())
                @foreach ($posts as $cloth)
                    <div class="row">
                        <img class="img-fluid col-md-4 my-2 mx-1" src="{{ asset('img/cloths/'.$cloth->photo) }}" style="width:300px; height:300px;">
                        <div class="col-md-6 my-2 mx-1">
                            <h4>{{ $cloth->name }}</h4>
                            <p>{{ $cloth->info }}</p>
                        </div>
                    </div><hr style="background-color:dark;">
                @endforeach
             @else
                 <div>
                     <h2>No posts found</h2>
                 </div>
             @endif

        </div>
    </div>
@endsection



