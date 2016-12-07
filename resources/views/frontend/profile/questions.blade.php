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

    <section class="myquestions">

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

        <div class="container about-block notifications">
            <div class="row">

                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif

                <div class="col-md-9">

                    <div class="toggle-button profile-menu-but bold700 visible990">
                        <span class="display-block mb16">PROFILE MENU</span>
                        <hr>
                    </div>

                    <div class="tabbed-content text-tabs display-after-load questions-container">
                        <div class="modal-container text-right ask-position-mob right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16">Questions</h4>
                        {{--<p class="lead mb64">
                            Some info about questions
                        </p>--}}
                        @if (Session::has('flash_notification.question.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.question.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.question.message') }}
                            </div>
                        @endif
                        <ul class="tabs mb-0px">
                            <li id="pending-section">
                                <a href="#pending">
                                    <div class="tab-title">
                                        <span>
                                            Pending
                                            @if($pending->total() > 0)
                                                (<span class="numbers">{{ $pending->total() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($pending->total() > 0)
                                        <table class="table">
                                            @foreach($pending as $question)
                                                <tr>
                                                    <td class="text-left w180px noneon460" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                                                        @if(count($question->images) > 0)
                                                            @foreach($question->images as $image)
                                                                <img class="question-list" src="{{ url()->to('/').'/photo/50x30/'.$image->filename }}">
                                                            @endforeach
                                                        @else
                                                            <img class="question-list" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center w170px" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ date('d M, Y H:i', strtotime($question->updated_at)) }}</td>
                                                    <td onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)).'...' }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No pending questions.</p>
                                    @endif
                                    <div class="paginator">
                                        {{ $pending->fragment('pending')->links() }}
                                    </div>
                                </div>
                            </li>
                            <li id="answered-section">
                                <a href="#answered">
                                    <div class="tab-title">
                                        <span>
                                            Answered
                                            @if($answered->total() > 0)
                                                (<span class="numbers">{{ $answered->total() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($answered->total() > 0)
                                        <table class="table">
                                            @foreach($answered as $question)
                                                <tr class="{{ $question->answer->seen ? '' : 'bold' }}" >
                                                    <td class="text-left w180px noneon460" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                                                        @if(count($question->images) > 0)
                                                            @foreach($question->images as $image)
                                                                <img class="question-list" src="{{ url()->to('/').'/photo/50x30/'.$image->filename }}">
                                                            @endforeach
                                                        @else
                                                            <img class="question-list" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center w170px" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)).'...' }}</td>
                                                    <td class="w170px text-center"><a href="{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}" class="btn btn-sm show-answer-btn">Show answer</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No answered questions.</p>
                                    @endif
                                    <div class="paginator">
                                        {{ $answered->fragment('answered')->links() }}
                                    </div>
                                </div>
                            </li>
                            <li id="drafts-section">
                                <a href="#drafts">
                                    <div class="tab-title">
                                        <span>
                                            Drafts
                                            @if($drafts->total() > 0)
                                                (<span class="numbers">{{ $drafts->total() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($drafts->total() > 0)
                                        <table class="table">
                                            @foreach($drafts as $question)
                                                <tr>
                                                    <td class="text-left w180px noneon460" onclick="window.location='{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}';">
                                                        @if(count($question->images) > 0)
                                                            @foreach($question->images as $image)
                                                                <img class="question-list" src="{{ url()->to('/').'/photo/50x30/'.$image->filename }}">
                                                            @endforeach
                                                        @else
                                                            <img class="question-list" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center w170px" onclick="window.location='{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}';">{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td onclick="window.location='{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}';">{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)).'...' }}</td>
                                                    <td class="w205px text-center controls">
                                                        {!! Form::open([
                                                            'method' => 'POST',
                                                            'action' => ['UserController@deleteQuestion', $question->id],
                                                            'onclick'=> 'return confirm("Are you sure?")',
                                                            'class' => 'inline'
                                                            ]) !!}
                                                            <button type="submit" class="delete-draft-question">Delete</button>
                                                        {!! Form::close() !!}
                                                        <a href="{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}" class="btn btn-sm show-answer-btn mb-0px">Proceed</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No questions drafts.</p>
                                    @endif
                                    <div class="paginator">
                                        {{ $drafts->fragment('drafts')->links() }}
                                    </div>
                                </div>
                            </li>
                            <li id="rejected-section">
                                <a href="#rejected">
                                    <div class="tab-title">
                                        <span>
                                            Rejected
                                            @if($rejected->total() > 0)
                                                (<span class="numbers">{{ $rejected->total() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($rejected->total() > 0)
                                        <table class="table">
                                            @foreach($rejected as $question)
                                                <tr>
                                                    <td class="text-left w180px noneon460" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                                                        @if(count($question->images) > 0)
                                                            @foreach($question->images as $image)
                                                                <img class="question-list" src="{{ url()->to('/').'/photo/50x30/'.$image->filename }}">
                                                            @endforeach
                                                        @else
                                                            <img class="question-list" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center w170px" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ date('d M, Y H:i', strtotime($question->updated_at)) }}</td>
                                                    <td onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)).'...' }}</td>
                                                    <td class="w170px text-center"><a href="{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}" class="btn btn-sm show-answer-btn">Check reason</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>You have no rejected questions.</p>
                                    @endif
                                    <div class="paginator">
                                        {{ $rejected->fragment('pending')->links() }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
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