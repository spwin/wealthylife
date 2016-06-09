@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-right text-left-xs col-sm-6">
                    <h2 class="uppercase mb24 bold italic">Your question</h2>
                    <p class="question-body">
                        <img align="right" src="{{ url()->to('/').'/'.$question['image'] }}">
                        {{ $question['content'] }}
                    </p>
                    <div class="modal-container inline-block">
                        <a class="btn btn-modal" href="#">Edit</a>
                        @include('frontend/elements/question')
                    </div>
                    <hr class="visible-xs">
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="question-authenticate">
                        <a href="#" class="btn btn-lg social-login local" onclick="openModal('login')">Log in</a>
                    </div>
                </div>
            </div><!--end of row-->
        </div><!--end of container-->
    </section>
@stop