@extends('layouts.main-app')
@section('content')
<div class="container mt-3">
    <div class="row nihon">

        <button type="button" class="btn btn-light text-dark nihon_model_btn offset-md-5">
            <b>{{ __('messages.nihon_modal') }}</b>
        </button>

        <div class="col-md-6 nihon-container bg-dark offset-md-3 py-4 my-5">

            @foreach ($nihon as $nihon)
               <h3>{{ $nihon->name }}</h3>
                <hr class="bg-success">
               <h4>{{ $nihon->info }}</h4>
            @endforeach

        </div>
    </div>

</div>

@endsection
