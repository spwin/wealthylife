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
                    <h1 class="uppercase mb8 page-h2">Notifications</h1>
                    <h2 class="lead mb0 below">Little <span class="color-red">surprises</span></h2>
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

        <div class="container about-block">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">

                    <div class="toggle-button profile-menu-but bold700 visible990">
                        <span class="display-block mb16">PROFILE MENU</span>
                        <hr>
                    </div>

                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right right ask-position-mob">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask consultant</a>
                            <div class="hidden">
                                @if(\App\Helpers\Helpers::isMobile())
                                    @include('mobile/frontend/elements/question')
                                @else
                                    @include('frontend/elements/question')
                                @endif
                            </div>
                        </div>
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@notifications') }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        <div class="notification-time">
                            {{ date('d M, Y H:i', strtotime($notification->created_at)) }}
                        </div>
                        <p class="bigger">{{ $notification->subject }}</p><hr/>
                        <p>{!! $notification->body !!}</p>
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