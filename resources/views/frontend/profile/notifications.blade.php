@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('body-class', 'profile-page')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Notifications</h1>
                    <h2 class="lead mb0 below">Little <span class="color-red">surprises</span></h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">USER MENU</span>
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

        <div class="container about-block notifications">
            <div class="row">
                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9">

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
                        <h4 class="uppercase mb16">Notifications</h4>
                        <a class="small-text" href="{{ action('UserController@markNotifications') }}">Mark all as read</a>
                        @if (count($errors->general) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->general->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.general.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.general.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.general.message') }}
                            </div>
                        @endif
                        <table class="table notifications-table">
                            @foreach($user->notifications()->orderBy('created_at', 'DESC')->get() as $notification)
                                <tr {{ $notification->seen ? '' : 'class=bold' }}>
                                    <td class="w170px"><a href="{{ action('FrontendController@showNotification', ['id' => $notification->id]) }}">{{ date('d M, Y H:i', strtotime($notification->created_at)) }}</a></td>
                                    <td><a href="{{ action('FrontendController@showNotification', ['id' => $notification->id]) }}">{{ $notification->subject }}</a></td>
                                </tr>
                            @endforeach
                        </table>
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