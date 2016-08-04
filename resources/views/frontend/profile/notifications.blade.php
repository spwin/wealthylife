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
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16">Notifications</h4>
                        @if (Session::has('flash_notification.question.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.question.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.question.message') }}
                            </div>
                        @endif
                        <table class="table notifications-table">
                            @foreach($user->notifications()->orderBy('seen', 'DESC`')->orderBy('created_at', 'DESC')->get() as $notification)
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