<ul class="accordion mb-0px">
    <li id="pending-section">
        <a href="#pending">
            <div class="title">
                <span>
                    Pending
                    @if(count($pending) > 0)
                        (<span class="numbers">{{ count($pending) }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
            @if(count($pending) > 0)

                @foreach($pending as $question)
                <div class="my-quest-line" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                    <div class="right no-float-630">
                        @if(count($question->images) > 0)
                            @foreach($question->images as $image)
                                <img class="right question-list no-float-630" src="{{ url()->to('/').'/photo-crop/50x50/'.$image->filename }}">
                            @endforeach
                        @else
                            <img class="right question-list no-float-630" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                        @endif
                    </div>
                    <div class="left">
                        <div>{{ date('d M, Y H:i', strtotime($question->updated_at)) }}</div>
                        <div>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 10)).'...' }}</div>
                    </div>

                    <div class="clearboth"></div>
                </div>
                @endforeach

            @else
                <p>No pending questions.</p>
            @endif
        </div>
    </li>
    <li id="answered-section">
        <a href="#answered">
            <div class="title">
                <span>
                    Answered
                    @if(count($answered) > 0)
                        (<span class="numbers">{{ count($answered) }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
            @if(count($answered) > 0)

                    @foreach($answered as $question)
                            <div class="my-quest-line" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                                <div class="right no-float-630">
                                    @if(count($question->images) > 0)
                                        @foreach($question->images as $image)
                                            <img class="right question-list no-float-630" src="{{ url()->to('/').'/photo-crop/50x50/'.$image->filename }}">
                                        @endforeach
                                    @else
                                        <img class="right question-list no-float-630" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                    @endif

                                </div>
                                <div class="left">
                                    <div>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</div>
                                    <div>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 10)).'...' }}</div>

                                </div>

                                <div class="clearboth"></div>
                                <div>
                                    <a href="{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}" class="show-answer">Show answer</a>
                                </div>
                            </div>
                        @endforeach

            @else
                <p>No answered questions.</p>
            @endif
        </div>
    </li>
    <li id="drafts-section">
        <a href="#drafts">
            <div class="title">
                <span>
                    Drafts
                    @if(count($drafts) > 0)
                        (<span class="numbers">{{ count($drafts) }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
            @if(count($drafts) > 0)

                        @foreach($drafts as $question)
                            <div class="my-quest-line">
                                <div class="right no-float-630" onclick="window.location='{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}';">
                                    @if(count($question->images) > 0)
                                        @foreach($question->images as $image)
                                            <img class="right question-list no-float-630" src="{{ url()->to('/').'/photo-crop/50x50/'.$image->filename }}">
                                        @endforeach
                                    @else
                                        <img class="right question-list no-float-630" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                    @endif

                                </div>
                                <div class="left" onclick="window.location='{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}';">
                                    <div>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</div>
                                    <div>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 10)).'...' }}</div>

                                </div>

                                <div class="clearboth"></div>
                                <div>
                                    {!! Form::open([
                                            'method' => 'POST',
                                            'action' => ['UserController@deleteQuestion', $question->id],
                                            'onclick'=> 'return confirm("Delete this draft?")',
                                            'class' => 'inline'
                                            ]) !!}
                                    <button type="submit" class="delete-draft-question">Delete</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endforeach
            @else
                <p>No questions drafts.</p>
            @endif
        </div>
    </li>
    <li id="rejected-section">
        <a href="#rejected">
            <div class="title">
                <span>
                    Rejected
                    @if(count($rejected) > 0)
                        (<span class="numbers">{{ count($rejected) }}</span>)
                    @endif
                </span>
            </div>
        </a>
        <div class="content">
            @if(count($rejected) > 0)
                        @foreach($rejected as $question)
                            <div class="my-quest-line" onclick="window.location='{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}';">
                                <div class="right no-float-630">
                                    @if(count($question->images) > 0)
                                        @foreach($question->images as $image)
                                            <img class="right question-list no-float-630" src="{{ url()->to('/').'/photo-crop/50x50/'.$image->filename }}">
                                        @endforeach
                                    @else
                                        <img class="right question-list no-float-630" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                    @endif

                                </div>
                                <div class="left">
                                    <div>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</div>
                                    <div>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 10)).'...' }}</div>

                                </div>

                                <div class="clearboth"></div>
                                <div>
                                    <a href="{{ action('FrontendController@viewAnswer', ['id' => $question->id]) }}" class="show-answer">Check reason</a>
                                </div>
                            </div>
                        @endforeach



            @else
                <p>You have no rejected questions.</p>
            @endif
        </div>
    </li>
</ul>