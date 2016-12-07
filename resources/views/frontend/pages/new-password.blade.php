@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')U
    <section class="fullscreen">
        <div class="container v-align-transform">
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
                        <h2 class="large">Please enter new password:</h2>
                        @if (count($errors->password) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->password->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('UserController@savePassword', ['id' => $user->id]),
                            'class' => 'new-pass',
                            'method' => 'POST'
                        ]) !!}
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="input-with-label text-left">
                                {!! Form::input('password', 'password', '', ['class' => 'less-profile-input-margin', 'placeholder' => 'New Password']) !!}
                                {!! Form::input('password', 'password_confirmation', '', ['class' => 'less-profile-input-margin', 'placeholder' => 'Repeat Password']) !!}
                            </div>
                            <input type="submit" class="btn btn-filled" value="Save my password">
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