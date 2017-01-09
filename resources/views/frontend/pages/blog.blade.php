@extends('frontend/frame')
@section('page-title', trans('seo.blog.title'))
@section('meta-description', trans('seo.blog.description'))
@section('nav-style', 'nav-blog')
@section('meta-content')
    <meta property="og:type"   content="website" />
    <meta property="og:image" content="{{ url()->to('/').'/images/logo-image.png' }}" />
    <meta property="og:url" content="{{ action('FrontendController@blog') }}" />
    <meta property="og:title" content="StyleSensei Blog" />
    <meta property="og:description" content="Style Blog is a platform where users can make entries related to fashion, style, and overall image. If you think that you have some great styling tips to share, go ahead and write an article on Style Blog." />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_APP_ID') }}" />
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

    <section class="section-blog outer-blog">

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

        <div class="container">

            <div class="text-center blog-button-txt mb24">
                @if(App\Helpers\Helpers::checkAccess())
                    <p class="mb16">Tell us your <span class="color-blue-prof bold700">style story!</span></p>
                    <a class="btn text-left btn-filled blue-button" href="{{ action('FrontendController@newArticle') }}"><i class="ti-plus bold700"></i><span class="display-inlineblock">Add entry</span></a>
                @else
                    <p class="mb16">From <span class="color-blue-prof bold700">9th of January 2017</span></p>
                    <p class="mb16">You can also share your <span class="color-blue-prof bold700">StyleStory</span></p>
                @endif
            </div>

            <div class="row masonry-loader">
                <div class="col-sm-12 text-center">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="row masonry masonryFlyIn mb40">
                @foreach($articles as $article)
                    <div class="col-sm-4 post-snippet masonry-item">
                        <div itemscope itemtype="http://schema.org/Article">
                            <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                            <div class="text-center blog-block-image">
                                <a href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                                    <div itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                        @if($article->user->type == 'user')
                                            <img itemprop="image" alt="{{ $article->title }}" src="{{ url()->to('/').'/blog-masonry/360/'.$article->image->filename }}" />
                                            <meta itemprop="url" content="{{ url()->to('/').'/blog-masonry/360/'.$article->image->filename }}">
                                        @elseif($article->user->type == 'consultant')
                                            <img itemprop="image" alt="{{ $article->title }}" src="{{ url()->to('/').'/blog-masonry-consultant/360/'.$article->image->filename.'?path='.rawurlencode($article->image->path) }}" />
                                            <meta itemprop="url" content="{{ url()->to('/').'/blog-masonry-consultant/360/'.$article->image->filename.'?path='.rawurlencode($article->image->path) }}">
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="inner">
                                <a href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                                    <meta itemprop="headline" content="{{ $article->title }}">
                                    <h5 itemprop="name" class="mb0">{{ $article->title }}</h5>
                                    <span itemprop="datePublished" content="{{ date('Y-m-d H:i:s', strtotime($article->published_at)) }}" class="inline-block mb16">{{ date('M d, Y', strtotime($article->published_at)) }}</span>
                                </a>
                                @if($article->user)
                                    @if(!$article->hide_name)
                                        <div itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                                            <meta itemprop="name" content="{{ $article->user->userData->first_name.' '.$article->user->userData->last_name }}">
                                        </div>
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
                                <hr class="mac-line">
                                <p>
                                    {{ \App\Helpers\Helpers::getExcerpt(200, strip_tags($article->content)) }}
                                </p>
                                <a class="btn btn-sm btn-filled" href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="text-center">
                    {{ $articles->links() }}
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