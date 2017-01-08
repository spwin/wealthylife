@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('body-class', 'profile-page')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Referrals</h1>
                    <h2 class="lead mb0 below"><span class="color-blue-prof">Get the most</span> of StyleSensei</h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">USER MENU</span>
            </div>
        </div>
        <!--end of container-->
    </section>

    <section class="referrals-section">

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

        <div class="container about-block">
            <div class="row">
                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif

                <div class="col-md-9">

                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right right ask-position-mob ask-position-mob">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask a question</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16 referral-head">Referral rewards <span class="fs32 color-blue-prof display-block">program</span></h4>
                        <div class="referral-text"><span class="display-block bold700 fs22">Get your <span class="color-blue-prof">free £2 for each friend</span></span> you invite to use our services!</div>
                        <section class="pt-20px pb-20px ref-section">
                            <p class="referral-text uppercase bold700 mt16 mb8">Your unique <span class="color-blue-prof">referral link:</span></p>
                            <div class="referral-link text-center">{{ action('FrontendController@acceptReferral', ['referral' => $user->id, 'key' => $user->referral_key]) }}</div>

                            <p class="referral-text uppercase bold700 mt16 mb8">Your current referrals:</p>
                            <hr>
                            <div class="col-md-4 nopad">
                                <p class="uppercase pr0 fs19 registered">Registered: <span class="numbers">{{ $user->referrals_registered }}</span></p>
                            </div>
                            <div class="col-md-4 nopad">
                                <p class="uppercase pr0 fs19 confirmed color-confirmed">Confirmed: <span class="numbers">{{ $user->referrals_confirmed }}</span></p>
                            </div>
                            <div class="col-md-4 nopad">
                                <p class="uppercase pr0 fs19 collected color-blue-prof">Points collected: <span class="numbers bold700">{{ $user->referrals_points }}</span></p>
                            </div>
                        </section>
                        <section class="pt-20px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="uppercase mb0">How it works?</h4>
                                    <p class="lead uppercase mb24">Collect points by inviting people!</p>
                                    <hr>
                                    <div class="left smaller">
                                            <div class="profile-how-it phifirst left"><span class="bold700 display-block">01. SHARE</span>Copy your unique referral link and share it to your friend</div>
                                            <div class="profile-how-it phisecond left"><span class="bold700 display-block">02. Make sure</span>Your friend must enter www.stylesensei.co.uk using your link</div>
                                    </div>
                                    <div class="right larger">
                                        <div class="profile-how-it phithird left"><span class="bold700 display-block">03. GET REWARDED</span>Reward of 2 points will be transferred to your account as soon as your friend uses one of our paid service</div>
                                            <div class="profile-how-it phifourth left"><span class="bold700 display-block">04. TRACK</span>You can check the number of registered and confirmed referrals on this page</div>
                                    </div>
                                        <div class="clearboth"></div>
                                    <hr class="mt16 mb24 ">
                                    <h5 class="text-center opacity05">Let the style begin!</h5>
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