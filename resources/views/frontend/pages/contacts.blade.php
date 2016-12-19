@extends('frontend/frame')
@section('page-title', trans('seo.contacts.title'))
@section('meta-description', trans('seo.contacts.description'))
@section('nav-style', 'nav-authorize-question')
@section('body-class', 'contacts-page')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Brand">
            <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="{{ URL::to('/') }}/images/logo-meta.png">
                <meta itemprop="width" content="225">
                <meta itemprop="height" content="225">
            </div>
            <meta itemprop="name" content="{{ env('APP_NAME') }}">
            <meta itemprop="url" content="{{ env('APP_URL') }}">
            <meta itemprop="sameAs" content="{{ env('FACEBOOK_URL') }}">
            <meta itemprop="sameAs" content="{{ env('TWITTER_URL') }}">
            <meta itemprop="sameAs" content="{{ env('GOOGLE_URL') }}">
            <meta itemprop="sameAs" content="{{ env('INSTAGRAM_URL') }}">
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Contact us</h1>
                    <h2 class="lead mb0 below">Feel free to <span class="color-cyan">contact us.</span></h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <section class="contacts-section">
        <div class="arrow-style index3 mob-left-to-right">
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
            <div class="container mob-cont">
                <div class="row">
                    <div class="half left about-block">
                            <h3 class="uppercase">Get In <span class="color-cyan">Touch</span></h3>
                            <p>Have something to share with us: a piece of advice, feedback, or a problem? Just fill out our form and we will get back to you shortly with the answer that you have been looking for. <span class="br"></span><span class="bold700">And trust me, <span class="color-cyan">we are quick!</span></span></p>
                            <hr>
                            <p>
                                <strong>Style Sensei</strong> (Pixsens LTD)
                                <br /> Kemp House
                                <br /> 160 City Road
                                <br /> <span class="color-cyan bold700">London</span> EC1V 2NX
                            </p>
                            <hr>
                            <p>
                                <strong>E:</strong> <span id="eadr">m<b>@</b>e@d<b>no</b>oma<b>.com</b>in.com</span>
                                <br />
                                <strong>P:</strong> <a href="tel:+447936005017"><span class="numbers">+44 7936 005 017</span></a>
                                <br />
                            </p>
                    </div>
                    <div class="half right about-block referral">
                        @if (Session::has('flash_notification.general.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.general.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.general.message') }}
                            </div>
                        @endif
                        @if (count($errors->contacts) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->contacts->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('FrontendController@contactForm'),
                            'class' => 'form-contacts',
                            'method' => 'POST'
                        ]) !!}
                        <div class="hidden">
                            {!! Form::text('birthday', null) !!}
                            {!! Form::text('city', 'London') !!}
                        </div>
                        {!! Form::text('name', null, ['placeholder' => 'Your Name']) !!}
                        {!! Form::text('email', null, ['placeholder' => 'Email Address']) !!}
                        {!! Form::textarea('message', null, ['rows' => 4, 'placeholder' => 'Message']) !!}
                        <button type="submit">Send Message</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearboth"></div>
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
    <!--
    ($)(function(){
            var s="=b!isfg>#nbjmup;jogpAtuzmftfotfj/dp/vl#?jogpAtuzmftfotfj/dp/vl=0b?";
            m=""; for (i=0; i<s.length; i++) m+=String.fromCharCode(s.charCodeAt(i)-1); document.getElementById('eadr').innerHTML=(m);
    });
    //-->
</script>
@endpush