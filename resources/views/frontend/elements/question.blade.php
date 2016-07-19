<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'question' ? 'data-time-delay=10' : '' }}>
    <h3 class="uppercase">Your question</h3>
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
    <div class="image-upload">
        <div class="drop-zone left {{ session()->has('question.image') ? '' : 'empty' }}" onclick="uploadImage(this);">
            <div class="question-image text-left">
                <img src="{{ session()->has('question.image') ? url()->to('/').'/uploads/session/temp/'.session()->get('question.image') : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <div class="image-info-block">
                <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
                <p>Maximum image size is <strong>5MB</strong>.</p>
            </div>
            <a href="#" class="btn image-button upload" onclick="uploadImage(this);"><i class="ti-export"></i> select</a>
            <a href="#" class="btn image-button remove" onclick="clearImage('question-form1', event, '{{ action('UserController@clearImage') }}', '{{ csrf_token() }}', '{{ url()->to('/').'/images/avatars/no_image.png' }}');"><i class="ti-trash"></i> remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="upload-button">
        {!! Form::file('image', ['onChange' => 'readURL('.(session()->has('question.image') ? 'true' : 'false').', this, "'.( session()->has('question.image') ? url()->to('/').'/images/session/temp/'.session()->get('question.image') : url()->to('/').'/images/avatars/no_image.png').'")', 'class' => 'image-input']) !!}
    </div>
    <div class="textarea-holder">
        {!! Form::textarea('question', session()->has('question.content') ? session()->get('question.content') : null, ['class' => $errors->question->first('question', 'field-error ').'mt-1px', 'placeholder' => 'What would you like to ask?', 'onKeyPress' => 'countChar(this,event)', 'onKeyUp' => 'countChar(this,event)']) !!}
        <div class="charNum">
            {{ session()->has('question.content') ? 250 - strlen(session()->get('question.content')) : 250 }}
        </div>
    </div>
    <div class="double-column">
        <a href="#" class="btn question-btn" onclick="clearForm('question-form1', event, '{{ action('UserController@clearQuestion') }}', '{{ csrf_token() }}', '{{ url()->to('/').'/images/avatars/no_image.png' }}');">Clear</a>
        <input type="submit" class="question-btn" value="Confirm">
    </div>
    {!! Form::close() !!}
</div>