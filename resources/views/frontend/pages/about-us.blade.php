@extends('frontend/frame')
@section('page-title', trans('seo.about.title'))
@section('meta-description', trans('seo.about.description'))
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/about-bg.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">About</h1>
                    <h2 class="lead mb0 below">It's not about brand, <span class="color-pink">it's about style.</span></h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>

                    <!--  FIRST CONTAINER   -->

        <div class="arrow-style mob-left-to-right">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="container first-about-block">
                <div class="row index3">
                    <div class="half left about-block mobile-absolute position1 zindex-1">
                        <img class="bigger-image" alt="Black dotted dress" src="{{ url()->to('/') }}/images/black-dot-dress.png" >
                    </div>
                    <div class="half right nofloat-mob about-block mt56">
                        <h3 class="uppercase fs35on550 padright60on410">In search of perfect footwear for your <span class="color-pink">party dress?</span></h3>
                        <h4 class="uppercase padright60on410">Having trouble <span class="color-pink">mixing and matching</span> outfits?</h4>
                        <h5 class="uppercase padright60on410">Need help dressing up <span class="color-pink">for date night?</span></h5>
                        <p class="phrase padright60on410"><span class="bold700">No matter what type of styling trouble you are in,</span> at Stylesensei, we always have your back!</p>
                        <p>We are your go-to team to answer all your styling-related questions. From helping you choose the perfect dress for your body type and picking out the right scarf to go with your dress, we are the one stop solution for all your style and fashion problems. Our stylists are prompt and eager to help you with any fashion questions that you might have. So, whenever you have trouble picking up the right outfit, just call us out for help and we will get back to you in little time.</p>
                        <!--p>Click here to take a look at the type of questions our styling team can answer for you!</p-->
                    </div>
                </div>
                <div class="relative index0">
                    <img class="absolute visible570" alt="Black dotted dress" src="{{ url()->to('/') }}/images/blond-woman-cut.jpg">
                </div>
                <div class="row index3">
                    <div class="half left about-block">
                        <h3 class="uppercase padright109on410"><span class="color-pink">How It</span> Works?</h3>
                        <p class="padright60on410">
                            <span class="bold700 phrase">Is there a fashion emergency that you want to solve?</span><br>Here’s how you can get connected to our styling experts:
                        <ul class="how-it-works">
                            <li class="how1"><span class="bold700">01. Log into Stylesensei</span> with your social account or create an account.</li>
                            <li class="how2"><span class="bold700">02. Tell us</span> your problem or <span class="bold700">ask us</span> a question.</li>
                            <li class="how3"><span class="bold700">03. Attach a picture</span> of you or some item in the question if you want to.</li>
                            <li class="how4"><span class="bold700">04. Proceed</span> with your <span class="bold700">payment</span> via Paypal or credit/debit card.</li>
                            <li class="how5"><span class="bold700">05. Get an email notification</span> once our team answers your questions.</li>
                            <li class="how6"><span class="bold700">06. Check back</span> into your <span class="bold700">Stylesensei account</span> to find our answer.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="half right about-block">
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rb blond" alt="Stylish blond woman" src="{{ url()->to('/') }}/images/blond-woman.jpg">
                </div>
            </div>
        </div>

                <!--   OUR MISSION   -->

        <div class="arrow-style-invert">

            <img class="left-image mob-none" alt="Stylish man in suit with watch" src="{{ url()->to('/') }}/images/man-watches.png" >

            <div class="container">
                <div class="half right about-block on-black padleft150 mission">
                    <h3 class="uppercase mb5 padleft48 relative"><img class="absolute mission-icon" alt="Mission aim" src="{{ url()->to('/') }}/images/mission-icon.svg">Our <span class="color-pink">Mission</span></h3>
                    <p>We aim at giving professional styling and fashion advice available for everyone without having to pay a hefty amount of money.</p>
                </div>
            </div>

        </div>


                <!--    CREDITS / GIFTS       -->

        <div class="arrow-style mob-right-to-left">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                </div>
            </div>
                <div class="row">
                    <div class="container text-center pt32">
                        <div class="center-cont">
                            <img class="width32 left rfloat-mob" src="{{ url()->to('/') }}/images/credits.jpg">
                            <div class="left about-block padleft48 padright30-mob">
                                <h3 class="uppercase credits-head">Credits</h3>
                                <p>Want to make the most of your relation with us? Get outstanding deals and save money on styling advice by using our credits system. By purchasing more credits, you get a chance to save more money and enjoy better deals.</p>
                                <p>You will find more information about credits when you log into Stylesensei.</p>
                            </div>
                        </div>
                        <div class="center-cont">
                            <div class="width40 right">
                                <img src="{{ url()->to('/') }}/images/gift-voucher.jpg">
                            </div>
                            <div class="right about-block">
                                <h3 class="uppercase gift-head"><span class="color-gift">Gift</span> vouchers</h3>
                                <p>If you are looking for gift ideas for a friend or a family member, look no further as StyleSensei brings you the most unique and fun gift vouchers that truly make for a perfect present for any occasion.</p>
                                <p>Our gift vouchers will make your present extra-ordinarily memorable and special for the receiver. By purchasing our awesome gift voucher, you can give others a chance to make use of our professional styling advice at a fraction of the cost.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
        </div>

            <!--  BLOG   -->

        <div class="arrow-style-invert">

            <div class="container">
                <div class="half left about-block on-black blog">
                    <h3 class="uppercase blog-head relative">Blog<img class="absolute blog-icon" alt="Blog icon" src="{{ url()->to('/') }}/images/blog-blue-icon.svg"></h3>
                    <p>Are you fond of penning down your thoughts? At Stylesensei, we give our customers a chance to write blogs and get them published on our site for free. In order to get started, all you need to do is create a blog entry with your photo and share.</p>
                    <p>You can invite more people to view your blog by sharing it on other social media platforms.</p>
                </div>
            </div>

            <img class="right-image mob-none" alt="Stylish computer" src="{{ url()->to('/') }}/images/blog-mac.png" >

        </div>



            <!--   REFERRAL   -->

        <div class="arrow-style index3 mob-left-to-right">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="half left about-block mt64 mobile-absolute position2">
                        <img alt="Referral system image width90" src="{{ url()->to('/') }}/images/referral-system.jpg" >
                    </div>
                    <div class="half right about-block mt56 referral">
                        <h3 class="uppercase padright60on410">Referral reward <span class="color-blue">System</span></h3>
                        <p><span class="bold700">Our clients are the best promoters of our service. And as you are the part of it, by helping you get the most of StyleSensei we created our unique REFER A FRIEND system.</span><br>Here's how you can get connected to our styling experts:</p>
                        <p class="mb0">- You receive <strong>£2</strong> worth of StyleSensei points for every person you refer your personal referral link.</p>
                        <p class="mt0">- People you refer will get <strong>20%</strong> discount on their first asked question!</p>
                        <p>Let your friends know about StyleSensei and get them to register with you unique referral link. Let them step into world of fashion and style increasing your STYpoints to redeem in future!</p>
                    </div>
                    <div class="clearboth"></div>
                </div>
                <div class="row text-center mt40 how-it-works2">
                        <div class="about-block">
                            <h3 class="uppercase mt24 mb48">How it <span class="color-blue">works?</span></h3>
                            <div class="ref1 referral-works"><span class="bold700">01. </span>Log in and get your unique referral code under ‘Referral rewards’ tab in your StyleSensei Profile section.</div>
                            <div class="ref2 referral-works"><span class="bold700">02. </span>Forward you Style link to everyone you know by email, text, Facebook, Twitter</div>
                            <div class="ref3 referral-works"><span class="bold700">03. </span>Make sure they register using your referral link and use any of the paid services.</div>
                            <div class="ref4 referral-works mt16"><span class="bold700">04.</span>Follow your points on your StyleSensei account</div>
                            <div class="ref5 referral-works mt16"><span class="bold700">05. </span>Spend your points on questions so you can pay less!</div>
                        </div>
                </div>
            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                </div>
            </div>
        </div>

            <!-----   SECURITY   -->


        <div class="arrow-style-invert">

            <div class="container">
                <div class="row text-center">
                    <div class="center-cont about-block on-black">
                        <img class="width28 left mob-none" src="{{ url()->to('/') }}/images/security-icon.svg">
                        <div class="left about-block padleft48 width90-mob">
                            <h3 class="uppercase credits-head"><span class="color-blue">Security</span> & privacy</h3>
                            <p>At Stylesensei, <span class="bold700">we ensure</span> that our customers are <span class="bold700 color-blue">protected</span> by any kind of <span class="bold700">data</span> theft, which is why we have encrypted the entire site with <span class="bold700"><span class="color-blue">SSL</span> certificate</span>.</p>
                            <p>Feel free to ask any type of questions on styling and we promise you that it will remain between you and the consultant in charge. Your personal information will also be protected and kept under confidentiality. We process all payments via Braintree gateway, a highly secure and reliable payment system.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!---  YOUR STYLE  -->

        <div class="arrow-style mob-right-to-left">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                </div>
            </div>
            <div class="container first-about-block padbottom150-mob">
                <div class="row">
                    <div class="half left about-block text-right mt112 mb112 last-about-block">
                        <h3 class="uppercase"><span class="color-blue">Your style</span> <span class="font-weight400">speaks of</span> <span class="color-dark-blue">your personality</span></h3>
                        <p class="phrase">Don’t compromise on it and get in touch with Stylesensei to make sure <span class="color-dark-blue bold700">you are looking on point all the time!</span></p>
                    </div>
                    <div class="half right about-block">
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                    <img class="last-img mob-block position3 mobile-absolute" alt="Black dotted dress" src="{{ url()->to('/') }}/images/last-img.jpg" >
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rb last-img mob-none" alt="Black dotted dress" src="{{ url()->to('/') }}/images/last-img.jpg" >
                </div>
            </div>
        </div>


    </section>
    @include('frontend/footer')
@stop