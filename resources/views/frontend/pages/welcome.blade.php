@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="fullscreen">
        <div class="container v-align-transform">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="feature text-center">
                        <i class="ti-check-box icon icon-lg mb24 mb-xs-0"></i>
                        <h1 class="large">Welcome to <strong>stylesensei.co.uk!</strong></h1>
                        <p class="mb-xs-24">By using this website you agree with our
                            <a href="{{ action('FrontendController@terms') }}" target="_blank">Terms and Conditions</a>
                        </p>
                        <a href="{{ action('FrontendController@authorizeQuestion') }}" class="btn btn-hover">Continue</a>
                        <ul class="list-inline social-list">
                            {{--<li>
                                <a href="#">
                                    <i class="icon icon-sm ti-twitter-alt"></i>
                                </a>
                            </li>--}}
                            <li>
                                <a href="#">
                                    <i class="icon icon-sm ti-facebook"></i>
                                </a>
                            </li>
                            {{--<li>
                                <a href="#">
                                    <i class="icon icon-sm ti-instagram"></i>
                                </a>
                            </li>--}}
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
    </section>
    @include('frontend/footer')
@stop