@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-9 text-center col-sm-12">
                    <h2 class="uppercase mb24 bold">Your question</h2>
                    <div class="question-body">
                        @if($question['image_exists'])
                            <a href="{{ url()->to('/').'/'.$question['image'] }}" data-lightbox="image-question" data-title="Question temp">
                                <img src="{{ url()->to('/').'/'.$question['image'] }}">
                            </a>
                        @else
                            <img src="{{ url()->to('/').'/'.$question['image'] }}">
                        @endif
                        <div class="question-text">
                            <p>{{ $question['content'] }}</p>
                        </div>
                        <div class="clear"></div>
                        <div class="modal-container inline-block">
                            <a class="btn btn-modal btn-filled" href="#">Edit</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr class="visible-xs">
                </div>
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="question-authenticate">
                        <p>
                            <i class="ti-lock"></i>
                            You need to be Logged in in order to proceed. It takes less than a minute to create a new
                            account or you can use social which would take you few seconds.
                        </p>
                        <a href="#" class="btn btn-lg social-login btn-filled" onclick="openModal('login')">Log in</a>
                    </div>
                </div>
            </div><!--end of row-->
        </div><!--end of container-->
    </section>
    @include('frontend/footer')
@stop