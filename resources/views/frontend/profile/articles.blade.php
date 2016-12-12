@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('body-class', 'profile-page')
@section('content')

    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2"><span class="color-blue-prof">Blog</span> entries</h1>
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

        <div class="container about-block">
            <div class="row">
                @if(!\App\Helpers\Helpers::isMobile())
                    @include('frontend/profile/user-menu')
                @endif
                <div class="col-md-9 no-padding articles-list">

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
                        <h4 class="uppercase mb0">Got a great style tip to share with others?</h4>
                        <h5 class="entries-sub"> This is the platform to do so!</h5>
                        <div class="col-md-12 no-padding">

                            <a href="{{ action('FrontendController@newArticle') }}" class="btn btn-filled"><i class="ti-plus"></i> New entry</a>
                            <hr class="mb8">
                            <p>StyleSensei is not just about getting style and fashion advice from experts, but it is a platform to allow all members to share their style experience with others. Style Blog is our very own blogging platform where users can make entries related to fashion, style, and overall image. If you think that you have some great styling tips to share, go ahead and write an article on Style Blog.</p>
                        </div>
                        <div class="col-md-12 no-padding">
                            @if (Session::has('flash_notification.article.message'))
                                <div class="alert alert-{{ Session::get('flash_notification.article.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ Session::get('flash_notification.article.message') }}
                                </div>
                            @endif
                        </div>

                            <ul class="tabs mb-0px">
                                <li id="published-section">
                                    <a href="#published">
                                        <div class="tab-title">
                                        <span>
                                            Published
                                            @if($published->total() > 0)
                                                (<span class="numbers">{{ $published->total() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($published->total() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th class="w23p">Title</th>
                                                    <th class="w11p">Image</th>
                                                    <th class="w23p">Excerpt</th>
                                                    <th class="w14p">Created</th>
                                                    <th class="w14p">Published</th>
                                                    <th class="w15p"></th>
                                                </tr>
                                                @foreach($published as $article)
                                                    <tr>
                                                        <td class="bold">{{ $article->title }}</td>
                                                        <td class="text-center"><img width="100" class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/100x100/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(60, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->published_at ? $article->published_at : 'NO'}}</td>
                                                        <td>
                                                            <a href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">View</a>
                                                            <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>You have no published blog entries yet.</p>
                                        @endif
                                        <div class="paginator">
                                            {{ $published->fragment('published')->links() }}
                                        </div>
                                    </div>
                                </li>

                                <li id="submitted-section">
                                    <a href="#submitted">
                                        <div class="tab-title">
                                        <span>
                                            Submitted
                                            @if($submitted->total()  > 0)
                                                (<span class="numbers">{{ $submitted->total() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($submitted->total() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th class="w23p">Title</th>
                                                    <th class="w11p">Image</th>
                                                    <th class="w23p">Excerpt</th>
                                                    <th class="w14p">Created</th>
                                                    <th class="w14p">Reviewed</th>
                                                    <th class="w15p"></th>
                                                </tr>
                                                @foreach($submitted as $article)
                                                    <tr>
                                                        <td class="bold">{{ $article->title }}</td>
                                                        <td class="text-center"><img width="100" class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/100x100/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(60, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->reviewed ? 'YES' : 'NO'}}</td>
                                                        <td>
                                                            <a href="{{ action('FrontendController@previewArticle', ['id' => $article->id]) }}">Preview</a>
                                                            <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>You have no submitted blog entries.</p>
                                        @endif
                                        <div class="paginator">
                                            {{ $submitted->fragment('submitted')->links() }}
                                        </div>
                                    </div>
                                </li>

                                <li id="drafts-section">
                                    <a href="#drafts">
                                        <div class="tab-title">
                                        <span>
                                            Drafts
                                            @if($drafts->total()  > 0)
                                                (<span class="numbers">{{ $drafts->total() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($drafts->total() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th class="w23p">Title</th>
                                                    <th class="w11p">Image</th>
                                                    <th class="w23p">Excerpt</th>
                                                    <th class="w14p">Created</th>
                                                    <th class="w14p">Comments</th>
                                                    <th class="w15p"></th>
                                                </tr>
                                                @foreach($drafts as $article)
                                                    <tr>
                                                        <td class="bold">{{ $article->title }}</td>
                                                        <td class="text-center"><img width="100" class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/100x100/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(60, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->disable_comments ? 'NO' : 'YES'}}</td>
                                                        <td>
                                                            <a href="{{ action('FrontendController@previewArticle', ['id' => $article->id]) }}">Submit</a>
                                                            <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>You have no blog entries drafts.</p>
                                        @endif
                                        <div class="paginator">
                                            {{ $drafts->fragment('drafts')->links() }}
                                        </div>
                                    </div>
                                </li>
                            </ul>

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