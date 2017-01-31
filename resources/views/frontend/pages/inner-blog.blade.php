@extends('frontend/frame')
@section('page-title', $article->title)
@section('meta-description', $description)
@section('head-parameters', 'prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#"')
@section('meta-content')
    <meta property="og:type"   content="article" />
    <meta property="og:image" content="{{ url()->to('/').$article->image->path.$article->image->filename }}" />
    <meta property="og:url" content="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}" />
    <meta property="og:title" content="{{ $article->title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_APP_ID') }}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@StyleSenseiUK">
    <meta name="twitter:title" content="{{ $article->title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url()->to('/').$article->image->path.$article->image->filename }}">
@stop
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

    <section class="page-title page-title-4 image-bg parallax">
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Blog</h1>
                    <h2 class="lead mb0 below"><span class="color-green-prof">Fashion inspiration</span> for people by people</h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <section class="section-blog inner-blog">
        <div class="arrow-style mob-left-to-right">

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

            <div id="container" class="container about-block">
                <div class="row">
                    <div itemscope itemtype="http://schema.org/Article" class="inner-article container margin0auto nofloat">
                        <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                        <div class="post-snippet mb24">
                            <div class="post-title">
                                <h5 class="uppercase mb16 inner-blog"><a class="normal" href="{{ url()->previous() }}"><i class="ti-arrow-left"></i> Back</a></h5>
                                <meta itemprop="headline" content="{{ $article->title }}">
                                <h4 itemprop="name" class="inline-block">{{ $article->title }}</h4>
                            </div>
                            <ul class="post-meta">
                                <li>
                                    <i class="ti-calendar"></i>
                                    <span itemprop="datePublished" content="{{ date('Y-m-d H:i:s', strtotime($article->published_at)) }}" class="number">{{ date('d M, Y', strtotime($article->created_at)) }}</span>
                                </li>
                                @if($article->user)
                                    @if(!$article->hide_name)
                                        <div itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                                            <meta itemprop="name" content="{{ $article->user->userData->first_name.' '.$article->user->userData->last_name }}">
                                        </div>
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
                                @endif
                                <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                                    <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                        <meta itemprop="url" content="{{ URL::to('/') }}/images/logo-meta.png">
                                        <meta itemprop="width" content="225">
                                        <meta itemprop="height" content="225">
                                    </div>
                                    <meta itemprop="name" content="{{ env('APP_META_NAME') }}">
                                </div>
                            </ul>
                            <a rel="lightbox[gallery]" href="{{ url()->to('/').$article->image->path.$article->image->filename }}" data-lightbox="image-{{ $article->image->id }}" data-title="{{ $article->title }}">
                                <div itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                    @if($article->user->type == 'user')
                                        <img class="featured-image" itemprop="image" alt="{{ $article->title }}" src="{{ url()->to('/').'/blog/500x500/'.$article->image->filename }}"/>
                                    @elseif($article->user->type == 'consultant')
                                        <img class="featured-image" itemprop="image" alt="{{ $article->title }}" src="{{ url()->to('/').'/consultant-blog/500x500/'.$article->image->filename.'?path='.rawurlencode($article->image->path) }}"/>
                                    @endif
                                </div>
                            </a>
                            {!! $article->content !!}
                        </div>
                        <!--end of post snippet-->
                        <div class="clear"></div>
                        <div class="facebook-blog">
                            <div class="fb-like" data-href="{{ request()->fullUrl() }}" data-layout="standard" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
                        </div>
                        <hr>
                        @if(!$article->disable_comments)
                            <div class="fb-comments" data-href="{{ request()->fullUrl() }}" data-numposts="5" data-width="100%"></div>
                            {{--
                            <div class="disqus-comments" data-shortname="stylesensei">
                                <div id="disqus_thread"></div>
                            </div>
                            --}}
                        @endif
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
    $('.inner-article img:not(.featured-image)').wrap(function(index) {
        return '<a href="'+$(this).attr('src')+'" data-lightbox="image-'+index+'" rel="lightbox[gallery]"></a>';
    });
</script>
@endpush