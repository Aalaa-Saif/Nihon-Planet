@extends('layouts.main-app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-5 bg-dark text-light">
                <div class="card-header text-center"><b>{{ __('messages.a_login_register') }}</b></div>

                <div class="card-body">
                    <form method="POST" autocomplete="off" action="{{ route('admin_check') }}">
                        @csrf
                        <div class="text-center">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.email') }}</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control" name="email" autofocus>
                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>

                        <div class="text-center">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.password') }}</label>
                        </div>
                        <div class="row mb-3">
                             <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" class="form-control" name="password">
                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.a_login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
