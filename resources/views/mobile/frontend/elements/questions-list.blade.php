<ul class="accordion mb-0px">
    <li id="pending-section">
        <a href="#pending">
            <div class="title">
                <span>
                    Pending
                    @if($pending->total() > 0)
                        (<span class="numbers">{{ $pending->total() }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
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
            <div class="title">
                <span>
                    Answered
                    @if($answered->total() > 0)
                        (<span class="numbers">{{ $answered->total() }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
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
            <div class="title">
                <span>
                    Drafts
                    @if($drafts->total() > 0)
                        (<span class="numbers">{{ $drafts->total() }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
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
                            <td class="w180px text-right controls">
                                {!! Form::open([
                                    'method' => 'POST',
                                    'action' => ['UserController@deleteQuestion', $question->id],
                                    'onclick'=> 'return confirm("Delete this draft?")',
                                    'class' => 'inline'
                                    ]) !!}
                                <button type="submit" class="delete-draft-question">
                                </button>
                                {!! Form::close() !!}
                                        <!--a href="{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}" class="btn btn-sm show-answer-btn mb-0px">Proceed</a-->
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
            <div class="title">
                <span>
                    Rejected
                    @if($rejected->total() > 0)
                        (<span class="numbers">{{ $rejected->total() }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
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