<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'question' ? 'data-time-delay=10' : '' }}>
    <div class="login-header-back">
        <div class="login-header">
            <img src="{{ URL::to('/') }}/images/log-in-symbol.svg" alt="small logo">
            <h5 class="uppercase"><span class="ftw600">Your</span> question</h5>
            <p>Ask us about style</p>
        </div>
    </div>
    @if (count($errors->question) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->question->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open([
        'role' => 'form',
        'url' => action('UserController@questionCreate', ['modal' => 'question', 'url' => Route::currentRouteAction() ]),
        'files' => true,
        'class' => 'question-form1 universal-question-form',
        'method' => 'POST'
    ]) !!}
    <div class="upload-button"></div>
    <div class="textarea-holder ask-quest">
        {!! Form::textarea('question', session()->has('question.content') ? session()->get('question.content') : null, ['class' => $errors->question->first('question', 'field-error ').'mt-1px', 'placeholder' => 'What would you like to ask?', 'onKeyPress' => 'countChar(this,event)', 'onKeyUp' => 'countChar(this,event)']) !!}
        <div class="charNum">
            @if(old())
                {{ old('question') ? 250 - strlen(old('question')) : 250 }}
            @else
                {{ session()->has('question.content') ? 250 - strlen(session()->get('question.content')) : 250 }}
            @endif
        </div>
    </div>
    <div class="margin20-0">
        <a href="#" class="uppercase clear-form mob">Clear form</a>
    </div>
    <p class="uppercase text-left add3photos bold700 mt16">Add up to <span class="color-blue-prof">3 photos</span></p>
    <div id="mob-image-template" class="hidden">
        <div class="image-wrapper">
            <hr>
            <a href="#" class="btn image-button remove">remove</a>
            <div class="image-upload mobile">
                <div class="drop-zone left empty">
                    <div class="question-image text-left">
                        <img src="#" class="image-preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mob-images-container"></div>
    <div class="upload-button-container">
        <hr>
    </div>
    <hr>
    <div class="image-info-block mb24">
        <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
        <p>Maximum image size is <strong>10MB</strong>.</p>
    </div>
    <hr>
    <div class="check-answer-time mb24">
        <p class="no-margin text-left">Expected answer time:</p>
        <p class="no-margin mob display-inlineblock left uppercase bold700 text-left check-time-button" onclick="checkAnswerTime(event, this, '{{ csrf_token() }}', '{{ action('FrontendController@ajaxCheckAnswerTime') }}')">check now</p>
        <p class="no-margin uppercase bold700 text-left answer-time-result"></p>
        <div class="clearboth"></div>
    </div>
    <hr>
        <input type="submit" class="question-btn" value="Confirm">
    {!! Form::close() !!}
</div>
@push('scripts')
<script>
    ($)(function() {
        var images = [
            new ImageItem(1, '{!! session()->has('question.image1') ? url()->to('/').'/temp/228x228/'.session()->get('question.image1') : url()->to('/').'/images/avatars/no_image.png' !!}', {{ session()->has('question.image1') ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ url()->to('/').'/images/avatars/no_image.png' }}'),
            new ImageItem(2, '{!! session()->has('question.image2') ? url()->to('/').'/temp/228x228/'.session()->get('question.image2') : url()->to('/').'/images/avatars/no_image.png' !!}', {{ session()->has('question.image2') ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ url()->to('/').'/images/avatars/no_image.png' }}'),
            new ImageItem(3, '{!! session()->has('question.image3') ? url()->to('/').'/temp/228x228/'.session()->get('question.image3') : url()->to('/').'/images/avatars/no_image.png' !!}', {{ session()->has('question.image3') ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ url()->to('/').'/images/avatars/no_image.png' }}')
        ];
        initializeQuestionPopup(images, '{{ csrf_token() }}', '{{ action('UserController@clearImage') }}', '{{ action('UserController@clearQuestion') }}');
    });
</script>
@endpush