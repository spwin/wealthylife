@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container summary-profile">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <section class="pt-20px pb-20px">
                        <div class="tabbed-content text-tabs display-after-load">
                            <div class="modal-container text-right">
                                <a class="btn btn-modal hovered mb-0px" id="ask-question-button" href="#">Ask question</a>
                                <div class="hidden">
                                    @include('frontend/elements/question')
                                </div>
                            </div>
                            <h4 class="uppercase mb16">Howdy, {{ $user->userData->first_name }}</h4>
                            @if(($count = $user->notifications()->where(['seen' => 0])->count()) > 0)
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    You have {{ $count }} new notification{{ $count > 1 ? 's' : '' }}. <a href="{{ action('FrontendController@notifications') }}">Check now</a>
                                </div>
                            @endif
                            @if(!$fill_info)
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    Please fill all the data so consultant could provide you with better answer. <a href="{{ action('FrontendController@profile', '#general') }}">Fill now</a>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="header">Account</div>
                                <ul>
                                    <li><a href="{{ action('FrontendController@profile', '#general') }}">Change general details</a></li>
                                    <li><a href="{{ action('FrontendController@profile', '#login') }}">Change login data</a></li>
                                </ul>

                                <div class="header">Blog</div>
                                <ul>
                                    <li><a href="{{ action('FrontendController@newArticle') }}">Create Blog entry</a></li>
                                    <li><a href="{{ action('FrontendController@articles') }}">My entries</a></li>
                                    @if(($count = ($user->articles ? $user->articles()->where(['status' => 3])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@articles', '#published') }}">Published ({{ $count }})</a></li>
                                    @endif
                                    @if(($count = ($user->articles ? $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@articles', '#submitted') }}">Submitted ({{ $count }})</a></li>
                                    @endif
                                    @if(($count = ($user->articles ? $user->articles()->where(['status' => 0])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@articles', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                    @endif
                                </ul>

                                <div class="header">Gift vouchers</div>
                                <ul>
                                    <li><a href="{{ action('FrontendController@buyVoucher') }}">Buy voucher</a></li>
                                    <li><a href="{{ action('FrontendController@vouchers') }}">Use voucher</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="header">Questions</div>
                                <ul>
                                    <li><a href="#" class="new-question">New question</a></li>
                                    @if(($count = ($user->questions ? $user->questions()->where(['status' => 2])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@questions', '#answered') }}">Answered ({{ $count }})</a></li>
                                    @endif
                                    @if(($count = ($user->questions ? $user->questions()->where(['status' => 1])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@questions', '#pending') }}">Pending ({{ $count }})</a></li>
                                    @endif
                                    @if(($count = ($user->questions ? $user->questions()->where(['status' => 0])->count() : 0)) > 0)
                                        <li><a href="{{ action('FrontendController@questions', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                    @endif
                                    <li><a href="{{ action('FrontendController@questions') }}">My questions</a></li>
                                </ul>

                                <div class="header">My credits</div>
                                <ul>
                                    <li><a href="{{ action('FrontendController@credits') }}">Buy credits</a></li>
                                    <li><a href="{{ action('FrontendController@credits', '#how-it-works') }}">What are the benefits?</a></li>
                                </ul>

                                <div class="header">Referral reward program</div>
                                <ul>
                                    <li><a href="{{ action('FrontendController@referral') }}">My referrals</a></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop
@push('scripts')
<script>
    ($)(function(){
        $('.new-question').on('click', function(e){
            e.preventDefault();
            $('#ask-question-button').click();
        });
    });
</script>
@endpush