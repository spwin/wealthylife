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
                        <h4 class="uppercase mb16">Gift vouchers</h4>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>A Special Gift for a Special Someone!</h4>
                                    <p>Are you looking for the perfect gift to surprise a loved one? At Stylesensei, we have the most unique and special gift for you to put a smile on a special friend’s face.</p>
                                    <p>You can get your hands on our gift voucher to give a friend or a family member a chance to get style advice from our team of experts. Our gift vouchers are exceptional and fun, especially if you want a friend to feel confident in their style . By making use of our gift voucher, you can give others an opportunity to get expert advice on fashion, styling, and look.</p>
                                    <h5>So, choose the voucher you desire and turn someone’s day around by giving them a chance to be stylish.</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center">
                                        <p class="voucher-back"><i class="ti-gift"></i></p>
                                        <H5 class="uppercase">Go here to</H5>
                                        <span class="price">Buy</span>
                                        <p class="lead">£20 - £100 Gift Vouchers</p>
                                        <p>Perfect Present for a Loved One</p>
                                        <a class="btn btn-filled btn-lg" href="{{ action('FrontendController@buyVoucher') }}">Make Someone Smile</a>
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <p class="voucher-back"><i class="ti-gift"></i></p>
                                        <H5 class="uppercase">Enter code to</H5>
                                        <span class="price">Claim</span>
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
                                    <h2 class="uppercase mb16">How it works</h2>
                                    <p>
                                        Let a loved one enjoy free style advice by following the steps given below:
                                        <ul>
                                            <li>1. Create Voucher –Fill out the details in our voucher form and move to the payment.</li>
                                            <li>2. Voucher Code –Send the voucher code with a personalised message to your loved one or let us handle it on your behalf and send the code to the email address you provided alongside a copy of the message to your email address.</li>
                                            <li>3. Claim Voucher Credits – Receivers will get the code which they will need to enter after registering with us.</li>
                                            <li>4. Get Set, Go –Recipients will then have the chance to get fashion advice and styling tips from our experts by making use of the available credits.</li>
                                            <li>*The voucher code expires in 6 months.</li>
                                        </ul>
                                        <h5>Buy our gift vouchers to help a loved one get fashion advice for free!</h5>
                                    </p>
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