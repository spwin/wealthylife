@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('body-class', 'reset-pass-page')
@section('content')
    <section class="no-padding-all"></section>

    <section class="fullscreen reset-pass">

            <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    @if (Session::has('flash_notification.password.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.password.level') }} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('flash_notification.password.message') }}
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="feature text-center">
                        <h2 class="large color-white">Enter your <span class="color-red">E-mail</span></h2>
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('UserController@resetPassword'),
                            'class' => 'reset-pass',
                            'method' => 'POST'
                        ]) !!}
                        {!! Form::input('email', 'email', null, ['class' => 'text-center']) !!}
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" class="btn btn-filled" value="Send me reset link">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop