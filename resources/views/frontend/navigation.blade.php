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
                            <a href="#">Pricing</a>
                        </li>
                        <li {{ (Request::is('*blog*') ? 'class=current' : '') }}>
                            <a href="{{ action('FrontendController@blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Contacts</a>
                        </li>
                    </ul>
                </div>

                <div class="module widget-handle language left">
                    <ul class="menu">
                        <li class="profile-dropdown">
                            <a href="#">Profile</a>
                            <ul>
                                <li>
                                    <div class="modal-container">
                                        <a class="btn-modal" href="#">Log in</a>
                                        <div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'login' && count($errors->login) > 0 ? 'data-time-delay=10' : '' }}>
                                            <h3 class="uppercase">Log in</h3>
                                            <p class="lead mb48">
                                                Please fill all the fields.
                                            </p>
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
                                            {!! Form::input('password', 'password', '', ['class' => $errors->login->first('password', 'field-error '), 'placeholder' => 'Password']) !!}
                                            <input type="submit" value="Log in">
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="modal-container">
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
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</div>