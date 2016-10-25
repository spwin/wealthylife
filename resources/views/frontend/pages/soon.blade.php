@extends('frontend/layout')
@section('wrapper')
    <div class="main-container">
        <section class="cover fullscreen image-bg overlay">
            <div class="background-image-holder">
                <img alt="image" class="background-image" src="{{ url()->to('/') }}/images/{{ $background }}" />
            </div>
            <div class="container v-align-transform">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h3 class="uppercase mb40 mb-xs-24">Launching Soon</h3>
                            <div class="countdown mb40" data-date="2017/01/09"></div>
                        </div>
                    </div>
                </div>
                <!--end of row-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center launch">
                        <p>
                            We'll be launching our new site in the coming months. Hit the form below to get notified as we launch. Thanks for your interest!
                        </p>
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('FrontendController@soonSubmit'),
                            'class' => 'halves',
                            'method' => 'POST'
                        ]) !!}
                            {!! Form::text('email', null, ['class' => 'mb16 validate-required validate-email signup-email-field', 'placeholder' => 'Email Address']) !!}
                            <button class="mb16" type="submit">Notify Me</button>
                            <span>*We won't share your email with third parties.</span>
                        {!! Form::close() !!}
                        @if (Session::has('flash_notification.general.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.general.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.general.message') }}
                            </div>
                        @endif
                        @if (count($errors->soon) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->soon->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
    </div>
@stop
@push('scripts')
<script>
    var bg = jQuery(".background-image-holder");
    jQuery(window).resize("resizeBackground");
    function resizeBackground() {
        bg.height(jQuery(window).height() + 60);
    }
    resizeBackground();
</script>
@endpush