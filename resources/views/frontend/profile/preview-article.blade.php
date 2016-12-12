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
                    <h1 class="uppercase mb8 page-h2">Create <span class="color-blue-prof">entry</span></h1>
                    <h2 class="lead mb0 below">Let the <span class="color-blue-prof">style</span> begin</h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">PROFILE MENU</span>
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

        <div class="container about-block preview-article">
            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9 no-padding">

                    <div class="inner-article tabbed-content text-tabs display-after-load">
                        <!--div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div-->
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@articles', [$article->status == 0 ? '#drafts' : ($article->status == 3 ? '#published' : '#submitted')]) }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        <h4 class="uppercase mb16">Preview & Submit for review</h4>
                        <div class="col-md-12">
                            @if (Session::has('flash_notification.article.message'))
                                <div class="alert alert-{{ Session::get('flash_notification.article.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ Session::get('flash_notification.article.message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12 mt-15px mb-25px">
                            <hr>
                            <div class="post-snippet mb64">
                                <div class="post-title">
                                    <h4 class="inline-block">{{ $article->title }}</h4>
                                </div>
                                <ul class="post-meta">
                                    <li>
                                        <i class="ti-calendar"></i>
                                        <span class="number">{{ date('d M, Y', strtotime($article->created_at)) }}</span>
                                    </li>
                                    @if(!$article->hide_name)
                                    <li>
                                        <i class="ti-user"></i>
                                        <span>Written by <strong>{{ $article->user->userData->first_name.' '.$article->user->userData->last_name }}</strong></span>
                                    </li>
                                    @endif
                                    @if(!$article->hide_email)
                                    <li>
                                        <i class="ti-email"></i>
                                        <span>{{ $article->user->email }}</span>
                                    </li>
                                    @endif
                                </ul>
                                <img src="{{ url()->to('/').'/blog/500x500/'.$article->image->filename }}"/>
                                {!! $article->content !!}
                            </div>
                            <!--end of post snippet-->
                            <hr>
                            @if(!$article->disable_comments)
                                <div class="feature feature-3 feature-4 bordered">
                                    <div class="left">
                                        <i class="ti-info-alt icon-lg"></i>
                                    </div>
                                    <div class="right">
                                        <h5 class="uppercase mb16">Comments section</h5>
                                        <p>
                                            There will be comments section in published blog entry. In preview mode comments are disabled for security reasons.
                                        </p>
                                    </div>
                                </div>
                            @endif
                            {{--
                            @if(!$article->disable_comments)
                                <div class="disqus-comments" data-shortname="stylesensei">
                                    <div id="disqus_thread"></div>
                                </div>
                            @endif
                            --}}
                            <!--end of comments-->
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="pull-left">
                                <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}" class="btn hovered">Edit</a>
                            </div>
                            <div class="pull-right">
                                @if($article->status == 0)
                                    {!! Form::open([
                                        'role' => 'form',
                                        'url' => action('UserController@submitArticle', ['id' => $article->id]),
                                        'method' => 'POST',
                                        'class' => 'confirm-article'
                                    ]) !!}
                                    <input type="submit" class="btn" value="Submit for review">
                                    {!! Form::close() !!}
                                @else
                                    <h4 class="mr-15px">Submitted for review</h4>
                                @endif
                            </div>
                        </div>
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