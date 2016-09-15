@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9 no-padding">
                    <div class="inner-article tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
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

                        <div class="col-md-12">
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
                                    <input type="submit" class="btn profile-button" value="Submit for review">
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
    </section>
    @include('frontend/footer')
@stop