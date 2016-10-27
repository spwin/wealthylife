@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@questions', '#drafts') }}"><i class="ti-arrow-left"></i> Questions list</a></h4>
                        </div>
                        <h4 class="uppercase mb16">Question payment</h4>
                        <div class="question-body">
                            @if(count($question->images) > 0)
                                @foreach($question->images as $image)
                                    <a href="{{ url()->to('/').$image->path.$image->filename }}" data-lightbox="image-{{ $image->id }}" data-title="Question #{{ $question->id }}">
                                        <img src="{{  url()->to('/').'/photo/300x300/'.$image->filename }}">
                                    </a>
                                @endforeach
                            @else
                                <img src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                            @endif
                            <div class="question-text">
                                <p>{{ $question->question }}</p>
                            </div>
                            <div class="clear"></div>
                            <div class="modal-container inline-block">
                                <a class="btn btn-modal btn-filled" href="#">Edit</a>
                                <div class="hidden">
                                    @include('frontend/elements/question-database', ['question' => $question])
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <hr class="visible-xs">
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