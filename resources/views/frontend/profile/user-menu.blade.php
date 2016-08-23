<div class="col-md-3 user-menu">
    <div class="widget">
        <div class="user-photo">
            <div class="modal-container text-right">
                <a class="btn-modal" href="#">
                    <div class="image">
                        <img src="{{ $user->userData->image_id ?
                                                 url()->to('/').$user->userData->image->path.$user->userData->image->filename
                                                 : url()->to('/').'/images/avatars/no_image.png' }}">
                    </div>
                </a>
                @include('frontend/elements/change-photo')
            </div>
        </div>
        <h6 class="title username">{{ $user->userData->first_name.' '.$user->userData->last_name }}</h6>
        <div class="user-email">{{ $user->email }}</div>
        <hr>
        <ul class="lead">
            <li {{ (Request::is('*profile') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@profile') }}"><i class="ti-arrow-right"></i> Profile</a></li>
            <li {{ (Request::is('*profile/notifications*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@notifications') }}"><i class="ti-arrow-right"></i> Notifications{{ ($count = $user->notifications()->where(['seen' => 0])->count()) > 0 ? ' ('.$count.')' : '' }}</a></li>
            <li {{ (Request::is('*profile/questions*') ? 'class=um-active' : '') }}>
                @if(($count = ($user->questions ? $user->questions()->join('answers', 'answers.question_id', '=', 'questions.id')->where(['questions.status' => 2, 'answers.seen' => 0])->count() : 0)) > 0)
                    <a href="{{ action('FrontendController@questions', '#answered') }}"><i class="ti-arrow-right"></i> My questions ({{ $count }})</a>
                @else
                    <a href="{{ action('FrontendController@questions') }}"><i class="ti-arrow-right"></i> My questions</a>
                @endif
            </li>
            <li {{ (Request::is('*profile/articles*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@articles') }}"><i class="ti-arrow-right"></i> Blog entries</a></li>
            <li {{ (Request::is('*profile/credits*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@credits') }}"><i class="ti-arrow-right"></i> Buy credits</a></li>
            <li {{ (Request::is('*profile/vouchers*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@vouchers') }}"><i class="ti-arrow-right"></i> Gift vouchers</a></li>
        </ul>
    </div>
    <div class="widget">
        <h6 class="title">Profile info</h6>
        <hr>
        <ul>
            <li class="title balance">Balance: £{{ $user->points }}</li>
            <li>Member since: {{ date('d M, Y', strtotime($user->created_at)) }}</li>
            <li>Questions asked: @if($questionsCount = $user->questions()->where('status', '>' , 0)->count()) {{ $questionsCount }} @else {{ '0' }} @endif</li>
            <li>Articles published: @if($articlesCount = $user->articles()->where('status', '=', 3)->whereNotNull('published_at')->count()) {{ $articlesCount }} @else {{ '0' }} @endif</li>
            {{--<li>Comments left: {{ $user->questions() ? $user->questions()->count() : 0 }}</li>--}}
        </ul>
    </div>
</div>