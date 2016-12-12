@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('body-class', 'profile-page')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Gift vouchers</h1>
                    <h2 class="lead mb0 below"><span class="color-red">A special gift</span> for special Someone!</h2>
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

        <div class="container about-block vouchers">
            <div class="row">
                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right right ask-position-mob">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask consultant</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16"><span class="fs44">A Special Gift</span><span class="display-block"></span><span class="opacity05"> for a Special Someone!</span></h4>
                        @if (count($errors->voucher) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->voucher->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.voucher.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.voucher.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.voucher.message') }}
                            </div>
                        @endif
                        <section class="pt-20px pb-20px">
                            <div class="row credits">
                                <div class="col-md-12">

                                    <p><span class="bold700 fs19">Are you looking for the perfect gift to surprise a loved one?</span><span class="display-block"></span> At StyleSensei, we have the most unique and special gift for you to put a smile on a special friend’s face.</p>
                                    <p>You can get your hands on our gift voucher to give a friend or a family member a chance to get style advice from our team of experts. Our gift vouchers are exceptional and fun, especially if you want a friend to feel confident in their style . By making use of our gift voucher, you can give others an opportunity to get expert advice on fashion, styling, and look.</p>
                                    <h5>So, choose the voucher you desire and turn someone’s day around by giving them a chance to be stylish.</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <p class="uppercase voucher-top"><span class="smile">Make<br> someone <span class="bold700">smile</span></span></p>
                                        <span class="price"><span class="vouch-buy">Buy</span><span class="text-center price-pos bold700 display-block fs22"><span class="color-red overwrite">£20 - £100</span><br> Gift Vouchers</span></span>
                                        <p class="lead"></p>
                                        <p class="uppercase perfect-present"><span class="bold700 fs19">Perfect Present</span><br> for a <span class="color-red">Loved</span> One</p>
                                        <a class="btn btn-filled btn-lg red-btn" href="{{ action('FrontendController@buyVoucher') }}">Make Someone Smile</a>
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <p class="uppercase voucher-top"><span class="smile enter-code"><span class="bold700">Enter</span><br></be> code to</span></p>
                                        <span class="price claim"><span>Use</span><span class="text-center price-pos bold700 display-block use-voucher">Voucher</span></span>
                                        {!! Form::open([
                                            'role' => 'form',
                                            'url' => action('UserController@checkVoucher'),
                                            'method' => 'POST',
                                            'class' => 'login-profile'
                                        ]) !!}
                                        <p class="lead"><input type="text" name="code" class="voucher-claim" placeholder="Enter Code Here"></p>
                                        <input type="submit" class="btn btn-filled btn-lg voucher-check" value="Confirm And Continue">
                                        {!! Form::close() !!}
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                            </div>
                            <!--end of row-->
                        </section>

                        <section class="pt-20px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="uppercase mb0">How it works?</h4>
                                    <p class="lead uppercase mb24">Let a loved one enjoy free style advice by following the steps given below:</p>
                                    <hr>
                                    <div class="left smaller">
                                        <div class="profile-how-it phifirst left"><span class="bold700 display-block">01. CREATE VOUCHER</span>Fill out the details in our voucher form and move to the payment.</div>
                                        <div class="profile-how-it phisecond left"><span class="bold700 display-block">02. VOUCHER CODE</span>Send the voucher code with a personalised message to your loved one or let us handle it on your behalf and send the code to the email address you provided alongside a copy of the message to your email address.</div>
                                    </div>
                                    <div class="right larger">
                                        <div class="profile-how-it phithird left"><span class="bold700 display-block">03. CLAIM VOUCHER CREDITS</span>Receivers will get the code which they will need to enter after registering with us.</div>
                                        <div class="profile-how-it phifourth left"><span class="bold700 display-block">04. GET SET, GO</span>Recipients will then have the chance to get fashion advice and styling tips from our experts by making use of the available credits.</div>
                                    </div>
                                    <div class="clearboth"></div>
                                    <hr class="mt16 mb0">
                                    <h5 class="opacity05 vouchh5">*The voucher code expires in 6 months.</h5>
                                    <hr class="mb0">
                                    <h5 class="vouchh5"><span class="opacity05">Buy our gift vouchers to help a loved one get fashion advice</span> <span class="color-green-prof bold700">for free!</span></h5>
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