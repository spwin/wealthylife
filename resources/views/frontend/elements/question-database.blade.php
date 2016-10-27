<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'question-database' ? 'data-time-delay=10' : '' }}>
    <div class="login-header-back">
        <div class="login-header">
            <img src="{{ URL::to('/') }}/images/log-in-symbol.svg" alt="small logo">
            <h5 class="uppercase"><span class="ftw600">Your</span> question</h5>
            <p>Ask us about style</p>
        </div>
    </div>
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
    <div class="image-info-block mb8">
        <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
        <p>Maximum image size is <strong>10MB</strong>.</p>
    </div>

    {!! Form::hidden('cleared-image-1', 0, ['class' => 'cleared-image-1']) !!}
    <div class="image-upload ask left no-1 {{ $question->images->where('pivot.sort', 1)->first() ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $question->images->where('pivot.sort', 1)->first() ? '' : 'empty' }}" onclick="uploadImage(this,1);">
            <div class="question-image text-left">
                <img src="{{ $question->images->where('pivot.sort', 1)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 1)->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,1);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 1);">remove</a>
        </div>
        <div class="clear"></div>
    </div>

    {!! Form::hidden('cleared-image-2', 0, ['class' => 'cleared-image-2']) !!}
    <div class="image-upload ask no-2 {{ $question->images->where('pivot.sort', 2)->first() ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $question->images->where('pivot.sort', 2)->first() ? '' : 'empty' }}" onclick="uploadImage(this,2);">
            <div class="question-image text-left">
                <img src="{{ $question->images->where('pivot.sort', 2)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 2)->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,2);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 2);">remove</a>
        </div>
        <div class="clear"></div>
    </div>

    {!! Form::hidden('cleared-image-3', 0, ['class' => 'cleared-image-3']) !!}
    <div class="image-upload ask right no-3 {{ $question->images->where('pivot.sort', 3)->first() ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $question->images->where('pivot.sort', 3)->first() ? '' : 'empty' }}" onclick="uploadImage(this,3);">
            <div class="question-image text-left">
                <img src="{{ $question->images->where('pivot.sort', 3)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 3)->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,3);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 3);">remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="upload-button">
        {!! Form::file('image1', ['onChange' => 'readURL('.($question->images->where('pivot.sort', 1)->first() ? 'true' : 'false').', this, "'.( $question->images->where('pivot.sort', 1)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 1)->first()->filename : url()->to('/').'/images/avatars/no_image.png').'", 1)', 'class' => 'image-input-1']) !!}
        {!! Form::file('image2', ['onChange' => 'readURL('.($question->images->where('pivot.sort', 2)->first() ? 'true' : 'false').', this, "'.( $question->images->where('pivot.sort', 2)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 2)->first()->filename : url()->to('/').'/images/avatars/no_image.png').'", 2)', 'class' => 'image-input-2']) !!}
        {!! Form::file('image3', ['onChange' => 'readURL('.($question->images->where('pivot.sort', 3)->first() ? 'true' : 'false').', this, "'.( $question->images->where('pivot.sort', 3)->first() ? url()->to('/').'/photo/228x228/'.$question->images->where('pivot.sort', 3)->first()->filename : url()->to('/').'/images/avatars/no_image.png').'", 3)', 'class' => 'image-input-3']) !!}
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