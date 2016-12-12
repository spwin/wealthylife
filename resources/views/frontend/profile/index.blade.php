@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    @include('frontend/profile/header')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Profile</h1>
                    <h2 class="lead mb0 below">Let the <span class="color-red">style</span> begin</h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">PROFILE MENU</span>
            </div>
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


        <div class="container about-block profile-index">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right mobile-none ask-position-mob right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask consultant</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16">Edit profile</h4>
                        {{--<p class="lead mb64">
                            Some info about profile edit
                        </p>--}}
                        <ul class="tabs">
                            <li id="general-section">
                                <a href="#general">
                                    <div class="tab-title">
                                        <span>General info</span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    <div class="col-sm-12 no-padding">
                                        @if (Session::has('flash_notification.general.message'))
                                            <div class="alert alert-{{ Session::get('flash_notification.general.level') }} alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                {{ Session::get('flash_notification.general.message') }}
                                            </div>
                                        @endif
                                        @if (count($errors->general) > 0)
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->general->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        {!! Form::model($user_data, [
                                            'role' => 'form',
                                            'url' => action('UserController@updateProfileGeneral', ['id' => $user->id]),
                                            'method' => 'POST',
                                            'class' => 'general-profile'
                                        ]) !!}
                                            <div class="input-with-label text-left">
                                                <h5 class="uppercase">Your Name</h5>
                                                <div class="name-surname">
                                                    {!! Form::text('first_name', null, ['class' => $errors->general->first('first_name', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'Name']) !!}
                                                    {!! Form::text('last_name', null, ['class' => $errors->general->first('last_name', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'Surname']) !!}
                                                </div>
                                            </div>
                                            <div class="input-with-label text-left">
                                                <h5 class="uppercase">Gender</h5>
                                                <div class="gender-profile {{ $errors->general->first('gender', 'radio-error ') }}">
                                                    <div>
                                                        <div class="radio-option {{ $user_data->gender == 'male' ? 'checked' : '' }}">
                                                            <div class="inner"></div>
                                                            {!! Form::radio('gender', 'male', null) !!}
                                                        </div>
                                                        <span>Male</span>
                                                        <div class="radio-option {{ $user_data->gender == 'female' ? 'checked' : '' }}">
                                                            <div class="inner"></div>
                                                            {!! Form::radio('gender', 'female', null) !!}
                                                        </div>
                                                        <span>Female</span>
                                                        <div class="clearboth"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="double-column">
                                                <div class="input-with-label text-left">
                                                    <h5 class="weight uppercase"><span class="uppercase">HEIGHT</span> (cm)</h5>
                                                    {!! Form::text('height', null, ['class' => $errors->general->first('height', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'height']) !!}
                                                </div>
                                                <div class="input-with-label text-left">
                                                    <h5 class="weight uppercase"><span class="uppercase">WEIGHT</span> (kg)</h5>
                                                    {!! Form::text('weight', null, ['class' => $errors->general->first('weight', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'weight']) !!}
                                                </div>
                                            </div>
                                            <div class="input-with-label text-left">
                                                <h5 class="uppercase">Date of birth</h5>
                                                <div class="col-sm-3 no-padding-left">
                                                    <div class="select-option">
                                                        <i class="ti-angle-down"></i>
                                                        <select name="bd-day" class="{{ $errors->general->first('birth_date', 'field-error ') }}" id="day">
                                                            <option value="00">Day</option>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="select-option">
                                                        <i class="ti-angle-down"></i>
                                                        <select name="bd-month" class="{{ $errors->general->first('birth_date', 'field-error ') }}" id="month">
                                                            <option value="00">Month</option>
                                                            <option value="01">January</option>
                                                            <option value="02">February</option>
                                                            <option value="03">March</option>
                                                            <option value="04">April</option>
                                                            <option value="05">May</option>
                                                            <option value="06">June</option>
                                                            <option value="07">July</option>
                                                            <option value="08">August</option>
                                                            <option value="09">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 no-padding-right">
                                                    <div class="select-option">
                                                        <i class="ti-angle-down"></i>
                                                        <select name="bd-year" class="{{ $errors->general->first('birth_date', 'field-error ') }}" id="year">
                                                            <option value="0">Year</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008">2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="2006">2006</option>
                                                            <option value="2005">2005</option>
                                                            <option value="2004">2004</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                            <option value="1989">1989</option>
                                                            <option value="1988">1988</option>
                                                            <option value="1987">1987</option>
                                                            <option value="1986">1986</option>
                                                            <option value="1985">1985</option>
                                                            <option value="1984">1984</option>
                                                            <option value="1983">1983</option>
                                                            <option value="1982">1982</option>
                                                            <option value="1981">1981</option>
                                                            <option value="1980">1980</option>
                                                            <option value="1979">1979</option>
                                                            <option value="1978">1978</option>
                                                            <option value="1977">1977</option>
                                                            <option value="1976">1976</option>
                                                            <option value="1975">1975</option>
                                                            <option value="1974">1974</option>
                                                            <option value="1973">1973</option>
                                                            <option value="1972">1972</option>
                                                            <option value="1971">1971</option>
                                                            <option value="1970">1970</option>
                                                            <option value="1969">1969</option>
                                                            <option value="1968">1968</option>
                                                            <option value="1967">1967</option>
                                                            <option value="1966">1966</option>
                                                            <option value="1965">1965</option>
                                                            <option value="1964">1964</option>
                                                            <option value="1963">1963</option>
                                                            <option value="1962">1962</option>
                                                            <option value="1961">1961</option>
                                                            <option value="1960">1960</option>
                                                            <option value="1959">1959</option>
                                                            <option value="1958">1958</option>
                                                            <option value="1957">1957</option>
                                                            <option value="1956">1956</option>
                                                            <option value="1955">1955</option>
                                                            <option value="1954">1954</option>
                                                            <option value="1953">1953</option>
                                                            <option value="1952">1952</option>
                                                            <option value="1951">1951</option>
                                                            <option value="1950">1950</option>
                                                            <option value="1949">1949</option>
                                                            <option value="1948">1948</option>
                                                            <option value="1947">1947</option>
                                                            <option value="1946">1946</option>
                                                            <option value="1945">1945</option>
                                                            <option value="1944">1944</option>
                                                            <option value="1943">1943</option>
                                                            <option value="1942">1942</option>
                                                            <option value="1941">1941</option>
                                                            <option value="1940">1940</option>
                                                            <option value="1939">1939</option>
                                                            <option value="1938">1938</option>
                                                            <option value="1937">1937</option>
                                                            <option value="1936">1936</option>
                                                            <option value="1935">1935</option>
                                                            <option value="1934">1934</option>
                                                            <option value="1933">1933</option>
                                                            <option value="1932">1932</option>
                                                            <option value="1931">1931</option>
                                                            <option value="1930">1930</option>
                                                            <option value="1929">1929</option>
                                                            <option value="1928">1928</option>
                                                            <option value="1927">1927</option>
                                                            <option value="1926">1926</option>
                                                            <option value="1925">1925</option>
                                                            <option value="1924">1924</option>
                                                            <option value="1923">1923</option>
                                                            <option value="1922">1922</option>
                                                            <option value="1921">1921</option>
                                                            <option value="1920">1920</option>
                                                            <option value="1919">1919</option>
                                                            <option value="1918">1918</option>
                                                            <option value="1917">1917</option>
                                                            <option value="1916">1916</option>
                                                            <option value="1915">1915</option>
                                                            <option value="1914">1914</option>
                                                            <option value="1913">1913</option>
                                                            <option value="1912">1912</option>
                                                            <option value="1911">1911</option>
                                                            <option value="1910">1910</option>
                                                            <option value="1909">1909</option>
                                                            <option value="1908">1908</option>
                                                            <option value="1907">1907</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearboth"></div>
                                            <div class="input-with-label text-left">
                                                <h5 class="weight uppercase"><span class="uppercase">About me</span> (max 500 symbols)</h5>
                                                {!! Form::textarea('about', null, ['size' => '30x5']) !!}
                                            </div>
                                            <input type="submit" class="btn profile-button" value="Save changes">
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </li>
                            <li id="login-section">
                                <a href="#login">
                                    <div class="tab-title">
                                        <span>Login data</span>
                                    </div>
                                </a>
                                <div class="tab-content">
                                    <div class="col-sm-7">
                                        @if (Session::has('flash_notification.login.message'))
                                            <div class="alert alert-{{ Session::get('flash_notification.login.level') }} alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                {{ Session::get('flash_notification.login.message') }}
                                            </div>
                                        @endif
                                        @if (count($errors->email) > 0)
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->email->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        {!! Form::model($user, [
                                            'role' => 'form',
                                            'url' => action('UserController@updateProfileLogin', ['id' => $user->id, 'type' => 'email']),
                                            'method' => 'POST',
                                            'class' => 'login-profile'
                                        ]) !!}
                                        <div class="input-with-label text-left">
                                            <h5 class="uppercase">Email:</h5>
                                            {!! Form::email('email', null, ['class' => $errors->email->first('email', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Email address']) !!}
                                        </div>
                                        <input type="submit" class="btn profile-button" value="Save email">
                                        {!! Form::close() !!}

                                        @if (count($errors->password) > 0)
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->password->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        {!! Form::model($user, [
                                            'role' => 'form',
                                            'url' => action('UserController@updateProfileLogin', ['id' => $user->id, 'type' => 'pass']),
                                            'method' => 'POST'
                                        ]) !!}
                                        @if($user->local)
                                            <div class="input-with-label text-left">
                                                <h5 class="uppercase">Password change:</h5>
                                                {!! Form::input('password', 'password', '', ['class' => $errors->email->first('password', 'field-error ').'less-profile-input-margin', 'placeholder' => 'New Password']) !!}
                                                {!! Form::input('password', 'password_confirmation', '', ['class' => $errors->email->first('password_confirmation', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Repeat Password']) !!}
                                            </div>
                                            <input type="submit" class="btn profile-button" value="Change password">
                                        @else
                                            <div class="input-with-label text-left">
                                                <h5 class="uppercase">Create login password:</h5>
                                                {!! Form::input('password', 'password', '', ['class' => $errors->email->first('password', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Password']) !!}
                                                {!! Form::input('password', 'password_confirmation', '', ['class' => $errors->email->first('password_confirmation', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Repeat Password']) !!}
                                            </div>
                                            <input type="submit" class="btn profile-button" value="Set password">
                                        @endif
                                        {!! Form::close() !!}
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
@push('scripts')
    <script type="text/javascript">
        $(function(){
            birthDate.init('{{ old('bd-day') ? old('bd-day') : $bd['day'] }}', '{{ old('bd-month') ? old('bd-month') : $bd['month'] }}', '{{ old('bd-year') ? old('bd-year') : $bd['year'] }}');
        });
    </script>
@endpush