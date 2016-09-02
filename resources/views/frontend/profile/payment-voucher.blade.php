@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="modal-container text-right">
                        <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                        <div class="hidden">
                            @include('frontend/elements/question')
                        </div>
                    </div>
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
                        <div class="pricing-table pt-1 text-center">
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