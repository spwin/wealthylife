@extends('frontend/frame')
@section('nav-style', 'nav-blog')
@section('body-class', 'page-not-found')
@section('content')
    <section class="no-padding-all"></section>

    <section class="fullscreen">
        <div class="container error-404">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="text-center color-white">
                        <i class="ti-receipt icon icon-lg mb24 mb-xs-0 color-red"></i>
                        <h1 class="large color-white">Page Not Found</h1>
                        <p>The page you requested couldn't be found - this could be due to a spelling error in the URL or a removed page.</p>
                        <a class="btn" href="{{ action('FrontendController@index') }}">Go Back Home</a>
                        <a class="btn" href="{{ action('FrontendController@contacts') }}">Contact Us</a>
                    </div>
                </div>
            </div>
            <!--end of row-->
            <div class="embelish-icons">
                <i class="ti-help-alt"></i>
                <i class="ti-cross"></i>
                <i class="ti-support"></i>
                <i class="ti-announcement"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
                <i class="ti-marker"></i>
                <i class="ti-pulse"></i>
                <i class="ti-alert"></i>
                <i class="ti-help-alt"></i>
                <i class="ti-alert"></i>
                <i class="ti-pulse"></i>
            </div>
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop