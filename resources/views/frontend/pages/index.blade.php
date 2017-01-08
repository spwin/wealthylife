@extends('frontend/frame')
@section('nav-style', 'nav-home')
@section('body-class', 'front-page')
@section('after-body-snippet')
    <div class="background-image-holder">
        <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/{{ $background }}.jpg">
    </div>
@stop
@section('content')
    <section class="cover fullscreen image-slider">
        <ul class="slides">
            <li class="image-bg overlay">
                <div class="container v-align-transform">
                    <div class="row">
                        @if (Session::has('flash_notification.suspended.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.suspended.level') }} alert-filled" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.suspended.message') }}
                            </div>
                        @endif
                        @if(App\Helpers\Helpers::checkAccess())
                            <div class="col-sm-12 text-center">
                                @if($phrase)
                                    <h1 class="large" style="{{ $phrase->style }}">{!! $phrase->text !!}</h1>
                                    <p class="lead">― {!! $phrase->author !!}</p>
                                @endif
                                <div class="modal-container inline-block">
                                    <a class="btn btn-modal" href="#">Ask a question</a>
                                    <div class="hidden">
                                        @if(\App\Helpers\Helpers::isMobile())
                                            @include('mobile/frontend/elements/question')
                                        @else
                                            @include('frontend/elements/question')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('frontend/elements/countdown')
                        @endif
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