@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center col-sm-12">
                    <h2 class="uppercase mb24 bold italic">Your question</h2>
                    <p class="question-body">
                        <img src="{{ $question->image ? url()->to('/').'/photo/300x300/'.$question->image->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                        {{ $question->question }}
                    </p>
                    <div class="modal-container inline-block">
                        <a class="btn btn-modal btn-filled" href="#">Edit</a>
                        {{-- Edit current question from database --}}
                        @include('frontend/elements/question-database', ['question' => $question])
                    </div>
                    <hr class="visible-xs">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <h2 class="uppercase mb24 bold italic">Price: £{{ $question_price }}</h2>
                    @if($difference == $question_price)
                        <h4 class="mb24">You need to pay £{{ $difference }} for your question.</h4>
                    @else
                        <h4 class="mb24">Your balance is £{{ $user_balance }}. You need to pay extra £{{ $difference }} for your question.</h4>
                    @endif
                    {!! Form::open([
                    'method' => 'POST',
                    'action' => ['UserController@payment', $question->id],
                    'class' => 'payment-form'
                    ]) !!}
                    <div id="payment-form"></div>
                    <button type="submit" class="btn btn-filled">Confirm and Pay</button>
                    {!! Form::close() !!}
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