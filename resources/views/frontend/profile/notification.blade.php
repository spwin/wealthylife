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
    </section>
    @include('frontend/footer')
@stop