@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-right text-left-xs col-sm-6">
                    <h2 class="uppercase mb24 bold italic">Your question</h2>
                    <p class="question-body">
                        <img align="right" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                        {{ $question->question }}
                    </p>
                    <div class="modal-container inline-block">
                        <a class="btn btn-modal" href="#">Edit</a>
                        {{-- Edit current question from database --}}
                        @include('frontend/elements/question-database', ['question' => $question])
                    </div>
                    <hr class="visible-xs">
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="mb24">£{{ $question_price }} will be taken from your balance.</h4>
                    {!! Form::open([
                    'method' => 'POST',
                    'action' => ['UserController@pointsPayment', $question->id]
                    ]) !!}
                    <input type="submit" value="Confirm and proceed">
                    {!! Form::close() !!}
                </div>
            </div><!--end of row-->
        </div><!--end of container-->
    </section>
@stop