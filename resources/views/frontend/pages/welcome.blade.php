@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')

    <section class="page-title page-title-4 height165px image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/about-bg.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2"></h1>
                    <h2 class="lead mb0 below"></h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <section>

        <div class="arrow-style mob-left-to-right">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                </div>
            </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="feature text-center">
                        <i class="ti-check-box icon icon-lg mb24 mb-xs-0"></i>
                        <h1 class="large">Welcome to <strong><span class="sitename">stylesensei.co.uk!</span></strong></h1>
                        <p class="mb-xs-24">By using this website you agree with our
                            <a href="{{ action('FrontendController@terms') }}" target="_blank">Terms and Conditions</a>
                        </p>
                        <a href="{{ action('FrontendController@authorizeQuestion') }}" class="btn btn-hover">Continue</a>
                        <ul class="list-inline social-list">
                            <li>
                                <a href="{{ env('FACEBOOK_URL') }}" rel="nofollow">
                                    <i class="icon icon-sm ti-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('GOOGLE_URL') }}" rel="nofollow">
                                    <i class="icon icon-sm ti-google"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('TWITTER_URL') }}" rel="nofollow">
                                    <i class="icon icon-sm ti-twitter-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('INSTAGRAM_URL') }}" rel="nofollow">
                                    <i class="icon icon-sm ti-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end of row-->
            <div class="embelish-icons">
                <i class="ti-pencil-alt"></i>
                <i class="ti-check"></i>
                <i class="ti-envelope"></i>
                <i class="ti-announcement"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
                <i class="ti-marker"></i>
                <i class="ti-layout"></i>
                <i class="ti-ruler-alt-2"></i>
                <i class="ti-eye"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
            </div>
        </div>
        <!--end of container-->

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop