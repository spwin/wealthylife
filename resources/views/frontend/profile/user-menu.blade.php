<div class="col-md-3 user-menu">
    <div class="widget">
        <div class="user-photo">
            <div class="modal-container text-right">
                <a class="btn-modal" href="#">
                    <div class="image">
                        <img src="{{ $user->userData()->first()->image_id ?
                                                 url()->to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename
                                                 : url()->to('/').'/images/avatars/no_image.png' }}">
                    </div>
                </a>
                @include('frontend/elements/change-photo')
            </div>
        </div>
        <h6 class="title username">{{ $user->userData()->first()->first_name.' '.$user->userData()->first()->last_name }}</h6>
        <div class="user-email">{{ $user->email }}</div>
        <hr>
        <ul class="lead">
            <li {{ (Request::is('*profile') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@profile') }}"><i class="ti-arrow-right"></i> Profile</a></li>
            {{--<li {{ (Request::is('*profile/messages*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@messages') }}"><i class="ti-arrow-right"></i> Messages</a></li>--}}
            <li {{ (Request::is('*profile/questions*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@questions') }}"><i class="ti-arrow-right"></i> My questions</a></li>
            {{--<li {{ (Request::is('*profile/articles*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@articles') }}"><i class="ti-arrow-right"></i> My articles</a></li>--}}
            {{--<li {{ (Request::is('*profile/vouchers*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@vouchers') }}"><i class="ti-arrow-right"></i> Gift vouchers</a></li>--}}
            <li {{ (Request::is('*profile/credits*') ? 'class=um-active' : '') }}><a href="{{ action('FrontendController@credits') }}"><i class="ti-arrow-right"></i> Buy credits</a></li>
        </ul>
    </div>
    <div class="widget">
        <h6 class="title">Profile info</h6>
        <hr>
        <ul>
            <li class="title balance">Balance: £{{ $user->points }}</li>
            <li>Member since: {{ date('d M, Y', strtotime($user->created_at)) }}</li>
            <li>Questions asked: {{ $user->questions() ? $user->questions()->where('status', '>' , 0)->count() : 0 }}</li>
            {{--<li>Comments left: {{ $user->questions() ? $user->questions()->count() : 0 }}</li>
            <li>Articles written: {{ $user->questions() ? $user->questions()->count() : 0 }}</li>--}}
        </ul>
    </div>
</div>