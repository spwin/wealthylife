@extends('frontend/frame')
@section('page-title', trans('seo.about.title'))
@section('meta-description', trans('seo.about.description'))
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/about-back.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8 page-h2">About</h2>
                    <p class="lead mb0 below">It's not about brand, it's about style.</p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>

        <div class="arrow-style">
            <span class="top-arr arrow"></span>
            <div class="container first-about-block">
                <div class="row">
                    <div class="half left about-block">
                        <img class="bigger-image" alt="Black dotted dress" src="{{ url()->to('/') }}/images/black-dot-dress.png" >
                    </div>
                    <div class="half left about-block">
                        <h3 class="uppercase">In search of perfect footwear for your <span class="pink-text">party dress?</span></h3>
                        <h4 class="uppercase">Having trouble <span class="pink-text">mixing and matching</span> outfits?</h4>
                        <h5 class="uppercase">Need help dressing up <span class="pink-text">for date night?</span></h5>
                        <p class="phrase"><span class="bold700">No matter what type of styling trouble you are in,</span> at Stylesensei, we always have your back!</p>
                        <p>We are your go-to team to answer all your styling-related questions. From helping you choose the perfect dress for your body type and picking out the right scarf to go with your dress, we are the one stop solution for all your style and fashion problems. Our stylists are prompt and eager to help you with any fashion questions that you might have. So, whenever you have trouble picking up the right outfit, just call us out for help and we will get back to you in little time.</p>
                        <p>Click here to take a look at the type of questions our styling team can answer for you!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="half left about-block">
                        <h3 class="uppercase"><span class="pink-text">How It</span> Works?</h3>
                        <p>
                            <span class="bold700 phrase">Is there a fashion emergency that you want to solve?</span><br>Here’s how you can get connected to our styling experts:
                        <ul class="how-it-works">
                            <li>Log into Stylesensei with your social account or create an account.</li>
                            <li>Tell us your problem or ask us a question.</li>
                            <li>Attach a picture of the item in question if you want to.</li>
                            <li>Proceed with your payment via Paypal or credit/debit card.</li>
                            <li>Get an email notification once our team answers your questions.</li>
                            <li>Check back into your Stylesensei account to find our answer.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="half left about-block">

                    </div>
                </div>
                <div class="clearboth"></div>
            </div>
            <span class="bottom-arr arrow"><img alt="Black dotted dress" src="{{ url()->to('/') }}/images/blond-woman.jpg" ></span>
        </div>




        <div class="container">

            <div>
                <h4>Our Mission</h4>
                <p>
                    We aim at giving professional styling and fashion advice available for everyone without having to pay a hefty amount of money.
                </p>
            </div>

            <div>
                <h4>Credits</h4>
                <p>
                    Want to make the most of your relation with us? Get outstanding deals and save money on styling advice/suggestions by using our credits system. By purchasing more credits, you get a chance to save more money and enjoy better deals. You will find more information about credits when you log into Stylesensei.
                </p>
            </div>

            <div>
                <h4>Gift Vouchers</h4>
                <p>
                    If you are browsing/searching/looking for gift ideas for a friend or a family member, look no further as Stylesensei brings you the most unique and fun gift vouchers that truly make for a perfect present for any occasion. Our gift vouchers will make your present extra-ordinarily memorable and special for the receiver. By purchasing our awesome gift voucher, you can give others a chance to make use of our professional styling advice ata fraction of the cost.
                </p>
            </div>

            <div>
                <h4>Blog</h4>
                <p>
                    Are you fond of penning down your thoughts? At Stylesensei, we give our customers a chance to write blogs and get them published on our site for free. In order to get started, all you need to do is create a blog entry with your photo and share. You can invite more people to view your blog by sharing it on other social media platforms.
                </p>
            </div>

            <div>
                <h4>Referral reward system</h4>
                <p>
                    Our clients are the best promoters of our service. And as you are the part of it, by helping you get the most of StyleSensei we created our unique REFER A FRIEND system.
                    <ul>
                        <li>- You receive £2 worth of StyleSensei points for every person you refer your personal referral link.</li>
                        <li>- People you refer can get discounts on their first asked question!</li>
                    </ul>
                    Let your friends know about StyleSensei and get them to register with you unique referral link. Let them step into world of fashion and style increasing your STYpoints to redeem in future!
                </p>
                <p>
                How it works?
                <ul>
                    <li><b>1.</b> Log in and get your unique referral code under ‘Rewards’ tab in your StyleSensei My Account section.</li>
                    <li><b>2.</b> Forward you Style link to everyone you know by email, text, Facebook, Twitter</li>
                    <li><b>3.</b> Make sure they register using your referral link and ask at least one question.</li>
                    <li><b>4.</b> Follow your points on your StyleSensei account</li>
                    <li><b>5.</b> Spend your points on questions so you can pay less!</li>
                </ul>
                </p>
            </div>

            <div>
                <h4>Security & Privacy</h4>
                <p>
                    At Stylesensei, we ensure that our customers are protected by any kind of data theft, which is why we have encrypted the entire site with SSL certificate. Feel free to ask any type of questions on styling and we promise you that it will remain between you and the consultant in charge. Your personal information will also be protected and kept under confidentiality. We process all payments via Braintree gateway, a highly secure and reliable payment system.
                </p>
            </div>

            <div>
                <h5>Your style speaks of your personality, so don’t compromise on it and get in touch with Stylesensei to make sure you are looking on point all the time!</h5>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop