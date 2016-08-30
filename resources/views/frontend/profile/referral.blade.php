@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
                        <h4 class="uppercase mb16">Referral rewards program</h4>
                        <div class="referral-text">Get your free £2 for each friend you invite to use our services!</div>
                        <section class="pt-20px pb-20px">
                            <h3>Your unique referral link:</h3>
                            <div class="referral-link">{{ action('FrontendController@acceptReferral', ['referral' => $user->id, 'key' => $user->referral_key]) }}</div>

                            <h3>Your current referrals:</h3>
                            <div class="col-md-4">
                                <h5 class="uppercase">Registered: <span class="numbers">{{ $user->referrals_registered }}</span></h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="uppercase">Confirmed: <span class="numbers">{{ $user->referrals_confirmed }}</span></h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="uppercase">Points collected: <span class="numbers">{{ $user->referrals_points }}</span></h5>
                            </div>
                        </section>
                        <section class="pt-20px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="uppercase mb16">How it works</h2>
                                    <p class="lead mb48">Collect point by inviting people!</p>
                                    <p>
                                        <ul>
                                            <li><b>SHARE</b> - Copy your unique referral link and share it to your friend</li>
                                            <li><b>USE</b> - Your friend must enter www.stylesensei.co.uk using your link</li>
                                            <li><b>GET REWARDED</b> - Reward of 2 points will be transferred to your account as soon as your friend uses one of our paid service</li>
                                            <li><b>TRACK</b> - You can check the number of registered and confirmed referrals on this page</li>
                                        </ul>
                                    </p>
                                    <h5>LET THE STYLE BEGIN</h5>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop