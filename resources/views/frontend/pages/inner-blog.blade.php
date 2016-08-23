@extends('frontend/frame')
@section('nav-style', 'nav-blog')
@section('after-body-snippet')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=1646316419027352";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@stop
@section('content')
    <section>
        <div id="container">
            <div class="row">
                <div class="inner-article col-sm-6 col-sm-offset-3">
                    <div class="post-snippet mb24">
                        <div class="post-title">
                            <h5 class="uppercase mb16"><a class="normal" href="{{ url()->previous() }}"><i class="ti-arrow-left"></i> Back</a></h5>
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
                                    <span>{!! \App\Helpers\Helpers::hideEmail($article->user->email) !!}</span>
                                </li>
                            @endif
                        </ul>
                        <img src="{{ url()->to('/').'/blog/500x500/'.$article->image->filename }}"/>
                        {!! $article->content !!}
                    </div>
                    <!--end of post snippet-->
                    <div class="facebook-blog">
                        <div class="fb-like" data-href="{{ request()->fullUrl() }}" data-layout="standard" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
                    </div>
                    <hr>
                    @if(!$article->disable_comments)
                        <div class="disqus-comments" data-shortname="stylesensei">
                            <div id="disqus_thread"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop