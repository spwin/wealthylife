@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">Contact us</h2>
                    <p class="lead mb0">We are always happy to hear from you.</p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5">
                    <h4 class="uppercase">Get In Touch</h4>
                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                    </p>
                    <hr>
                    <p>
                        <strong>Pixsens LTD</strong>
                        <br /> Kemp House
                        <br /> 160 City Road
                        <br /> London EC1V 2NX
                    </p>
                    <hr>
                    <p>
                        <strong>E:</strong> <span id="eadr">m<b>@</b>e@d<b>no</b>oma<b>.com</b>in.com</span>
                        <br />
                        {{--<strong>P:</strong> +614 3948 2726
                        <br />--}}
                    </p>
                </div>
                <div class="col-sm-6 col-md-5 col-md-offset-1">
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
                        {!! Form::text('name', null, ['placeholder' => 'Your Name']) !!}
                        {!! Form::text('email', null, ['placeholder' => 'Email Address']) !!}
                        {!! Form::textarea('message', null, ['rows' => 4, 'placeholder' => 'Message']) !!}
                        <button type="submit">Send Message</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
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