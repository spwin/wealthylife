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
                    <h1 class="uppercase mb8 page-h2">Summary</h1>
                    <h2 class="lead mb0 below"><span class="color-green-prof">It's all</span> about You!</h2>
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


        <div class="container summary-profile about-block">
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

                    <section class="pt-20px pb-40px">
                        <div class="tabbed-content text-tabs display-after-load">
                            <div class="modal-container text-right ask-position-mob right">
                                <a class="btn btn-modal hovered mb-0px" id="ask-question-button" href="#">Ask consultant</a>
                                <div class="hidden">
                                    @include('frontend/elements/question')
                                </div>
                            </div>
                            <h4 class="uppercase mb40 referral-head">Howdy, {{ $user->userData->first_name }}!</h4>
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
                                    Complete your profile for better answers. <a href="{{ action('FrontendController@profile', '#general') }}">Click here</a>
                                </div>
                            @endif

                            <!--table class="summary-table">

                                <tr class="border-bottom uppercase">
                                    <th class="sum1 summary-thead">My account</th>
                                    <th class="sum2 summary-thead">Blog</th>
                                    <th class="sum3 summary-thead">Gift vouchers</th>
                                </tr>
                                <tr class="border-bottom">
                                    <td valign="top">
                                        <ul>
                                            <li><a href="{{ action('FrontendController@profile', '#general') }}">My account details</a></li>
                                            <li><a href="{{ action('FrontendController@profile', '#login') }}">Change password</a></li>
                                        </ul>
                                    </td>
                                    <td valign="top">
                                        <ul>
                                            <li><a href="{{ action('FrontendController@newArticle') }}">Create</a></li>
                                            {{--<li><a href="{{ action('FrontendController@articles') }}">My entries</a></li>--}}
                                            @if(($count = ($user->articles ? $user->articles()->where(['status' => 0])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@articles', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                            @endif
                                            @if(($count = ($user->articles ? $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@articles', '#submitted') }}">Submitted ({{ $count }})</a></li>
                                            @endif
                                            @if(($count = ($user->articles ? $user->articles()->where(['status' => 3])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@articles', '#published') }}">Published ({{ $count }})</a></li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td valign="top">
                                        <ul>
                                            <li><a href="{{ action('FrontendController@buyVoucher') }}">Buy a gift voucher</a></li>
                                            <li><a href="{{ action('FrontendController@vouchers') }}">Use a gift voucher</a></li>
                                        </ul>
                                    </td>
                                </tr>

                            </table>

                            <table class="summary-table">

                                <tr class="border-bottom uppercase">
                                    <th class="sum4 summary-thead">Questions</th>
                                    <th class="sum5 summary-thead">Credits</th>
                                    <th class="sum6 summary-thead">Referral reward program</th>
                                </tr>
                                <tr class="border-bottom">
                                    <td valign="top">
                                        <ul>
                                            <li><a href="#" class="new-question">New</a></li>
                                            @if(($count = ($user->questions ? $user->questions()->where(['status' => 0])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@questions', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                            @endif
                                            @if(($count = ($user->questions ? $user->questions()->where(['status' => 1])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@questions', '#pending') }}">Pending ({{ $count }})</a></li>
                                            @endif
                                            @if(($count = ($user->questions ? $user->questions()->where(['status' => 2])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@questions', '#answered') }}">Answered ({{ $count }})</a></li>
                                            @endif
                                            @if(($count = ($user->questions ? $user->questions()->where(['status' => 3])->count() : 0)) > 0)
                                                <li><a href="{{ action('FrontendController@questions', '#rejected') }}">Rejected ({{ $count }})</a></li>
                                            @endif
                                            {{--<li><a href="{{ action('FrontendController@questions') }}">My questions</a></li>--}}
                                        </ul>
                                    </td>
                                    <td valign="top">
                                        <ul>
                                            <li><a href="{{ action('FrontendController@credits') }}">Buy credits</a></li>
                                            <li><a href="{{ action('FrontendController@credits', '#how-it-works') }}">Why use credits?</a></li>
                                        </ul>
                                    </td>
                                    <td valign="top">
                                        <ul>
                                            <li><a href="{{ action('FrontendController@referral') }}">My referrals</a></li>
                                        </ul>
                                    </td>
                                </tr>

                            </table-->


                            <div class="summary-blocks summary-table row">

                                <div class="summary-block col-md-4">
                                    <p class="sum1 summary-thead">My account</p>
                                    <ul>
                                        <li><a href="{{ action('FrontendController@profile', '#general') }}">My account details</a></li>
                                        <li><a href="{{ action('FrontendController@profile', '#login') }}">Change password</a></li>
                                    </ul>
                                </div>
                                <div class="summary-block col-md-4">
                                    <p class="sum2 summary-thead">Blog</p>
                                    <ul>
                                        <li><a href="{{ action('FrontendController@newArticle') }}">Create</a></li>
                                        {{--<li><a href="{{ action('FrontendController@articles') }}">My entries</a></li>--}}
                                        @if(($count = ($user->articles ? $user->articles()->where(['status' => 0])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@articles', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                        @endif
                                        @if(($count = ($user->articles ? $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@articles', '#submitted') }}">Submitted ({{ $count }})</a></li>
                                        @endif
                                        @if(($count = ($user->articles ? $user->articles()->where(['status' => 3])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@articles', '#published') }}">Published ({{ $count }})</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="summary-block col-md-4">
                                    <p class="sum3 summary-thead">Gift vouchers</p>
                                    <ul>
                                        <li><a href="{{ action('FrontendController@buyVoucher') }}">Buy a gift voucher</a></li>
                                        <li><a href="{{ action('FrontendController@vouchers') }}">Use a gift voucher</a></li>
                                    </ul>
                                </div>

                            </div>


                            <div class="summary-blocks summary-table row">

                                <div class="summary-block col-md-4">
                                    <p class="sum4 summary-thead">Questions</p>
                                    <ul>
                                        <li><a href="#" class="new-question">New</a></li>
                                        @if(($count = ($user->questions ? $user->questions()->where(['status' => 0])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@questions', '#drafts') }}">Drafts ({{ $count }})</a></li>
                                        @endif
                                        @if(($count = ($user->questions ? $user->questions()->where(['status' => 1])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@questions', '#pending') }}">Pending ({{ $count }})</a></li>
                                        @endif
                                        @if(($count = ($user->questions ? $user->questions()->where(['status' => 2])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@questions', '#answered') }}">Answered ({{ $count }})</a></li>
                                        @endif
                                        @if(($count = ($user->questions ? $user->questions()->where(['status' => 3])->count() : 0)) > 0)
                                            <li><a href="{{ action('FrontendController@questions', '#rejected') }}">Rejected ({{ $count }})</a></li>
                                        @endif
                                        {{--<li><a href="{{ action('FrontendController@questions') }}">My questions</a></li>--}}
                                    </ul>
                                </div>
                                <div class="summary-block col-md-4">
                                    <p class="sum5 summary-thead">Credits</p>
                                    <ul>
                                        <li><a href="{{ action('FrontendController@credits') }}">Buy credits</a></li>
                                        <li><a href="{{ action('FrontendController@credits', '#how-it-works') }}">Why use credits?</a></li>
                                    </ul>
                                </div>
                                <div class="summary-block col-md-4">
                                    <p class="sum6 summary-thead">Referral reward program</p>
                                    <ul>
                                        <li><a href="{{ action('FrontendController@referral') }}">My referrals</a></li>
                                    </ul>
                                </div>

                            </div>


                        </div>
                    </section>
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
<script>
    ($)(function(){
        $('.new-question').on('click', function(e){
            e.preventDefault();
            $('#ask-question-button').click();
        });
    });
</script>
@endpush