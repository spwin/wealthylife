<footer class="footer-2 bg-dark pt96 pt-xs-40">
    <div class="container">
        <div class="row mb64 mb-xs-24">
            <div class="col-md-3 col-sm-4">
                <a href="#">
                    <img alt="logo" class="image-xs" src="{{ url()->to('/') }}/images/logo-light.svg">
                </a>
            </div>
            <div class="col-md-3 col-sm-4">
                <ul>
                    <li><a href="{{ action('FrontendController@index') }}"><h5 class="uppercase mb16 fade-on-hover">Home</h5></a></li>
                    <li><a href="{{ action('FrontendController@services') }}"><h5 class="uppercase mb16 fade-on-hover">Services</h5></a></li>
                    <li><a href="{{ action('FrontendController@about') }}"><h5 class="uppercase mb16 fade-on-hover">Meet us</h5></a></li>
                    <li><a href="{{ action('FrontendController@contacts') }}"><h5 class="uppercase mb16 fade-on-hover">Contacts</h5></a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-4">
                <ul>
                    <li><a href="{{ action('FrontendController@profile') }}"><h5 class="uppercase mb16 fade-on-hover">Profile</h5></a></li>
                    <li><a href="{{ action('FrontendController@privacy') }}"><h5 class="uppercase mb16 fade-on-hover">Privacy policy</h5></a></li>
                    <li><a href="{{ action('FrontendController@terms') }}"><h5 class="uppercase mb16 fade-on-hover">Terms and conditions</h5></a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-4">

            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <span class="sub">© Copyright {{ date('Y', time()) }} - Pixsens LTD</span>
            </div>
            <div class="col-sm-6 text-right">
                <ul class="list-inline social-list">
                    <li>
                        <a href="#">
                            <i class="ti-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ti-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ti-twitter-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>