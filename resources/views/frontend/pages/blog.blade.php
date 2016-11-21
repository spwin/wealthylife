@extends('frontend/frame')
@section('page-title', trans('seo.blog.title'))
@section('meta-description', trans('seo.blog.description'))
@section('nav-style', 'nav-blog')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/about-bg.jpg" /-->
        </div>
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

    <section class="section-blog">

        <div class="arrow-style mob-left-to-right">

        <div class="container">
            <div class="row masonry-loader">
                <div class="col-sm-12 text-center">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="row masonry masonryFlyIn mb40">
                @foreach($articles as $article)
                    <div class="col-sm-4 post-snippet masonry-item">
                        <div class="text-center blog-block-image">
                            <a href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                                <img alt="{{ $article->title }}" src="{{ url()->to('/').'/blog-masonry/360/'.$article->image->filename }}" />
                            </a>
                        </div>
                        <div class="inner">
                            <a href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">
                                <h5 class="mb0">{{ $article->title }}</h5>
                                <span class="inline-block mb16">{{ date('M d, Y', strtotime($article->published_at)) }}</span>
                            </a>
                            <hr class="mac-line">
                            <p>
                                {{ \App\Helpers\Helpers::getExcerpt(200, strip_tags($article->content)) }}
                            </p>
                            <a class="btn btn-sm btn-filled" href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">Read More</a>
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