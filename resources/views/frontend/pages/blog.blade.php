@extends('frontend/frame')
@section('nav-style', 'nav-blog')
@section('content')
    <section class="bg-secondary">
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
                            <hr>
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
    </section>
    @include('frontend/footer')
@stop