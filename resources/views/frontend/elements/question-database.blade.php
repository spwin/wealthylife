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
        'class' => 'question-form2 universal-question-form',
        'method' => 'POST'
    ]) !!}
    <div class="image-info-block mb8">
        <p>Please upload only <strong>jpeg, png</strong> or <strong>gif</strong> files.</p>
        <p>Maximum image size is <strong>10MB</strong>.</p>
    </div>

    {!! Form::hidden('cleared-image-1', 0, ['class' => 'cleared-image-1']) !!}
    @php($image1 = $question->images->filter(function($item) { return ($item->pivot->sort == 1);})->first())
    <div class="image-upload ask left no-1 {{ $image1 ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $image1 ? '' : 'empty' }}" onclick="uploadImage(this,1);">
            <div class="question-image text-left">
                <img src="{{ $image1 ? url()->to('/').'/photo/228x228/'.$image1->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,1);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 1);">remove</a>
        </div>
        <div class="clear"></div>
    </div>

    {!! Form::hidden('cleared-image-2', 0, ['class' => 'cleared-image-2']) !!}
    @php($image2 = $question->images->filter(function($item) { return ($item->pivot->sort == 2);})->first())
    <div class="image-upload ask no-2 {{ $image2 ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $image2 ? '' : 'empty' }}" onclick="uploadImage(this,2);">
            <div class="question-image text-left">
                <img src="{{ $image2 ? url()->to('/').'/photo/228x228/'.$image2->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,2);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 2);">remove</a>
        </div>
        <div class="clear"></div>
    </div>

    {!! Form::hidden('cleared-image-3', 0, ['class' => 'cleared-image-3']) !!}
    @php($image3 = $question->images->filter(function($item) { return ($item->pivot->sort == 3);})->first())
    <div class="image-upload ask right no-3 {{ $image3 ? 'remove-button-enabled' : '' }}">
        <div class="drop-zone left {{ $image3 ? '' : 'empty' }}" onclick="uploadImage(this,3);">
            <div class="question-image text-left">
                <img src="{{ $image3 ? url()->to('/').'/photo/228x228/'.$image3->filename : url()->to('/').'/images/avatars/no_image.png' }}" class="image-preview">
            </div>
        </div>
        <div class="image-actions right">
            <a href="#" class="btn image-button upload" onclick="uploadImage(this,3);">select</a>
            <a href="#" class="btn image-button remove" onclick="clearEditedImage('question-form2', event, '{{ url()->to('/').'/images/avatars/no_image.png' }}', 3);">remove</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="upload-button ask-quest">
        {!! Form::file('image1', ['onChange' => 'readURL('.($image1 ? 'true' : 'false').', this, "'.( $image1 ? url()->to('/').'/photo/228x228/'.$image1->filename : url()->to('/').'/images/avatars/no_image.png').'", 1)', 'class' => 'image-input-1']) !!}
        {!! Form::file('image2', ['onChange' => 'readURL('.($image2 ? 'true' : 'false').', this, "'.( $image2 ? url()->to('/').'/photo/228x228/'.$image2->filename : url()->to('/').'/images/avatars/no_image.png').'", 2)', 'class' => 'image-input-2']) !!}
        {!! Form::file('image3', ['onChange' => 'readURL('.($image3 ? 'true' : 'false').', this, "'.( $image3 ? url()->to('/').'/photo/228x228/'.$image3->filename : url()->to('/').'/images/avatars/no_image.png').'", 3)', 'class' => 'image-input-3']) !!}
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

    <input type="submit" class="question-btn askq" value="Confirm">

    {!! Form::close() !!}
</div>