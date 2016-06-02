@if (Session::has('modal'))
    @if (Session::get('modal') == 'success-signup')
        <div class="foundry_modal text-center" data-time-delay='10' >
            <h3 class="uppercase">Success</h3>
            <p class="lead mb48">
                Account has been created. Please check your email for confirmation link.
            </p>
            <a href="#" class="btn">Log in</a>
        </div>
    @endif
@endif