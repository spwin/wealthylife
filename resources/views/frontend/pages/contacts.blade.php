@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="uppercase mb0">Contact Us</h3>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5">
                    <h4 class="uppercase">Get In Touch</h4>
                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                    </p>
                    <hr>
                    <p>
                        438 Marine Parade
                        <br /> Elwood, Victoria
                        <br /> P.O Box 3184
                    </p>
                    <hr>
                    <p>
                        <strong>E:</strong> hello@foundry.net
                        <br />
                        <strong>P:</strong> +614 3948 2726
                        <br />
                    </p>
                </div>
                <div class="col-sm-6 col-md-5 col-md-offset-1">
                    <form class="form-email" data-success="Thanks for your submission, we will be in touch shortly." data-error="Please fill all fields correctly.">
                        <input type="text" class="validate-required" name="name" placeholder="Your Name" />
                        <input type="text" class="validate-required validate-email" name="email" placeholder="Email Address" />
                        <textarea class="validate-required" name="message" rows="4" placeholder="Message"></textarea>
                        <button type="submit">Send Message</button>
                    </form>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
@stop