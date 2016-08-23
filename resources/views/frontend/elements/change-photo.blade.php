<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'avatar' ? 'data-time-delay=10' : '' }}>
    <h3 class="uppercase">Change photo</h3>
    @if (count($errors->avatar) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->avatar->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open([
        'role' => 'form',
        'url' => action('UserController@changeAvatar', ['modal' => 'avatar', 'url' => Route::currentRouteAction() ]),
        'files' => true,
        'class' => 'avatar-form1',
        'method' => 'POST'
    ]) !!}
    <div class="avatar-container left">
        <div class="center-cropped right">
            <img class="avatar-preview" src="{{ $user->userData->image ? url()->to('/').'/'.$user->userData->image->path.$user->userData->image->filename : url()->to('/').'/images/avatars/no_image.png' }}" alt="" />
            <div class="preloader-wrapper">
                <div class="spinner-layer">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="avatar-actions right">
        <a href="#" class="btn image-button upload left" onclick="uploadAvatar(this);"><i class="ti-export"></i> upload</a>
        <input type="submit" class="question-btn disabled left" disabled value="save">
    </div>
    <div class="clear"></div>
    <div class="avatar-errors"></div>
    {!! Form::file('avatar', ['onChange' => 'insertAvatar(this, "'.( $user->userData->image ? url()->to('/').'/'.$user->userData->image->path.$user->userData->image->filename : url()->to('/').'/images/avatars/no_image.png').'")', 'class' => 'avatar-input']) !!}
    {!! Form::close() !!}
</div>
@push('scripts')
<script type="text/javascript">
    centerAvatar.init('center-cropped', 'avatar-preview');
</script>
@endpush