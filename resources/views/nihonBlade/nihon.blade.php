@extends('layouts.main-app')
@section('content')
    <div class="container my-4">
        <div class="row">

            <div class="col-md-6 nihon-container offset-md-3 py-4 my-5">
            <div class="my-5">
                @foreach ($nihon as $nihon)
                <h3>{{ $nihon->name }}</h3>
                    <hr class="bg-success">
                <h4>{{ $nihon->info }}</h4>
                @endforeach
                </div>
            </div>

        </div>
    </div>
<br>
<br>
<br>
@endsection

