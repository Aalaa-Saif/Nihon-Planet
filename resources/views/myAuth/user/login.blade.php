@extends('layouts.main-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-light my-5">
                <div class="card-header text-center"><b>{{ __('messages.login') }}</b></div>

                <div class="card-body o_login_back">
                    <form method="POST" autocomplete="off" action="{{ route('login_check') }}">
                        @csrf

                            <div class="text-center">
                                <label for="email" class="col-form-label">{{ __('messages.email') }}</label>
                            </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control" name="email" autofocus>
                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>


                            <div class="text-center">
                                <label for="myPass" class="col-form-label">{{ __('messages.password') }}</label>
                            </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input id="myPass" type="password" class="form-control" name="password">
                            </br>
                                <input type="checkbox" id="checkPass"><spam class="text-light checktext">{{ __('messages.showPassword') }}</spam>

                                    <small class="invalid-feedback" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.o_login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4 offset-md-4">
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
