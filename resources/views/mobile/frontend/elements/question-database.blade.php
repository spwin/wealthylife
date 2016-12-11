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
        'class' => 'question-form3 universal-question-form',
        'method' => 'POST'
    ]) !!}
    <div class="upload-button"></div>
    <div class="textarea-holder ask-quest">
        {!! Form::textarea('question', $question->question ? $question->question : null, ['class' => $errors->question_database->first('question', 'field-error ').'mt-1px', 'placeholder' => 'What would you like to ask?', 'onKeyPress' => 'countChar(this,event)', 'onKeyUp' => 'countChar(this,event)']) !!}
        <div class="charNum">
            @if(old())
                {{ old('question') ? 250 - strlen(old('question')) : 250 }}
            @else
                {{ $question->question ? 250 - strlen($question->question) : 250 }}
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
    <input type="submit" class="question-btn" value="Confirm">
    {!! Form::close() !!}
</div>
@push('scripts')
@php($image1 = $question->images->filter(function($item) { return ($item->pivot->sort == 1);})->first())
@php($image2 = $question->images->filter(function($item) { return ($item->pivot->sort == 2);})->first())
@php($image3 = $question->images->filter(function($item) { return ($item->pivot->sort == 3);})->first())
<script>
    ($)(function() {
        var images = [
            new ImageItem(1, '{!! $image1 ? url()->to('/').'/photo/228x228/'.$image1->filename : url()->to('/').'/images/avatars/no_image.png' !!}', {{ $image1 ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ $image1 ? url()->to('/').'/photo/228x228/'.$image1->filename : url()->to('/').'/images/avatars/no_image.png' }}'),
            new ImageItem(2, '{!! $image2 ? url()->to('/').'/photo/228x228/'.$image2->filename : url()->to('/').'/images/avatars/no_image.png' !!}', {{ $image2 ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ $image2 ? url()->to('/').'/photo/228x228/'.$image2->filename : url()->to('/').'/images/avatars/no_image.png' }}'),
            new ImageItem(3, '{!! $image3 ? url()->to('/').'/photo/228x228/'.$image3->filename : url()->to('/').'/images/avatars/no_image.png' !!}', {{ $image3 ? 'true' : 'false' }}, $('#mob-image-template').clone().children(), '{{ $image3 ? url()->to('/').'/photo/228x228/'.$image3->filename : url()->to('/').'/images/avatars/no_image.png' }}')
        ];
        initializeDatabaseQuestionPopup(images);
    });
</script>
@endpush