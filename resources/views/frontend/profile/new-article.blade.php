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
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@articles') }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        <h4 class="uppercase mb16">Create blog entry</h4>
                        <div class="col-md-12">
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                            </p>
                        </div>
                        <div class="col-md-12">
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
                        <div class="col-md-9">
                            {!! Form::open([
                                'role' => 'form',
                                'url' => action('UserController@createArticle'),
                                'files' => true,
                                'method' => 'POST',
                                'class' => 'create-article'
                            ]) !!}

                            <div class="input-with-label text-left">
                                <h5 class="uppercase"><span class="text-red">*</span> Title:</h5>
                                {!! Form::text('title', null, ['class' => $errors->general->first('title', 'field-error ').'mt-1px less-profile-input-margin', 'placeholder' => 'Title']) !!}
                            </div>

                            <div class="input-with-label text-left">
                                <h5 class="uppercase"><span class="text-red">*</span> Image:</h5>
                                <div class="image-upload">
                                    <div class="drop-article-zone left {{ session()->has('question.image') ? '' : 'empty' }}" onclick="uploadImage(this);">
                                        <div class="article-image text-left">
                                            <img src="{{ url()->to('/').'/images/avatars/no_image.png' }}" class="image-article-preview">
                                        </div>
                                    </div>
                                    <div class="image-actions right">
                                        <div class="image-info-block">
                                            <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
                                            <p>Maximum image size is <strong>5MB</strong>.</p>
                                        </div>
                                        <a href="#" class="btn image-button upload" onclick="uploadImage(this);"><i class="ti-export"></i> select</a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="upload-button">
                                    {!! Form::file('image', ['onChange' => 'readArticleURL(false, this, "'.url()->to('/').'/images/avatars/no_image.png'.'")', 'class' => 'image-input']) !!}
                                </div>
                            </div>

                            <div class="input-with-label text-left">
                                <h5 class="weight uppercase"><span class="text-red">*</span> Content</h5>
                                <p class="label_description">Try to not exceed 500 words.</p>
                                {!! Form::textarea('content', null, ['size' => '30x5', 'placeholder' => 'Create something amazing..', 'id' => 'wysiwyg']) !!}
                            </div>

                            <div class="input-with-label text-left">
                                <h5 class="mb-0px mr-15px uppercase">Hide name</h5>
                                <p class="label_description">Choose if you do not want your name to be displayed on the article page.</p>
                                <div class="checkbox-option pull-left {{ old('hide_name') ? 'checked' : '' }}">
                                    <div class="inner"></div>
                                    {!! Form::checkbox('hide_name', 1, false) !!}
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-with-label text-left">
                                <h5 class="mb-0px mr-15px uppercase">Hide email</h5>
                                <p class="label_description">Choose if you do not want to display your email to the public.</p>
                                <div class="checkbox-option pull-left {{ old('hide_email') ? 'checked' : '' }}">
                                    <div class="inner"></div>
                                    {!! Form::checkbox('hide_email', 1, false) !!}
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-with-label text-left">
                                <h5 class="mb-0px mr-15px uppercase">Disable comments</h5>
                                <p class="label_description">Comments will be disabled on your blog entry if checked.</p>
                                <div class="checkbox-option pull-left {{ old('disable_comments') ? 'checked' : '' }}">
                                    <div class="inner"></div>
                                    {!! Form::checkbox('disable_comments', 1, false) !!}
                                </div>
                                <div class="clear"></div>
                            </div>

                            <input type="submit" class="btn profile-button" value="Continue">

                            {!! Form::close() !!}
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
        menubar:false,
        height : "260"
    });
</script>
@endpush