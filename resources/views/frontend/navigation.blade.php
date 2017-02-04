<div class="nav-container">
    <a id="top"></a>
    <nav class="absolute transparent">
        <div class="nav-bar @yield('nav-style', 'nav-home')">
            <div class="module left">
                <a href="{{ URL::to('/') }}">
                    <img class="logo logo-light" alt="{{ env('APP_NAME') }}" src="{{ URL::to('/') }}/images/LOGO-header.svg">
                </a>
            </div>
            <div class="mob-menu-logo">
                <a href="{{ URL::to('/') }}">
                    <img alt="{{ env('APP_NAME') }}" src="{{ URL::to('/') }}/images/LOGO-header.svg">
                </a>
            </div>

            @if($user = Auth::guard('user')->user())
                @php($notifications = $user->notifications()->where(['seen' => 0])->orderBy('created_at', 'DESC')->get())
                <div class="module widget-handle cart-widget-handle notifications-mob visible990">
                    <div class="cart">
                        <i class="ti-bell"></i>
                        @if(count($notifications) > 0)
                            <span class="label number mobile-none">{{ count($notifications) }}</span>
                            <span class="title"><span class="label number visible990 mob-label">{{ count($notifications) }}</span></span>
                        @endif
                    </div>
                    <div class="function">
                        <div class="widget">
                            <h6 class="title">Notifications</h6>
                            <hr>
                            <ul class="cart-overview">
                                @if(count($notifications) > 0)
                                    @foreach($notifications as $notification)
                                        <li>
                                            <a href="{{ action('FrontendController@showNotification', ['id' => $notification->id]) }}">
                                                <div class="description">
                                                        <span class="product-title">
                                                            @if($notification->type == 'admin')
                                                                <i class="ti-crown"></i>
                                                            @else
                                                                <i class="ti-flag-alt"></i>
                                                            @endif
                                                            {{ $notification->subject }}</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <div class="description">
                                            <span class="product-title">No new notifications</span>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                            <hr>
                            <div class="cart-controls notif">
                                <a class="btn btn-sm btn-filled full" href="{{ action('FrontendController@notifications') }}">See all</a>
                            </div>
                        </div>
                        <!--end of widget-->
                    </div>
                </div>
            @endif


            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group right">
                <div class="module left">
                    <ul class="menu" id="underline-hover">
                        <li {{ (Request::is('/') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@index') }}">Home</a>
                        </li>
                        <li {{ (Request::is('*blog*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@blog') }}">Blog</a>
                        </li>
                        <li {{ (Request::is('*examples*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@examples') }}">Examples</a>
                        </li>
                        <li {{ (Request::is('*about*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@about') }}">About</a>
                        </li>
                        <li {{ (Request::is('*the-team*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@team') }}">The Team</a>
                        </li>
                        <li {{ (Request::is('*contact-us*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@contacts') }}">Contacts</a>
                        </li>
                    </ul>
                </div>
                @if($user = Auth::guard('user')->user())
                    @php($notifications = $user->notifications()->where(['seen' => 0])->orderBy('created_at', 'DESC')->get())
                    <div class="module widget-handle cart-widget-handle left mobile-none">
                        <div class="cart">
                            <i class="ti-bell"></i>
                            @if(count($notifications) > 0)
                                <span class="label number mobile-none">{{ count($notifications) }}</span>
                                <span class="title">Notifications<span class="label number visible990 mob-label">{{ count($notifications) }}</span></span>
                            @endif
                        </div>
                        <div class="function">
                            <div class="widget">
                                <h6 class="title">Notifications</h6>
                                <hr>
                                <ul class="cart-overview">
                                    @if(count($notifications) > 0)
                                        @foreach($notifications as $notification)
                                            <li>
                                                <a href="{{ action('FrontendController@showNotification', ['id' => $notification->id]) }}">
                                                    <div class="description">
                                                        <span class="product-title">
                                                            @if($notification->type == 'admin')
                                                                <i class="ti-crown"></i>
                                                            @else
                                                                <i class="ti-flag-alt"></i>
                                                            @endif
                                                            {{ $notification->subject }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="description">
                                                <span class="product-title">No new notifications</span>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                <hr>
                                <div class="cart-controls notif">
                                    <a class="btn btn-sm btn-filled full" href="{{ action('FrontendController@notifications') }}">See all</a>
                                </div>
                            </div>
                            <!--end of widget-->
                        </div>
                    </div>
                @endif
                @if(App\Helpers\Helpers::checkAccess())
                <div class="module widget-handle language left">
                    <ul class="menu">
                        <li class="profile-dropdown {{ Auth::guard('user')->user() ? 'logged' : '' }}">
                            @if(Auth::guard('user')->user())
                                <a class="lh53" href="{{ action('FrontendController@summary') }}">{{ Auth::guard('user')->user()->userData->first_name ? Auth::guard('user')->user()->userData->first_name : 'profile' }} (£ {{ Auth::guard('user')->user()->points }})</a>
                                <a class="lh53 visible990" href="{{ action('Auth\AuthController@getUserLogout') }}">Log out</a>
                                <ul class="prof-drop">
                                    <li>
                                        <a href="{{ action('FrontendController@summary') }}">Summary</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@profile') }}">My profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@questions') }}">My questions</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@articles') }}">Blog entries</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@credits') }}">Buy credits</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@vouchers') }}">Vouchers</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@referral') }}">Referrals</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('Auth\AuthController@getUserLogout') }}">Log out</a>
                                    </li>
                                </ul>
                            @else
                                <a href="#" class="mobile-none">Profile</a>
                                <ul class="before-login-mobmenu">
                                    <li>
                                        <div class="modal-container login-modal">
                                            <a class="btn-modal" href="#">Log in</a>
                                            <div class="foundry_modal text-center" {{ (Session::has('modal') && (Session::get('modal') == 'login' && count($errors->login) || Session::get('modal') == 'need-login')) > 0 ? 'data-time-delay=10' : '' }}>
                                                <div class="login-header-back">
                                                    <div class="login-header">
                                                        <img src="{{ URL::to('/') }}/images/log-in-symbol.svg" alt="small logo">
                                                        <h5 class="uppercase"><span class="ftw600">Log</span>in</h5>
                                                        <p>Choose Your way to log in</p>
                                                    </div>
                                                </div>
                                                @if (Session::has('flash_notification.login.message'))
                                                    <div class="alert alert-{{ Session::get('flash_notification.login.level') }} alert-dismissible" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        {{ Session::get('flash_notification.login.message') }}
                                                    </div>
                                                @endif
                                                @if (count($errors->login) > 0)
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->login->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                {!! Form::open([
                                                    'role' => 'form',
                                                    'url' => action('UserController@loginUser', ['modal' => 'login', 'url' => Route::currentRouteAction() ]),
                                                    'files' => true,
                                                    'class' => '',
                                                    'method' => 'POST'
                                                ]) !!}
                                                {!! Form::email('email', null, ['class' => $errors->login->first('email', 'field-error '), 'placeholder' => 'Email address']) !!}
                                                {!! Form::input('password', 'password', '', ['class' => $errors->login->first('password', 'field-error ').'mb-5px', 'placeholder' => 'Password']) !!}
                                                <div class="password-reset-link">
                                                    Forgot your password? <a href="{{ action('FrontendController@passwordReset') }}">Click Here To Reset</a>
                                                </div>
                                                <input type="submit" value="Log in">
                                                {!! Form::close() !!}
                                                <a class="btn btn-lg social-login google" href="{{ action('UserController@socialLogin', ['provider' => 'google']) }}">Log in with Google</a>
                                                <a class="btn btn-lg social-login facebook" href="{{ action('UserController@socialLogin', ['provider' => 'facebook']) }}">Log in with Facebook</a>
                                                <a class="btn btn-lg social-login twitter" href="{{ action('UserController@socialLogin', ['provider' => 'twitter']) }}">Log in with Twitter</a>
                                                <a href="#" onclick="openModal('signup')">Create account</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="modal-container signup-modal">
                                            <a class="btn-modal" href="#">Sign up</a>
                                            <div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'signup' && count($errors->signup) > 0 ? 'data-time-delay=10' : '' }}>
                                                <div class="login-header-back">
                                                    <div class="login-header">
                                                        <img src="{{ URL::to('/') }}/images/log-in-symbol.svg" alt="small logo">
                                                        <h5 class="uppercase"><span class="ftw600">Sign</span> up</h5>
                                                        <p>Please fill all the fields</p>
                                                    </div>
                                                </div>
                                                <!--h3 class="uppercase">Sign Up</h3>
                                                <p class="lead mb48">
                                                    Please fill all the fields.
                                                </p-->
                                                @if (count($errors->signup) > 0)
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->signup->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                {!! Form::open([
                                                    'role' => 'form',
                                                    'url' => action('UserController@createUser', ['modal' => 'signup', 'url' => Route::currentRouteAction() ]),
                                                    'files' => true,
                                                    'class' => '',
                                                    'method' => 'POST'
                                                ]) !!}
                                                    <div class="hidden">
                                                        {!! Form::text('birthday', null) !!}
                                                        {!! Form::text('city', 'London') !!}
                                                    </div>
                                                    <div class="double-column">
                                                        {!! Form::text('first_name', null, ['class' => $errors->signup->first('first_name', 'field-error ').'mt-1px', 'placeholder' => 'First name']) !!}
                                                        {!! Form::text('last_name', null, ['class' => $errors->signup->first('last_name', 'field-error ').'mt-1px', 'placeholder' => 'Last name']) !!}
                                                    </div>
                                                    {!! Form::email('email', null, ['class' => $errors->signup->first('email', 'field-error '), 'placeholder' => 'Email address']) !!}
                                                    {!! Form::input('password', 'password', '', ['class' => $errors->signup->first('password', 'field-error '), 'placeholder' => 'Password']) !!}
                                                    {!! Form::input('password', 'password_confirmation', '', ['class' => $errors->signup->first('password_confirmation', 'field-error '), 'placeholder' => 'Repeat password']) !!}
                                                    <div class="gender-signup {{ $errors->signup->first('gender', 'radio-error ') }}">
                                                        <div class="display-inlineblock">
                                                            <div class="left radio-option {{ old('gender') == 'male' ? 'checked' : '' }}">
                                                                <div class="inner"></div>
                                                                {!! Form::radio('gender', 'male', null) !!}
                                                            </div>
                                                            <span class="left">Male</span>
                                                            <div class="left radio-option {{ old('gender') == 'female' ? 'checked' : '' }}">
                                                                <div class="inner"></div>
                                                                {!! Form::radio('gender', 'female', null) !!}
                                                            </div>
                                                            <span class="left">Female</span>
                                                            <div class="clearboth"></div>
                                                        </div>
                                                    </div>

                                                    <input type="submit" value="Sign up">
                                                    <a href="#" onclick="openModal('login')">Log in</a>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="nav-menu-logo"></div>
        </div>
    </nav>
</div>
@push('scripts')
<script>
    $('.notifications-mob').on('click', function() {
        $('.nav-bar').removeClass('nav-open');
        $('nav.absolute.transparent').removeClass('menu-bott');
        $('.widget-handle.mobile-toggle').removeClass('active').removeClass('toggle-widget-handle');
        $('.widget-handle.mobile-toggle i').removeClass('ti-close').addClass('ti-menu');
    });
    $('.widget-handle.mobile-toggle').on('click', function() {
        $('.notifications-mob').removeClass('toggle-widget-handle');
    });

</script>
@endpush
