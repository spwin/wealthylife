@extends('frontend/frame')
@section('nav-style', 'nav-home')
@section('content')
    <section class="cover fullscreen image-slider slider-all-controls">
        <ul class="slides">
            <li class="vid-bg image-bg overlay">
                <div class="background-image-holder">
                    <img alt="Background Image" class="background-image" src="https://unsplash.imgix.net/photo-1425321395722-b1dd54a97cf3?q=75&amp;fm=jpg&amp;w=1080&amp;fit=max&amp;s=9e4ce3e023621d6f94259eea8fa3b856">
                </div>
                <div class="fs-vid-background">
                    <video muted="" loop="">
                        <source src="video/{{ $video }}.mp4" type="video/mp4">
                        <source src="video/{{ $video }}.webm" type="video/webm">
                        <source src="video/{{ $video }}.ogv" type="video/ogg">
                    </video>
                </div>
                <div class="container v-align-transform">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="large">Your future you create today</h1>
                            <p class="lead">
                                The best personal fitness knowledge and motivation source online
                            </p>
                            <p>
                                <div class="modal-container inline-block">
                                    <a class="btn btn-modal" href="#">Ask question</a>
                                    @include('frontend/elements/question')
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