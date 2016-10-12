<div class="foundry_modal text-center" {{ Session::has('modal') && Session::get('modal') == 'feedback' ? 'data-time-delay=10' : '' }}>
    @if (Session::has('flash_notification.feedback.message'))
        <h3 class="uppercase">Thank you!</h3>
        <div class="feedback-thank-you">
            <i class="ti-check"></i>
            {{ Session::get('flash_notification.feedback.message') }}
        </div>
    @else
        <div class="login-header-back">
            <div class="login-header">
                <img src="{{ URL::to('/') }}/images/log-in-symbol.svg" alt="small logo">
                <h5 class="uppercase"><span class="ftw600">Feed</span>back</h5>
                <p>We'll be glad to hear from You!</p>
            </div>
        </div>
        @if (count($errors->feedback) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->feedback->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open([
            'role' => 'form',
            'url' => action('UserController@leaveFeedback', ['modal' => 'feedback', 'url' => Route::currentRouteAction() ]),
            'files' => true,
            'class' => 'feedback-form',
            'method' => 'POST'
        ]) !!}
        <div class="hidden">
            {!! Form::text('birthday', null) !!}
            {!! Form::text('city', 'London') !!}
        </div>
        <div class="textarea-holder">
            {!! Form::textarea('content', null, ['class' => $errors->feedback->first('content', 'field-error ').'mt-1px', 'placeholder' => 'How did we do?']) !!}
        </div>
        <input type="submit" class="question-btn pull-right" value="Send feedback">
        {!! Form::close() !!}
    @endif
</div>