<div class="nav-container">
    <a id="top"></a>
    <nav class="absolute transparent">
        <div class="nav-bar @yield('nav-style', 'nav-home')">
            <div class="module left">
                <a href="{{ URL::to('/') }}">
                    <img class="logo logo-light" alt="Foundry" src="{{ URL::to('/') }}/images/logo-light.png">
                    <img class="logo logo-dark" alt="Foundry" src="{{ URL::to('/') }}/images/logo-dark.png">
                </a>
            </div>
            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group right">
                <div class="module left">
                    <ul class="menu" id="underline-hover">
                        <li {{ (Request::is('/') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@index') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Features</a>
                        </li>
                        {{--<li {{ (Request::is('*blog*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>--}}
                        <li>
                            <a href="#">Contacts</a>
                        </li>
                    </ul>
                </div>
                @if(Auth::guard('user')->user())
                    <div class="module widget-handle cart-widget-handle left">
                        <div class="cart">
                            <i class="ti-bell"></i>
                            <span class="label number">2</span>
                            <span class="title">Notifications</span>
                        </div>
                        <div class="function">
                            <div class="widget">
                                <h6 class="title">Notifications</h6>
                                <hr>
                                <ul class="cart-overview">
                                    <li>
                                        <a href="#">
                                            <div class="description">
                                                <span class="product-title">No new notifications</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <hr>
                                <div class="cart-controls">
                                    <a class="btn btn-sm btn-filled" href="#">See all</a>
                                </div>
                            </div>
                            <!--end of widget-->
                        </div>
                    </div>
                @endif
                <div class="module widget-handle language left">
                    <ul class="menu">
                        <li class="profile-dropdown {{ Auth::guard('user')->user() ? 'logged' : '' }}">
                            @if(Auth::guard('user')->user())
                                <a href="#">{{ Auth::guard('user')->user()->userData()->first()->first_name ? Auth::guard('user')->user()->userData()->first()->first_name : 'profile' }} (£ {{ Auth::guard('user')->user()->points }})</a>
                                <ul>
                                    <li>
                                        <a href="{{ action('FrontendController@profile') }}">My profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@questions') }}">My questions</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('FrontendController@credits') }}">Buy credits</a>
                                    </li>
                                    <li>
                                        <a href="{{ action('Auth\AuthController@getUserLogout') }}">Log out</a>
                                    </li>
                                </ul>
                            @else
                                <a href="#">Profile</a>
                                <ul>
                                    <li>
                                        <div class="modal-container login-modal">
                                            <a class="btn-modal" href="#">Log in</a>
                                            <div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'login' && count($errors->login) > 0 ? 'data-time-delay=10' : '' }}>
                                                <h3 class="uppercase">Log in</h3>
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
                                                    Forgot your password? <a href="#">Click Here To Reset</a>
                                                </div>
                                                <input type="submit" value="Log in">
                                                {!! Form::close() !!}
                                                <a class="btn btn-lg social-login google" href="{{ action('UserController@socialLogin', ['provider' => 'google']) }}"><i class="ti-google"></i> Log in with Google</a>
                                                <a class="btn btn-lg social-login facebook" href="{{ action('UserController@socialLogin', ['provider' => 'facebook']) }}"><i class="ti-facebook"></i> Log in with Facebook</a>
                                                <a class="btn btn-lg social-login twitter" href="{{ action('UserController@socialLogin', ['provider' => 'twitter']) }}"><i class="ti-twitter"></i> Log in with Twitter</a>
                                                <a href="#" onclick="openModal('signup')">Create account</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="modal-container signup-modal">
                                            <a class="btn-modal" href="#">Sign up</a>
                                            <div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'signup' && count($errors->signup) > 0 ? 'data-time-delay=10' : '' }}>
                                                <h3 class="uppercase">Sign Up</h3>
                                                <p class="lead mb48">
                                                    Please fill all the fields.
                                                </p>
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
                                                    <div class="double-column">
                                                        {!! Form::text('first_name', null, ['class' => $errors->signup->first('first_name', 'field-error ').'mt-1px', 'placeholder' => 'First name']) !!}
                                                        {!! Form::text('last_name', null, ['class' => $errors->signup->first('last_name', 'field-error ').'mt-1px', 'placeholder' => 'Last name']) !!}
                                                    </div>
                                                    {!! Form::email('email', null, ['class' => $errors->signup->first('email', 'field-error '), 'placeholder' => 'Email address']) !!}
                                                    {!! Form::input('password', 'password', '', ['class' => $errors->signup->first('password', 'field-error '), 'placeholder' => 'Password']) !!}
                                                    {!! Form::input('password', 'password_confirmation', '', ['class' => $errors->signup->first('password_confirmation', 'field-error '), 'placeholder' => 'Repeat password']) !!}
                                                    <div class="gender-signup {{ $errors->signup->first('gender', 'radio-error ') }}">
                                                        <div>
                                                            <div class="radio-option {{ old('gender') == 'male' ? 'checked' : '' }}">
                                                                <div class="inner"></div>
                                                                {!! Form::radio('gender', 'male', null) !!}
                                                            </div>
                                                            <span>Male</span>
                                                            <div class="radio-option {{ old('gender') == 'female' ? 'checked' : '' }}">
                                                                <div class="inner"></div>
                                                                {!! Form::radio('gender', 'female', null) !!}
                                                            </div>
                                                            <span>Female</span>
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
            </div>

        </div>
    </nav>
</div>