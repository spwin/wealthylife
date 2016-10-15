@extends('frontend/frame')
@section('nav-style', 'nav-home')
@section('body-class', 'front-page')
@section('after-body-snippet')
    <div class="background-image-holder">
        <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/{{ $video }}.jpg">
    </div>
@stop
@section('content')
    <section class="cover fullscreen image-slider slider-all-controls">
        <ul class="slides">
            <li class="vid-bg image-bg overlay">
                <!--div class="background-image-holder">
                    <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/{{ $video }}.jpg">
                </div-->
                <div class="fs-vid-background">
                    <!--
                    <video muted="" loop="">
                        <source src="video/{{ $video }}.mp4" type="video/mp4">
                        <source src="video/{{ $video }}.webm" type="video/webm">
                        <source src="video/{{ $video }}.ogv" type="video/ogg">
                    </video>
                    -->
                    <div class="full-back"></div>
                </div>
                <div class="container v-align-transform">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @if($phrase)
                                <h1 class="large" style="{{ $phrase->style }}"><div class="simplicity"></div><!--img class="simplicity" src="{{ url()->to('/') }}/images/SIMPLICITY.svg"-->{{ $phrase->text  }}</h1>
                                <p class="lead">― {{ $phrase->author }}</p>
                            @endif
                            <p>
                                <div class="modal-container inline-block">
                                    <a class="btn btn-modal" href="#">Ask question</a>
                                    <div class="hidden">
                                        @if(\App\Helpers\Helpers::isMobile())
                                            @include('mobile/frontend/elements/question')
                                        @else
                                            @include('frontend/elements/question')
                                        @endif
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>

                </div>
            </li>
        </ul>
        {{--<span class="scroll-btn">
            <a href="#">
                <span class="mouse">
                    <span>
                    </span>
                </span>
            </a>
        </span>--}}

    </section>
    @include('frontend/footer')
@stop