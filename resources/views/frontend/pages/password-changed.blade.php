@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="no-padding-all"></section>
    <section class="fullscreen reset-pass new-pass">
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
            </div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="text-center error-404">
                        <i class="ti-lock icon icon-lg mb24 mb-xs-0 color-white"></i>
                        <h1 class="large color-white">You can now login</h1>
                        <div class="col-sm-8 col-sm-offset-2">
                            <a href="#" class="btn btn-lg social-login btn-filled" onclick="openModal('login')">Log in</a>
                        </div>
                        <a class="btn" href="{{ action('FrontendController@index') }}">Homepage</a>
                        <a class="btn" href="{{ action('FrontendController@contacts') }}">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop