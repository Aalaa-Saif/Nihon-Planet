@extends('layouts.main-app')
@section('content')
<div class="container mt-3">
    <div class="row">


        <div class="col-md-6 nihon-container offset-md-3 py-4 my-5" dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" >

            @foreach ($nihon as $nihon)
               <h3 class="po">{{ $nihon->name }}</h3>
                <hr class="bg-success">
               <h4>{{ $nihon->info }}</h4>
            @endforeach

        </div>
    </div>



@endsection
