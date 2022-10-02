@extends('layouts.main-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-light my-5">
                <div class="card-header text-center"><b>{{ __('messages.login') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login_check') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autofocus>
                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.o_login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ url('otaku register') }}">
                                    {{ __('messages.o_registerbtn') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
