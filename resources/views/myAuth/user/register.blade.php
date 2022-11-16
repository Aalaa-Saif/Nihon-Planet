@extends('layouts.main-app')

@section('content')
<div class="container my-5">

    <div id="regsuccess" class="alert alert-success col-md-6 offset-md-3 text-center font-weight-bold" style="display:none">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-light">
                <div class="card-header text-center"><b>{{ __('messages.register') }}</b></div>

                <div class="card-body">
                    <form method="POST" autocomplete="off" action="{{ route('otaku_store') }}" id="regid" enctype="multipart/form-data">

                        @if (Session::get('success'))
                        <div class="alert alert-info">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label">{{ __('messages.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" autofocus>
                                    <small id="name_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('messages.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email">
                                    <small id="email_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="myPass" class="col-md-4 col-form-label">{{ __('messages.password') }}</label>

                            <div class="col-md-6">
                                <input id="myPass" type="password" class="form-control" name="password">
                                <input type="checkbox" id="checkPass"><spam class="text-light checktext">{{ __('messages.showPassword') }}</spam>
                                    <small id="password_error" class="small-text text-danger font-weight-bold" role="alert"></small>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('messages.confirmPassword') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                <input type="checkbox" id="checkPassConf"><spam class="text-light checktext">{{ __('messages.showPassword') }}</spam>
                                <small id="password_confirmation_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label">{{ __('messages.photo') }}</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                                <small id="photo_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="regbtn" class="btn btn-primary">
                                    {{ __('messages.registerbtn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

