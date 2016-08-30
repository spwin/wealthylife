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
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16">Buy credits</h4>
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
                        <section class="pt-20px pb-20px">
                            @foreach($schemes as $scheme)
                                <div class="col-md-4 col-sm-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <H5 class="uppercase">{{ $scheme->credits }} credits for</H5>
                                        <span class="price">£{{ round($scheme->price) }}</span>
                                        <p class="discount"><span class="round">- {{ round(100 - ($scheme->price*100/$scheme->credits)) }}%</span></p>
                                        <p class="lead">{{ $scheme->questions }} questions</p>
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
                        </section>
                        <section class="pt-20px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="uppercase mb16">How it works</h2>
                                    <h4>1 credit = £1</h4>
                                    <p>
                                        Want to know how to get started? Follow the steps given below:<br/>
                                        <ul>
                                            <li>1. Choose – Choose one of the credit options you’d like..</li>
                                            <li>2. Pay – Complete your request by paying for the purchased credits entering your credit/debit card details or simply use PayPal on checkout.</li>
                                            <li>3. Ask – Use your purchased credits by asking style-experts’ questions.</li>
                                        </ul>
                                    </p>

                                    <h4>Ask More Questions, Enjoy Better Deals!</h4>
                                    <p>
                                        Looking to get fashion advice without having to pay each time? At Stylesensei, we make your wishes come true. You can also ask us any style and fashion related questions without paying for it through your credit card. The more credits you buy, the higher will be your reward.
                                        We offer perks to our loyal customers by giving them a chance to collect credits each time they invite a friend using unique referral link. And when you have collected enough credits, you can utilise them to ask questions for free. It just gets better with us!
                                    </p>

                                    <h4>We Protect Your Credit Details</h4>
                                    <p>
                                        Stylesensei site is encrypted with SSL certificate. This means that you don’t need to worry about entering your credit details at the time of checkout. We ensure 100% website safety and security for our customers, giving them a chance to make use of our service without any hassle.
                                    </p>

                                    <h5>Purchase credits and get all your style problems solved!</h5>
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