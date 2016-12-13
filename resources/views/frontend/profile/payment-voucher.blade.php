@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
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

        <div class="container about-block">
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
                    <h4 class="uppercase mb16">Payment process</h4>
                    <h4 class="uppercase mb24 bold italic">Summary</h4>
                    <div class="col-md-12">
                        <p class="lead">Send to: <span class="bold">{{ $voucher->receiver_email }}</span></p>
                        @if($voucher->message)
                            <p class="lead">Your message:</p>
                            <p>{{ $voucher->message }}</p>
                        @endif
                    </div>
                    <div class="col-md-4 voucher-summary">
                        <div class="pricing-table voucher-small emphasis pt-1 text-center">
                            <H5 class="uppercase">Total to pay:</H5>
                            <span class="price">£{{ round($voucher->price) }}</span>
                            <p class="lead">Gift of {{ $voucher->credits }} credits</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        {!! Form::open([
                        'method' => 'POST',
                        'action' => ['UserController@checkoutVoucher', $voucher->id],
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
    var clientToken = "{{ $token }}";
    braintree.setup(clientToken, "dropin", {
        container: "payment-form"
    });
</script>
@endpush