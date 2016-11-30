@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Ask question</h1>
                    <h2 class="lead mb0 below"></h2>
                </div>
            </div>
            <!--end of row-->
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

        <div class="container about-block points-question">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs questions-container">
                        <div class="modal-container text-left">
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