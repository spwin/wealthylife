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
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16">My Blog entries</h4>
                        <div class="col-md-12 no-padding">
                            <a href="{{ action('FrontendController@newArticle') }}" class="btn btn-filled"><i class="ti-plus"></i> New entry</a>
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
                                            @if($user->articles() && $user->articles()->where(['status' => 3])->count() > 0)
                                                (<span class="numbers">{{ $user->articles()->where(['status' => 3])->count() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($user->articles() && $user->articles()->where(['status' => 3])->count() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Excerpt</th>
                                                    <th>Created</th>
                                                    <th>Published</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($user->articles()->where(['status' => 3])->get() as $article)
                                                    <tr>
                                                        <td>{{ $article->title }}</td>
                                                        <td><img width="100" src="{{ $article->image()->first() ? url()->to('/').'/blog/100x100/'.$article->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(100, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->published_at ? $article->published_at : 'NO'}}</td>
                                                        <td>
                                                            <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>You have no published blog entries yet.</p>
                                        @endif
                                    </div>
                                </li>

                                <li id="submitted-section">
                                    <a href="#submitted">
                                        <div class="tab-title">
                                        <span>
                                            Submitted
                                            @if($user->articles() && $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() > 0)
                                                (<span class="numbers">{{ $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($user->articles() && $user->articles()->where(['status' => 1])->orWhere(['status' => 2])->count() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Excerpt</th>
                                                    <th>Created</th>
                                                    <th>Published</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($user->articles()->where(['status' => 1])->orWhere(['status' => 2])->get() as $article)
                                                    <tr>
                                                        <td>{{ $article->title }}</td>
                                                        <td><img width="100" src="{{ $article->image()->first() ? url()->to('/').'/blog/100x100/'.$article->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(100, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->published_at ? $article->published_at : 'NO'}}</td>
                                                        <td>
                                                            <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p>You have no submitted blog entries.</p>
                                        @endif
                                    </div>
                                </li>

                                <li id="drafts-section">
                                    <a href="#drafts">
                                        <div class="tab-title">
                                        <span>
                                            Drafts
                                            @if($user->articles() && $user->articles()->where(['status' => 0])->count() > 0)
                                                (<span class="numbers">{{ $user->articles()->where(['status' => 0])->count() }}</span>)
                                            @endif
                                        </span>
                                        </div>
                                    </a>
                                    <div class="tab-content">
                                        @if($user->articles() && $user->articles()->where(['status' => 0])->count() > 0)
                                            <table class="table">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Excerpt</th>
                                                    <th>Created</th>
                                                    <th>Published</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($user->articles()->where(['status' => 0])->get() as $article)
                                                    <tr>
                                                        <td>{{ $article->title }}</td>
                                                        <td><img width="100" src="{{ $article->image()->first() ? url()->to('/').'/blog/100x100/'.$article->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}"></td>
                                                        <td>{{ \App\Helpers\Helpers::getExcerpt(100, strip_tags($article->content)) }}</td>
                                                        <td>{{ $article->created_at }}</td>
                                                        <td>{{ $article->published_at ? $article->published_at : 'NO'}}</td>
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