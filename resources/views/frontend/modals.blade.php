@if (Session::has('modal'))
    @if (Session::get('modal') == 'success-signup')
        <div class="foundry_modal text-center" data-time-delay='10' >
            <h3 class="uppercase">Success</h3>
            <p class="lead mb48">
                Account has been created. Please check your email for confirmation link.
            </p>
            <a href="#" class="btn" onclick="openModal('login')">Log in</a>
        </div>
    @elseif (Session::get('modal') == 'confirmed')
        <div class="foundry_modal text-center" data-time-delay='10' >
            <h3 class="uppercase">Success</h3>
            <p class="lead mb48">
                Your email has been confirmed. You can now Log in.
            </p>
            <a href="#" class="btn" onclick="openModal('login')">Log in</a>
        </div>
    @elseif (Session::get('modal') == 'not_confirmed')
        <div class="foundry_modal text-center" data-time-delay='10' >
            <h3 class="uppercase">Something went wrong</h3>
            <p class="lead mb48">
                Please check your confirmation link or contact our support.
            </p>
            <a href="{{ action('FrontendController@contacts') }}" class="btn" >Contacts</a>
        </div>
    @endif
@endif