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
                                @if(count($question->images) > 0)
                                    @foreach($question->images as $image)
                                        <a href="{{ url()->to('/').$image->path.$image->filename }}" data-lightbox="image-{{ $image->id }}" data-title="Question #{{ $question->id }}">
                                            <img src="{{  url()->to('/').'/photo/300x300/'.$image->filename }}">
                                        </a>
                                    @endforeach
                                @else
                                    <img src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                @endif
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
                            <p class="only-point-message">
                                As you use your credits to pay for your question you just need to confirm it. {{ $order_draft->points }} will be taken from your balance.
                            </p>
                            {!! Form::open([
                            'method' => 'POST',
                            'action' => ['UserController@pointsPayment', $order_draft->id],
                            'class' => 'payment-form'
                            ]) !!}
                            <button type="submit" class="btn btn-filled">Confirm</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end of container-->
    </section>
    @include('frontend/footer')
@stop