<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'question-database' ? 'data-time-delay=10' : '' }}>
    <h3 class="uppercase">Edit question</h3>
    @if (count($errors->question_database) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->question_database->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open([
        'role' => 'form',
        'url' => action('UserController@updateQuestion', ['id' => $question->id, 'url' => Route::currentRouteAction()]),
        'files' => true,
        'class' => 'question-form2',
        'method' => 'POST'
    ]) !!}
    {!! Form::hidden('cleared-image', 0, ['class' => 'cleared-image']) !!}
    <div class="image-upload">
        <div class="drop-zone left {{ $question->image ? '' : 'empty' }}" onclick="uploadImage(this);">
            <div class="question-image text-left">
                <img src="{{ $question->image ? url()->to('/').'/photo/200x200/'.$question->image->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <div class="image-info-block">
                <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
                <p>Maximum image size is <strong>5MB</strong>.</p>
            </div>
            <a href="#" class="btn image-button upload" onclick="uploadImage(this);"><i class="ti-export"></i> select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}');"><i class="ti-trash"></i> remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="upload-button">
        {!! Form::file('image', ['onChange' => 'readURL('.($question->image ? 'true' : 'false').', this, "'.( $question->image ? url()->to('/').'/photo/200x200/'.$question->image->filename : url()->to('/').'/images/avatars/no_image.png').'")', 'class' => 'image-input']) !!}
    </div>
    <div class="textarea-holder">
        {!! Form::textarea('question', $question->question ? $question->question : null, ['class' => $errors->question_database->first('question', 'field-error ').'mt-1px', 'placeholder' => 'What would you like to ask?', 'onKeyPress' => 'countChar(this,event)', 'onKeyUp' => 'countChar(this,event)']) !!}
        <div class="charNum">
            @if(old())
                {{ old('question') ? 250 - strlen(old('question')) : 250 }}
            @else
                {{ $question->question ? 250 - strlen($question->question) : 250 }}
            @endif
        </div>
    </div>
    <div>
        <input type="submit" class="question-btn" value="Save">
    </div>
    {!! Form::close() !!}
</div>