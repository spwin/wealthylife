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
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@questions', ['#answered']) }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        @if (Session::has('flash_notification.answer.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.answer.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.answer.message') }}
                            </div>
                        @endif
                        <h4 class="uppercase mb16">Your Question</h4>
                        <div class="your-question mb16">
                            <div class="row">
                                <div class="col-md-4">
                                    <a target="_blank" href="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : '#' }}">
                                        <img src="{{ $question->image()->first() ? url()->to('/').'/photo/300x200/'.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="question-body">{{ $question->question }}</div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h4 class="uppercase mb16">Answer</h4>
                        {!! $answer->answer !!}
                    </div>
                    @if(!$answer->rated)
                        <div class="col-md-6 no-padding answer-rating display-after-load">
                            <hr/>
                            @if (count($errors->answer) > 0)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->answer->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4>Rate this answer!</h4>
                            {!! Form::open([
                                'role' => 'form',
                                'url' => action('UserController@rateAnswer', ['id' => $answer->id]),
                                'method' => 'POST',
                                'class' => 'rate-answer'
                            ]) !!}
                            <div class="rating-wrapper">
                                <input type="radio" class="rating-input" id="rating-input-1-5" name="stars" value="1"/>
                                <label for="rating-input-1-5" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-4" name="stars" value="2"/>
                                <label for="rating-input-1-4" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-3" name="stars" value="3"/>
                                <label for="rating-input-1-3" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-2" name="stars" value="4"/>
                                <label for="rating-input-1-2" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-1" name="stars" value="5"/>
                                <label for="rating-input-1-1" class="rating-star"></label>
                            </div>
                            <div class="input-with-label text-left">
                                {!! Form::textarea('comment', null, ['size' => '30x3']) !!}
                            </div>
                            <input type="submit" class="btn btn-filled" value="Submit">
                            {!! Form::close() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop