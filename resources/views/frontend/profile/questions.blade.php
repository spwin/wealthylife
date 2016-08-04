@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load questions-container">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            @include('frontend/elements/question')
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
                                            @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                                (<span class="numbers">{{ $user->questions()->where(['status' => 1])->count() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 1])->orderBy('created_at', 'DESC')->get() as $question)
                                                <tr>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->updated_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No pending questions.</p>
                                    @endif
                                </div>
                            </li>
                            <li id="answered-section">
                                <a href="#answered">
                                    <div class="tab-title">
                                        <span>
                                            Answered
                                            @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                                (<span class="numbers">{{ $user->questions()->where(['status' => 2])->count() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 2])->orderBy('answered_at', 'DESC')->get() as $question)
                                                <tr {{ $question->answer()->first()->seen ? '' : 'class=bold' }}>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)) }}</td>
                                                    <td class="w170px"><a href="{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}" class="btn btn-sm show-answer-btn">Show answer</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No answered questions.</p>
                                    @endif
                                </div>
                            </li>
                            <li id="drafts-section">
                                <a href="#drafts">
                                    <div class="tab-title">
                                        <span>
                                            Drafts
                                            @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                                (<span class="numbers">{{ $user->questions()->where(['status' => 0])->count() }}</span>)
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 0])->orderBy('created_at', 'DESC')->get() as $question)
                                                <tr>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)).'...' }}</td>
                                                    <td class="w170px">
                                                        {!! Form::open([
                                                            'method' => 'POST',
                                                            'action' => ['UserController@deleteQuestion', $question->id],
                                                            'onclick'=> 'return confirm("Are you sure?")',
                                                            'class' => 'inline'
                                                            ]) !!}
                                                            <button type="submit" class="delete-draft-question">Delete</button>
                                                        {!! Form::close() !!}
                                                        <a href="{{ action('FrontendController@paymentQuestion', ['id' => $question->id]) }}" class="btn btn-sm hovered mb-0px">Send</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No questions drafts.</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop