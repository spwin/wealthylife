@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9 no-padding articles-list">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
                        <h4 class="uppercase mb16">My Blog entries</h4>
                        <div class="col-md-12 no-padding">
                            <h5>Got a great style tip to share with others? This is the platform to do so!</h5>
                            <a href="{{ action('FrontendController@newArticle') }}" class="btn btn-filled"><i class="ti-plus"></i> New entry</a>
                            <p>Stylesensei is not just about getting style and fashion advice from experts, but it is a platform to allow all members to share their style experience with others. Style Blog is our very own blogging platform where users can make entries related to fashion, style, and overall image. If you think that you have some great styling tips to share, go ahead and write an article on Style Blog.</p>
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
    </section>
    @include('frontend/footer')
@stop