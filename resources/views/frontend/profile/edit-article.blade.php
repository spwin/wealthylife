@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9 no-padding">
                    <div class="tabbed-content text-tabs edit-article display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div>
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@articles', [$article->status == 0 ? '#drafts' : ($article->status == 3 ? '#published' : '#submitted')]) }}"><i class="ti-arrow-left"></i> To list</a></h4>
                        <h4 class="uppercase mb16">Edit My Blog entry</h4>
                        <div class="col-md-12">
                            @if (Session::has('flash_notification.article.message'))
                                <div class="alert alert-{{ Session::get('flash_notification.article.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ Session::get('flash_notification.article.message') }}
                                </div>
                            @endif
                            @if (count($errors->article) > 0)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->article->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-10">
                                {!! Form::model($article, [
                                    'role' => 'form',
                                    'url' => action('UserController@saveArticle', ['id' => $article->id]),
                                    'files' => true,
                                    'method' => 'POST',
                                    'class' => 'create-article'
                                ]) !!}

                                <div class="feature feature-3 feature-4 bordered">
                                    <div class="left">
                                        <i class="ti-announcement icon-lg warning"></i>
                                    </div>
                                    <div class="right">
                                        <h5 class="uppercase mb16">Review will be required</h5>
                                        <p>
                                            Keep in mind Your blog entry needs to be reviewed again before publishing once you will make changes.
                                        </p>
                                    </div>
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="uppercase"><span class="text-red">*</span> Title:</h5>
                                    {!! Form::text('title', null, ['class' => $errors->general->first('title', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'Title']) !!}
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="uppercase"><span class="text-red">*</span> Image:</h5>
                                    <div class="image-upload">
                                        <div class="drop-article-zone left" onclick="uploadSingleImage(this);">
                                            <div class="article-image text-left">
                                                <img src="{{ url()->to('/').'/blog/500x500/'.$article->image()->first()->filename }}" class="image-article-preview">
                                            </div>
                                        </div>
                                        <div class="image-actions right">
                                            <div class="image-info-block">
                                                <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
                                                <p>Maximum image size is <strong>10MB</strong>.</p>
                                            </div>
                                            <a href="#" class="btn image-button upload" onclick="uploadSingleImage(this);"><i class="ti-export"></i> select</a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="upload-button">
                                        {!! Form::file('image', ['onChange' => 'readArticleURL(true, this, "'.url()->to('/').'/blog/500x500/'.$article->image()->first()->filename.'")', 'class' => 'image-input']) !!}
                                    </div>
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="weight uppercase"><span class="text-red">*</span> Content</h5>
                                    <p class="label_description">Try to not exceed 5000 words.</p>
                                    {!! Form::textarea('content', null, ['size' => '30x5', 'placeholder' => 'Create something amazing..', 'id' => 'wysiwyg']) !!}
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="mb-0px mr-15px uppercase">Hide name</h5>
                                    <p class="label_description">Choose if you do not want your name to be displayed on the article page.</p>
                                    <div class="checkbox-option pull-left {{ $article->hide_name ? 'checked' : '' }}">
                                        <div class="inner"></div>
                                        {!! Form::checkbox('hide_name', 1, false) !!}
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="mb-0px mr-15px uppercase">Hide email</h5>
                                    <p class="label_description">Choose if you do not want to display your email to the public.</p>
                                    <div class="checkbox-option pull-left {{ $article->hide_email ? 'checked' : '' }}">
                                        <div class="inner"></div>
                                        {!! Form::checkbox('hide_email', 1, false) !!}
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="input-with-label text-left">
                                    <h5 class="mb-0px mr-15px uppercase">Disable comments</h5>
                                    <p class="label_description">Comments will be disabled on your blog entry if checked.</p>
                                    <div class="checkbox-option pull-left {{ $article->disable_comments ? 'checked' : '' }}">
                                        <div class="inner"></div>
                                        {!! Form::checkbox('disable_comments', 1, false) !!}
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="pull-right">
                                    <input type="submit" class="btn profile-button" value="Save and Preview">
                                </div>
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
@push('scripts')
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#wysiwyg',
        content_css : "/css/tinymce.css",
        menubar: false,
        height : "260",
        plugins: [
            'advlist autolink lists image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample'
        ]
    });
</script>
@endpush