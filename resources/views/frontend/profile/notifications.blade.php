@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
                        <h4 class="uppercase mb16">Notifications</h4>
                        <a class="small-text pull-right" href="{{ action('UserController@markNotifications') }}">Mark all as read</a>
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
    </section>
    @include('frontend/footer')
@stop