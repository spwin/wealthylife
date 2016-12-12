@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Gift vouchers</h1>
                    <h2 class="lead mb0 below"><span class="color-red">A special gift</span> for special Someone!</h2>
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

        <div class="container about-block buy-voucher">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <!--div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div-->
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@vouchers') }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        <h4 class="uppercase mb16">Fill the details</h4>
                        @if (count($errors->voucher) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->voucher->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.voucher.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.voucher.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.voucher.message') }}
                            </div>
                        @endif
                        <section class="pt-20px pb-20px">
                            {!! Form::open([
                                'role' => 'form',
                                'url' => action('UserController@payVoucher'),
                                'method' => 'POST',
                                'class' => 'voucher-form'
                            ]) !!}
                            {!! Form::hidden('voucher_value', null) !!}
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="input-with-label text-left">
                                        <h5 class="uppercase"><span class="text-red">*</span> Receiver email:</h5>
                                        {!! Form::email('receiver_email', null, ['class' => $errors->general->first('receiver_email', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Email']) !!}
                                    </div>
                                </div>
                                <div class="mt-15px col-sm-12">
                                    <div class="input-with-label text-left">
                                        <h5 class="mb-0px uppercase">Message:</h5>
                                        <p class="label_description">This is optional field, it will be send to voucher receiver with the coupon code. 500 symbols maximum.</p>
                                        {!! Form::textarea('message', null, ['size' => '30x5', 'class' => $errors->general->first('message', 'field-error ').'less-profile-input-margin', 'placeholder' => 'Message here']) !!}
                                    </div>
                                </div>
                                <div class="mt-15px col-sm-10">
                                    <div class="input-with-label text-left">
                                        <h5 class="mb-0px mr-15px uppercase">Hide my details</h5>
                                        <p class="label_description">Choose if you do not want your lucky receiver to know your details and send the voucher anonymously.</p>
                                        <div class="checkbox-option pull-left {{ old('anonymous') ? 'checked' : '' }}">
                                            <div class="inner"></div>
                                            {!! Form::checkbox('anonymous', 1) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-15px">
                                <div class="col-sm-10">
                                    <h5 class="uppercase pull-left mb-0px"><span class="text-red">*</span> Select your voucher value</h5>
                                </div>
                            </div>
                            <section class="pt-20px pb-20px vouchers-form-select">
                                <div class="row">
                                    @foreach($schemes as $scheme)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="pricing-table pt-1 text-center {{ old('voucher_value') && old('voucher_value') == $scheme->id ? 'emphasis' : '' }}" data-id="{{ $scheme->id }}">
                                                <H5 class="uppercase">{{ $scheme->questions }} question{{ $scheme->questions > 1 ? 's' : '' }}</H5>
                                                <span class="price">£{{ round($scheme->price) }}</span>
                                                <p class="lead">Gift of {{ $scheme->credits }} credits</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end of row-->
                            </section>
                            <input type="submit" class="btn btn-filled mt-15px" value="Continue to payment">
                            {!! Form::close() !!}
                        </section>
                    </div>
                </div>
            </div>
        </div>

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
    ($)(function(){
        var active_price_select = $('.pricing-table:not(.emphasis)');
        active_price_select.hover(function(){
            $(this).addClass('boxed');
        }, function(){
            $(this).removeClass('boxed');
        });
        active_price_select.on('click', function(){
            $('.pricing-table').removeClass('emphasis');
            $(this).addClass('emphasis');
            $('input[name="voucher_value"]').val($(this).attr('data-id'));
        });
    });
</script>
@endpush