@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2 myquestionshead">My Questions</h1>
                    <h2 class="lead mb0 below"></h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>




    <section>

        <div class="arrow-style index3 mob-right-to-left">
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

        <div class="container about-block">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9 no-padding">

                    <div class="toggle-button profile-menu-but bold700 visible990">
                        <span class="display-block mb16">PROFILE MENU</span>
                        <hr>
                    </div>

                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right mobile-none right ask-position-mob">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask consultant</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@questions', [$question->status == 1 ? '#pending' : ($question->status == 3 ? '#rejected' : '#answered')]) }}"><i class="ti-arrow-left"></i> Back</a></h4>
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
                                <div class="col-md-12 mb-25px">
                                    <div class="question-body">{{ $question->question }}</div>
                                </div>
                                <div class="col-md-12 mb-25px">
                                    @if($question->images)
                                        @foreach($question->images as $image)
                                            <div class="col-md-4">
                                                <a href="{{ url()->to('/').$image->path.$image->filename }}"  data-lightbox="image-{{ $image->id }}" data-title="Question #{{ $question->id }}">
                                                    <img src="{{ url()->to('/').'/photo/300x200/'.$image->filename }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr/>
                        @if($question->status == 2 && $answer)
                            <h4 class="uppercase mb16">Answer</h4>
                            {!! $answer->answer !!}
                        @elseif($question->status == 3)
                            <h4>Sorry, Your question was rejected.</h4>
                            <h5 class="mb-0px">Reason:</h5>
                            <p>{{ $question->rejection }}</p>
                            <p>Your credits were refunded to your balance.</p>
                        @else
                            <h4 class="uppercase mb16 width100on550">The answer is not ready yet, we are working on it.</h4>
                        @endif
                    </div>
                    @if($question->status == 2 && $answer && !$answer->rated)
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
                                <input type="radio" class="rating-input" id="rating-input-1-5" name="stars" value="5"/>
                                <label for="rating-input-1-5" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-4" name="stars" value="4"/>
                                <label for="rating-input-1-4" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-3" name="stars" value="3"/>
                                <label for="rating-input-1-3" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-2" name="stars" value="2"/>
                                <label for="rating-input-1-2" class="rating-star"></label>
                                <input type="radio" class="rating-input" id="rating-input-1-1" name="stars" value="1"/>
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