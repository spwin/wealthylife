<div class="nav-container">
    <a id="top"></a>
    <nav class="absolute transparent">
        <div class="nav-bar">
            <div class="module left">
                <a href="{{ URL::to('/') }}">
                    <img class="logo logo-light" alt="Foundry" src="{{ URL::to('/') }}/images/logo-light.png">
                    <img class="logo logo-dark" alt="Foundry" src="{{ URL::to('/') }}/images/logo-dark.png">
                </a>
            </div>
            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group right">
                <div class="module left">
                    <ul class="menu" id="underline-hover">
                        <li class="current">
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Pricing</a>
                        </li>
                        <li>
                            <a href="#">Blog</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Contacts</a>
                        </li>
                    </ul>
                </div>

                <div class="module widget-handle language left">
                    <ul class="menu">
                        <li class="profile-dropdown">
                            <a href="#">Profile</a>
                            <ul>
                                <li>
                                    <a href="#">Log in</a>
                                </li>
                                <li>
                                    <div class="modal-container">
                                        <a class="btn-modal" href="#">Sign up</a>
                                        <div class="foundry_modal text-center">
                                            <h3 class="uppercase">Sign Up &amp; Be Cool.</h3>
                                            <p class="lead mb48">
                                                Please fill all the field provided.
                                            </p>
                                            <form class="form-newsletter halves">
                                                <input type="text" class="validate-required" name="name" placeholder="Your Name">
                                                <input type="text" class="validate-required validate-email" name="email" placeholder="Email Address">
                                                <textarea class="validate-required" name="message" rows="4" placeholder="Message"></textarea>
                                                <input type="submit" value="Send Message">
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</div>