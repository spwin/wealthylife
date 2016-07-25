@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9 no-padding">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">New question</a>
                            @include('frontend/elements/question')
                        </div>
                        {{--<h4 class="uppercase mb16">Your question</h4>
                        <div class="your-question">
                            <div class="col-md-4">
                                <a target="_blank" href="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : '#' }}">
                                    <img src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="question-body">{{ $question->question }}</div>
                            </div>
                        </div>--}}
                        <h4 class="uppercase mb16">Answer</h4>
                        {!! $answer->answer !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop