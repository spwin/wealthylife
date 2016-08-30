@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs questions-container">
                        <div class="modal-container text-right">
                            <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@checkoutQuestion', ['id' => $question->id]) }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        </div>
                        <h4 class="uppercase mb16">Question payment</h4>
                        <div class="col-md-4 small-question-preview">
                            <p class="question-body">
                                <img src="{{ $question->image ? url()->to('/').'/photo/300x300/'.$question->image->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                                {{ $question->question }}
                            </p>
                        </div>
                        <div class="col-md-8">
                            <table class="last-payment-preview">
                                <tr class="question-price">
                                    <td>Question price:</td>
                                    <td class="text-right w100px">£20</td>
                                </tr>
                                @if($order_draft->discount)
                                    <tr>
                                        <td>{{ $order_draft->discount->name }}</td>
                                        <td class="text-right">- £{{ $order_draft->discount->type == 'percent' ? ($order_draft->price/100)*$order_draft->discount->percent : $order_draft->discount->fixed }}</td>
                                    </tr>
                                @endif
                                @if($order_draft->points > 0)
                                    <tr>
                                        <td>{{ round($order_draft->points) }} Credits used</td>
                                        <td class="text-right">- £{{ round($order_draft->points) }}</td>
                                    </tr>
                                @else
                                    <tr class="dimmed">
                                        <td>No credits used</td>
                                        <td class="text-right">-</td>
                                    </tr>
                                @endif
                                <tr class="total-price">
                                    <td class="text-right">TOTAL:</td>
                                    <td class="text-right">£{{ $order_draft->to_pay }}</td>
                                </tr>
                            </table>
                            {!! Form::open([
                            'method' => 'POST',
                            'action' => ['UserController@payment', $order_draft->id],
                            'class' => 'payment-form'
                            ]) !!}
                            <div id="payment-form"></div>
                            <button type="submit" class="btn btn-filled">Confirm and Pay</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
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