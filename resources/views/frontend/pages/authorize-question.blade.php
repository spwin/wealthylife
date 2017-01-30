@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('body-class', 'auth-question')
@section('content')

    <section class="page-title page-title-4 auth-head-sec image-bg parallax">
        <div class="container page-first-header mt24">
            <div class="row text-center">
                    <p class="authorize-head"><span class="bold700 color-green-prof">You need to be Logged in</span> in order to proceed. It takes less than a minute to create a new
                        account or you can use social which would take you few seconds.</p>
                <a href="#" class="btn btn-lg social-login btn-filled auth-login" onclick="openModal('login')">Log in</a>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <section class="section-blog">

        <div class="arrow-style mob-left-to-right">

        <div class="container about-block authorize-question">
            <div class="row">
                <div class="col-md-9 text-center col-sm-12 margin0auto nofloat">
                    <h2 class="uppercase mb24">Your question</h2>
                    <hr>
                    <div class="question-body">

                        <div class="question-text">
                            <p>{{ $question['content'] }}</p>
                        </div>
                        @if($question['image_exists'])
                            @foreach($question['images'] as $image)
                                <div class="col-md-4 photo-container">
                                <a href="{{ url()->to('/').'/'.$image['original'] }}" data-lightbox="image-question" data-title="Question image">
                                    <img src="{{ url()->to('/').'/'.$image['thumb'] }}">
                                </a>
                                </div>
                            @endforeach
                        @else
                            <img src="{{ url()->to('/').'/'.$question['empty'] }}">
                        @endif
                        <div class="clear"></div>
                        <hr class="mt16">
                        <div class="modal-container inline-block">
                            <a class="btn btn-modal btn-filled width240 blue-button" href="#">Edit</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div><!--end of row-->
        </div><!--end of container-->

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