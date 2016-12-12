@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')

    <section class="page-title payment-header page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Ask consultant</h1>
                    <h2 class="lead mb0 below">Let the <span class="color-red">style</span> begin</h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">PROFILE MENU</span>
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

        <div class="container about-block checkout-question">
            <div class="row">

                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif

                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-left">
                            <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@questions', '#drafts') }}"><i class="ti-arrow-left"></i> Questions list</a></h4>
                        </div>
                        <h4 class="uppercase mb16">Question payment</h4>
                        <hr>
                        <div class="question-body">
                            <div class="question-text">
                                <p>{{ $question->question }}</p>
                            </div>
                            @if(count($question->images) > 0)
                                @foreach($question->images as $image)
                                    <div class="col-md-4 photo-container">
                                    <a href="{{ url()->to('/').$image->path.$image->filename }}" data-lightbox="image-{{ $image->id }}" data-title="Question #{{ $question->id }}">
                                        <img src="{{  url()->to('/').'/photo/300x300/'.$image->filename }}">
                                    </a>
                                        </div>
                                @endforeach
                            @else
                                <img src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                            @endif
                            <div class="clearboth"></div>

                            <div class="clear"></div>
                                <hr class="mt16">
                            <div class="modal-container left inline-block">
                                <a class="btn btn-modal btn-filled blue-button" href="#">Edit</a>
                                <div class="hidden">
                                    @if(\App\Helpers\Helpers::isMobile())
                                        @include('mobile/frontend/elements/question-database', ['question' => $question])
                                    @else
                                        @include('frontend/elements/question-database', ['question' => $question])
                                    @endif
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <hr class="visible-xs">
                        @if (Session::has('flash_notification.question.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.question.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.question.message') }}
                            </div>
                        @endif
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('UserController@processQuestion', ['id' => $question->id]),
                            'class' => 'question-checkout',
                            'method' => 'POST'
                        ]) !!}
                        <table class="question-payment">
                            <tr class="question-price">
                                <td>Question price:</td>
                                <td class="price-row">£<span id="base-price">20</span></td>
                            </tr>
                            @if($discount)
                                <tr>
                                    <td>{{ $discount->name }}</td>
                                    <td class="used-discount">- £<span class="deduct">{{ $discount->amount }}</span></td>
                                </tr>
                            @else
                                <tr class="inactive">
                                    <td>No discounts available</td>
                                    <td class="used-discount">- <span class="deduct"></span></td>
                                </tr>
                            @endif
                            <tr class="{{ $user->points > 0 ? '' : 'inactive' }}">
                                <td class="choose-credits">
                                    @if($user->points > 0)
                                        <div class="switcher checkbox-option {{ old('use_credits') ? 'checked' : '' }}">
                                            <div class="inner"></div>
                                            {!! Form::checkbox('use_credits', 1, false) !!}
                                        </div>
                                        {!! Form::label('use_credits', 'Use my credits') !!}
                                        (Current balance: {{ $user->points }})
                                        @if($user->points > 1)
                                            <div class="slider-credits">
                                                @if($discount)
                                                    @php($max = $user->points > ($question_price - $discount->amount) ? ($question_price - $discount->amount) : $user->points)
                                                @else
                                                    @php($max = $user->points > $question_price ? $question_price  : $user->points)
                                                @endif
                                                <input type="hidden" name="credits" id="credits" readonly
                                                       data-slider-min="1"
                                                       data-slider-max="{{ $max }}"
                                                       data-slider-value="{{ $max }}"
                                                       data-slider-step="1">
                                            </div>
                                        @else
                                            <input type="hidden" name="credits" id="credits" value="1" readonly>
                                        @endif
                                    @else
                                        You have no credits. <a href="{{ action('FrontendController@credits') }}">Buy credits</a>.
                                    @endif
                                </td>
                                <td class="used-credits">- <span class="deduct"></span></td>
                            </tr>
                            <tr class="question-total">
                                <td>TOTAL TO PAY:</td>
                                <td>£<span id="total_pay">20</span></td>
                            </tr>
                        </table>
                        <input type="submit" class="btn btn-filled pull-right" value="Continue">
                        {!! Form::close() !!}
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
@push('scripts')
<script type="text/javascript">
   (function(){
       function refreshCalculations(){
           var base = Math.round(parseFloat($('#base-price').html().replace(/[^\d.-]/g, '')));
           var total = $('#total_pay');
           var sum = base;
           $('.deduct').each(function(){
               var value = Math.round(parseFloat($(this).html().replace(/[^\d.-]/g, '')));
               if(isNaN(value)){
                   value = 0;
               }
               sum = sum - value;
           });
           total.html(sum);
       }

       function changeValue(name, val){
           $(name).find('span').html(val);
           refreshCalculations();
       }

       @if($user->points > 0)
           var mySlider = $("#credits");
           mySlider.slider().on('change', function (ev) {
               changeValue('.used-credits', '£'+ev.value.newValue);
           });

           $(".switcher").on('click', function(e){
               var slider = $('.slider-credits');
               if($(this).hasClass('checked')){
                   slider.slideUp('fast');
                   changeValue('.used-credits', '');
               } else {
                   slider.slideDown('fast');
                   changeValue('.used-credits', '£'+mySlider.slider('getValue'));
               }
           });
       @endif

       refreshCalculations();
    })();
</script>
@endpush