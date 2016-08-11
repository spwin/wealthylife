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
                        @include('frontend/elements/question')
                    </div>
                    <h4 class="uppercase mb16">Payment process</h4>
                    <div class="col-md-12 text-center col-sm-12">
                        <h2 class="uppercase mb24 bold italic">Voucher details</h2>
                        {{ dump($voucher) }}
                        <hr class="visible-xs">
                    </div>
                    <div class="col-md-12 col-sm-12 text-center">
                        <h2 class="uppercase mb24 bold italic">Price: £{{ $voucher->price }}</h2>
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