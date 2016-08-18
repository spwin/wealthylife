@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9 no-padding">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@articles', ['#drafts']) }}"><i class="ti-arrow-left"></i> Back</a></h4>
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
                        <div class="col-md-12">
                            {{ dump($article) }}
                        </div>
                        <div class="col-md-12">
                            <div class="pull-left">
                                <a href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}" class="btn hovered">Edit</a>
                            </div>
                            <div class="pull-right">
                                {!! Form::open([
                                    'role' => 'form',
                                    'url' => action('UserController@submitArticle', ['id' => $article->id]),
                                    'method' => 'POST',
                                    'class' => 'confirm-article'
                                ]) !!}
                                <input type="submit" class="btn profile-button" value="Submit for review">
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop