<footer class="footer-2 bg-dark pt59 pt-xs-40">
    <div class="container">
        <div class="row mb13 mb-xs-24">
            <div class="col-md-3 col-sm-4">
                <a class="mb24" href="{{ url()->to('/') }}">
                    <img alt="logo" class="image-xs footer-logo-left" src="{{ url()->to('/') }}/images/LOGO-header.svg">
                </a>
                <div class="follow-us mt48">
                    <p>Follow us on:</p>
                    <a href="#"><div class="social-icon face"></div></a>
                    <a href="#"><div class="social-icon gplus"></div></a>
                    <a href="#"><div class="social-icon twit"></div></a>
                    <a href="#"><div class="social-icon inst"></div></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 ml14proc mt2">
                <ul>
                    <li><a href="{{ action('FrontendController@index') }}"><h5 class="uppercase mb5 fade-on-hover">Home</h5></a></li>
                    <li><a href="{{ action('FrontendController@about') }}"><h5 class="uppercase mb5 fade-on-hover">About</h5></a></li>
                    <li><a href="{{ action('FrontendController@team') }}"><h5 class="uppercase mb5 fade-on-hover">The Team</h5></a></li>
                    <li><a href="{{ action('FrontendController@contacts') }}"><h5 class="uppercase mb5 fade-on-hover">Contacts</h5></a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-4 mt2">
                <ul>
                    <li><a href="{{ action('FrontendController@summary') }}"><h5 class="uppercase mb5 fade-on-hover">Profile</h5></a></li>
                    <li><a href="{{ action('FrontendController@privacy') }}"><h5 class="uppercase mb5 fade-on-hover">Privacy policy</h5></a></li>
                    <li><a href="{{ action('FrontendController@terms') }}"><h5 class="uppercase mb5 fade-on-hover">Terms and conditions</h5></a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-4">

            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <span class="sub">© Copyright {{ date('Y', time()) }}, <span class="company-color">Pixsens LTD</span></span>
            </div>
            <!--div class="col-sm-6 text-right">
                <ul class="list-inline social-list">
                    {{--<li>
                        <a href="#">
                            <i class="ti-twitter-alt"></i>
                        </a>
                    </li>--}}
                    <li>
                        <a href="#">
                            <i class="ti-facebook"></i>
                        </a>
                    </li>
                    {{--<li>
                        <a href="#">
                            <i class="ti-instagram"></i>
                        </a>
                    </li>--}}
                </ul>
            </div-->
        </div>
    </div>
    <div class="footer-logo"></div>
</footer>