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
        'class' => 'question-form1',
        'method' => 'POST'
    ]) !!}
    <div class="upload-button">
        {!! Form::file('image1', ['onChange' => 'readURL('.(session()->has('question.image1') ? 'true' : 'false').', this, "'.( session()->has('question.image1') ? url()->to('/').'/temp/228x228/'.session()->get('question.image1') : url()->to('/').'/images/avatars/no_image.png').'", 1)', 'class' => 'image-input-1']) !!}
        {!! Form::file('image2', ['onChange' => 'readURL('.(session()->has('question.image2') ? 'true' : 'false').', this, "'.( session()->has('question.image2') ? url()->to('/').'/temp/228x228/'.session()->get('question.image2') : url()->to('/').'/images/avatars/no_image.png').'", 2)', 'class' => 'image-input-2']) !!}
        {!! Form::file('image3', ['onChange' => 'readURL('.(session()->has('question.image3') ? 'true' : 'false').', this, "'.( session()->has('question.image3') ? url()->to('/').'/temp/228x228/'.session()->get('question.image3') : url()->to('/').'/images/avatars/no_image.png').'", 3)', 'class' => 'image-input-3']) !!}
    </div>
    <div class="textarea-holder ask-quest">
        {!! Form::textarea('question', session()->has('question.content') ? session()->get('question.content') : null, ['class' => $errors->question->first('question', 'field-error ').'mt-1px', 'placeholder' => 'What would you like to ask?', 'onKeyPress' => 'countChar(this,event)', 'onKeyUp' => 'countChar(this,event)']) !!}
        <div class="charNum">
            {{ session()->has('question.content') ? 250 - strlen(session()->get('question.content')) : 250 }}
        </div>
    </div>
    <div class="margin20-0">
        <a href="#" class="uppercase clear-form mob" onclick="clearForm('question-form1', event, '{{ action('UserController@clearQuestion') }}', '{{ csrf_token() }}', '');">Clear form</a>
    </div>
    <p class="uppercase text-left add3photos bold700 mt16">Add up to <span class="color-blue-prof">3 photos</span></p>
    <hr>
    <a href="#" class="btn image-button remove" onclick="clearImage('question-form1', event, '{{ action('UserController@clearImage') }}', '{{ csrf_token() }}', '#', 1);">remove</a>
    <div class="image-upload mobile no-1 {{ session()->has('question.image1') ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ session()->has('question.image1') ? '' : 'empty' }}" onclick="uploadImage(this, 1);">
            <div class="question-image text-left">
                <img src="{{ session()->has('question.image1') ? url()->to('/').'/temp/228x228/'.session()->get('question.image1') : '#' }}" class="image-preview">
            </div>
        </div>
    </div>
    <hr>
    <a href="#" class="btn image-button upload" onclick="uploadImage(this, 1);">add photo</a>
    <!--div class="image-upload mobile no-1 {{ session()->has('question.image1') ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ session()->has('question.image1') ? '' : 'empty' }}" onclick="uploadImage(this, 1);">
            <div class="question-image text-left">
                <img src="{{ session()->has('question.image1') ? url()->to('/').'/temp/228x228/'.session()->get('question.image1') : '#' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this, 1);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearImage('question-form1', event, '{{ action('UserController@clearImage') }}', '{{ csrf_token() }}', '#', 1);">remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="image-upload mobile no-2 {{ session()->has('question.image2') ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ session()->has('question.image2') ? '' : 'empty' }}" onclick="uploadImage(this, 2);">
            <div class="question-image text-left">
                <img src="{{ session()->has('question.image2') ? url()->to('/').'/temp/228x228/'.session()->get('question.image2') : '#' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right {{ session()->has('question.image2') ? 'remove-button-enabled' : '' }}">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this, 2);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearImage('question-form1', event, '{{ action('UserController@clearImage') }}', '{{ csrf_token() }}', '#', 2);">remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="image-upload mobile no-3 {{ session()->has('question.image3') ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ session()->has('question.image3') ? '' : 'empty' }}" onclick="uploadImage(this, 3);">
            <div class="question-image text-left">
                <img src="{{ session()->has('question.image3') ? url()->to('/').'/temp/228x228/'.session()->get('question.image3') : '#' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this, 3);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearImage('question-form1', event, '{{ action('UserController@clearImage') }}', '{{ csrf_token() }}', '#', 3);">remove</a>
        </div>
        <div class="clear"></div>
    </div-->
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