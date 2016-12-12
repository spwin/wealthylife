@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')


    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover16.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Create <span class="color-blue-prof">entry</span></h1>
                    <h2 class="lead mb0 below">Let the <span class="color-blue-prof">style</span> begin</h2>
                </div>
            </div>
            <!--end of row-->
            <div class="toggle-button profile-menu-but bold700 visible990">
                <span class="display-inlineblock">PROFILE MENU</span>
            </div>
        </div>
        <!--end of container-->
    </section>


    <section>

        <div class="arrow-style index3 mob-right-to-left">
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

        <div class="container create-entry">

            <div class="row">
                @if(\App\Helpers\Helpers::isMobile())
                    @include('mobile/frontend/profile/user-menu')
                @else
                    @include('frontend/profile/user-menu')
                @endif

                <div class="col-md-9 no-padding">

                    <div class="tabbed-content text-tabs display-after-load">
                        <!--div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            <div class="hidden">
                                @include('frontend/elements/question')
                            </div>
                        </div-->
                        <h4 class="uppercase mb16"><a class="normal" href="{{ action('FrontendController@articles') }}"><i class="ti-arrow-left"></i> Back</a></h4>
                        <h4 class="uppercase mb16">Create blog entry</h4>
                        <div class="col-md-12">
                            <h4>Dos and Don’ts of Posting on Style Blog</h4>
                            <p>
                                We are pleased to offer a social platform for all our users who are into style and fashion. However, in order to post entries on Style Blog, you must remember the following instructions:
                                <ul>
                                    <li>- Use public appropriate language and photos in blogs.</li>
                                    <li>- Do not use photos of others.</li>
                                    <li>- Refrain from abusive language or content.</li>
                                    <li>- Do not add negative, discriminating, and racist comments in your entry.</li>
                                    <li>- Be nice to those you address.</li>
                                    <li>- All entries must belong to the subject of fashion, style, and image.</li>
                                    <li>- No entry with advertising or marketing messages will be entertained or published on our Style Blog.</li>
                                </ul>
                                Every blog entry that you make is first screened and checked by our team and if they find any of the above issues in your entries, your entry will not be accepted.
                                We are positive that you will note down our blog writing criteria and submit your entries accordingly. We highly welcome any kind of fun stuff that is related to fashion on Style Blog. So, get started by filling out this form.
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
                        <div class="col-md-10">
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
                                    <div class="drop-article-zone left {{ session()->has('question.image') ? '' : 'empty' }}" onclick="uploadSingleImage(this);">
                                        <div class="article-image text-left">
                                            <img src="{{ url()->to('/').'/images/avatars/no_image.png' }}" class="image-article-preview">
                                        </div>
                                    </div>
                                    <div class="image-actions right">
                                        <div class="image-info-block">
                                            <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
                                            <p>Maximum image size is <strong>10MB</strong>.</p>
                                        </div>
                                        <a href="#" class="btn image-button upload left" onclick="uploadSingleImage(this);"><i class="ti-export"></i> select</a>
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

                            <h5>Share your fashion secrets with others on our fun and entertaining blogging platform!</h5>

                            <input type="submit" class="btn profile-button" value="Continue">

                            {!! Form::close() !!}
                        </div>
                    </div>
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
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#wysiwyg',
        content_css : "/css/tinymce.css",
        menubar:false,
        height : "260",
        plugins: [
            'advlist autolink lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern'
        ]
    });
</script>
@endpush