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
                    <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@credits') }}"><i class="ti-arrow-left"></i> See all packages</a></h4>
                    <h4 class="uppercase mb16">Payment process</h4>
                    <div class="col-md-4">
                        <div class="credits-preview pricing-table pt-1 text-center boxed">
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