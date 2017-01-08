@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('body-class', 'profile-page')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Buy credits</h1>
                    <h2 class="lead mb0 below">Treat <span class="color-red">Yourself!</span></h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">USER MENU</span>
            </div>
        </div>
        <!--end of container-->
    </section>


    <section>

        <div class="arrow-style index3 mob-right-to-left credits">
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

        <div class="container about-block">
            <div class="row">

                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif

                    <div class="col-md-9">

                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right cred right ask-position-mob">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask a question</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        @if (count($errors->credits) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->credits->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.credits.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.credits.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.credits.message') }}
                            </div>
                        @endif
                        <section class="pb-20px cred-section">
                            @foreach($schemes as $scheme)
                                <div class="col-md-4 col-sm-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <div class="helper"></div>
                                        <H5 class="uppercase cred"><span class="color-red">{{ $scheme->credits }}</span> credits</H5>
                                        <div class="price"><span>£{{ round($scheme->price) }}</span></div>
                                        @if($scheme->price != $scheme->credits)
                                            <p class="discount"><span class="round">- {{ round(100 - ($scheme->price*100/$scheme->credits)) }}%</span></p>
                                        @endif
                                        <p class="lead uppercase">{{ $scheme->questions ? $scheme->questions.' questions' : 'Some credits, huh?' }}</p>
                                        {!! Form::open([
                                            'role' => 'form',
                                            'url' => action('UserController@paymentCredits'),
                                            'method' => 'POST',
                                            'class' => 'buy-credits'
                                        ]) !!}
                                        {!! Form::hidden('scheme', $scheme->id) !!}
                                        <input type="submit" class="btn btn-filled btn-lg" value="Buy credits">
                                        {!! Form::close() !!}
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                            @endforeach
                                <div class="clearboth mobile-none"></div>
                                <div class="row left-mob width49onmob">
                                    <div class="col-md-12">
                                        <h4 class="uppercase mb0">How it works?</h4>
                                        <p class="lead uppercase mb24">1 credit = £1</p>
                                        <hr>
                                        <p>
                                            Want to know how to get started? Follow the steps given below:<br/>
                                        </p>
                                        <hr>
                                        <p class="">
                                        <div class="profile-how-it howit1 col-md-4 left"><span class="bold700 display-block uppercase">01. Choose</span>Choose one of the credit options you’d like..</div>
                                        <hr class="visible990">
                                        <div class="profile-how-it howit2 col-md-4 left"><span class="bold700 display-block uppercase">02. Pay</span>Complete your request by paying for the purchased credits entering your credit/debit card details or simply use PayPal on checkout.</div>
                                        <hr class="visible990">
                                        <div class="profile-how-it howit3 col-md-4 left"><span class="bold700 display-block uppercase">03. Ask</span>Use your purchased credits by asking style-experts’ questions.</div>
                                        <div class="clearboth"></div>
                                        </p>
                                    </div>
                                </div>
                        </section>

                        <section class="pt-0px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="uppercase mb0">Ask More Questions,</h4>
                                    <p class="lead uppercase mb24 color-red">Enjoy Better Deals!</p>
                                    <hr>
                                    <p>
                                        <span class="bold700 display-block">Looking to get fashion advice without having to pay each time?</span> At StyleSensei, we make your wishes come true.
                                    </p>
                                    <hr>
                                        You can also ask us any style and fashion related questions without paying for it through your credit card. The more credits you buy, the higher will be your reward.
                                        We offer perks to our loyal customers by giving them a chance to collect credits each time they invite a friend using <a href="{{ action('FrontendController@referral') }}">unique referral link</a>. And when you have collected enough credits, you can utilise them to ask questions for free. It just gets better with us!
                                    </p>

                                    <h4 class="uppercase mb0">We Protect</h4>
                                    <p class="lead uppercase mb24 color-blue-prof">Your Credit Details</p>
                                    <hr>
                                    <p>
                                        <span class="display-block bold700">StyleSensei site is encrypted with <span class="color-blue-prof">SSL certificate.</span></span> This means that you don’t need to worry about entering your credit details at the time of checkout. We ensure 100% website safety and security for our customers, giving them a chance to make use of our service without any hassle.
                                    </p>
                                    <hr>
                                    <h5 class="text-center opacity05 ">Purchase credits and get all your style problems <span class="color-green-prof opacity1 bold700">solved!</span></h5>
                                </div>
                            </div>
                        </section>
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