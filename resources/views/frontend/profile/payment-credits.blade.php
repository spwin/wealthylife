@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
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

        <div class="container about-block payment-credits">
            <div class="row">
                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">
                    <!--div class="modal-container text-right">
                        <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                        <div class="hidden">
                            @include('frontend/elements/question')
                        </div>
                    </div-->
                    <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@credits') }}"><i class="ti-arrow-left"></i> See all packages</a></h4>
                    <h4 class="uppercase mb16">Payment process</h4>
                    <div class="col-md-4">
                        <div class="credits-preview pricing-table voucher-small pt-1 text-center boxed">
                            <span class="display-block absolute gradient-overlay-bottom"></span>
                            <span class="display-block absolute gradient-overlay-top"></span>
                            <h5 class="uppercase">{{ $scheme->credits }} credits for</h5>
                            <span class="price">£{{ round($scheme->price) }}</span>
                            <p class="discount"><span class="round">- {{ round(100 - ($scheme->price*100/$scheme->credits)) }}%</span></p>
                            <p class="lead">{{ $scheme->questions }} questions</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="last-payment-preview">
                            <tr class="total-price">
                                <td class="text-left">TOTAL TO PAY:</td>
                                <td class="text-left">£{{ $scheme->price }}</td>
                            </tr>
                        </table>
                        {!! Form::open([
                        'method' => 'POST',
                        'action' => ['UserController@checkoutCredits', $scheme->id],
                        'class' => 'payment-form'
                        ]) !!}
                        <div id="payment-form"></div>
                        <button type="submit" class="btn btn-filled">Confirm and Pay</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div><!--end of row-->
        </div><!--end of container-->

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
<script src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"></script>
<script>
    ($)(function(){
        var clientToken = "{{ $token }}";
        braintree.setup(clientToken, "dropin", {
            container: "payment-form"
        });
    });
</script>
@endpush