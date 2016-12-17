@extends('frontend/frame')
@section('page-title', trans('seo.team.title'))
@section('meta-description', trans('seo.team.description'))
@section('nav-style', 'nav-authorize-question')
@section('body-class', 'team-page')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder-about fadeIn">
            <!--img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover5.jpg" /-->
        </div>
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">The team</h1>
                    <h2 class="lead mb0 below"><span class="color-pink">Teamwork</span> makes the dream work.</h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>


        <!--  FIRST CONTAINER   -->

        <div class="arrow-style mob-left-to-right nopad800">
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
                    </div>
                    <div class="half right nofloat-mob about-block team-first-text mt56 mb48">
                        <h3 class="uppercase mb0">The<span class="br"></span> Fashion-Forward</h3>
                        <h4 class="uppercase padright60on410">Team of <span class="color-pink">StyleSensei</span></h4>
                        <p>StyleSensei is run by a group of highly talented fashion-forward individuals who have the unique creativity needed to style you on a daily basis. Our team consists of individuals who are true fashion fanatics, and keep tabs on the latest trends, fashion icons, and styling ideas to forward them to our customers.</p>
                        <p>Whether you want to dress up to impress your new boss at a job interview or simply want to head out to a party with friends, <span class="color-pink bold700">we have got you covered.</span></p>
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rmw red-pos1 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish man" data-original="{{ url()->to('/') }}/images/red-man.png">
                    <img class="curved-image-rmw red-pos2 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish woman" data-original="{{ url()->to('/') }}/images/red-woman.png">
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="mobile-red-img mob-red-pos1 absolute visible990 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish man" data-original="{{ url()->to('/') }}/images/red-man.png">
                    <img class="mobile-red-img mob-red-pos2 absolute visible990 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish woman" data-original="{{ url()->to('/') }}/images/red-woman.png">
                </div>
            </div>
        </div>

        <!--- OUR STYLISTS --->

        <div class="arrow-style-invert">

            <div class="container our-stylists">
                <div class="consultants-head about-block on-black blog ask-us">
                    <img class="lazy mb24 stylists-icon" src="{{ url()->to('/') }}/images/img-preload.png" alt="Team icon" data-original="{{ url()->to('/') }}/images/stylists-icon.svg">
                    <h3 class="uppercase blog-head relative">Meet our stylist that are ready<span class="display-block"></span> <span class="color-blue">to assist you <span class="display-inlineblock time-back">24/7</span></span></h3>
                 </div>
            </div>

        </div>

        <!--  consultants   -->

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
                    <div itemscope itemtype="http://schema.org/Person">
                        <div class="center-cont consultant">
                            <div itemprop="brand" itemscope="" itemtype="https://schema.org/Brand">
                                <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="{{ URL::to('/') }}/images/logo-meta.png">
                                    <meta itemprop="width" content="225">
                                    <meta itemprop="height" content="225">
                                </div>
                                <meta itemprop="name" content="{{ env('APP_META_NAME') }}">
                            </div>
                            <div itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="{{ url()->to('/').'/images/esohe-.jpg' }}">
                                <meta itemprop="width" content="143">
                                <meta itemprop="height" content="143">
                            </div>
                            <img class="width14 left lazy" src="{{ url()->to('/') }}/images/img-preload.png" data-original="{{ url()->to('/') }}/images/esohe-.jpg">
                            <div class="left about-block padleft25 padright30-mob">
                                <h3 class="uppercase gift-head mb0" itemprop="name">Esohe Ebohon</h3>
                                <h4 class="uppercase color-green-prof" itemprop="description">Personal Style Advisor</h4>
                                <p>Esohe Ebohon is a fully trained Personal Stylist & Shopper and Founder of Stylierge Styling Services based in London. She began her career working as a fashion assistant on magazines such as Tatler, Glamour, Dazed & Confused and The Daily Telegraph Saturday Magazine. In addition, she also has many years’ experience working in luxury retail. She has styled fashion editorials which have been featured in Elegant, Hacid, Dreamingless and Ellements magazines. She is a Huffington Post blogger and has been featured in Grazia magazine.</p>
                                <p>She uses her fashion knowledge and expertise to specialise in helping professional women or men refine their image and create a signature style that is timeless, classic and chic and will make an impact in the workplace and in life. She offers professional, user friendly advice designed to help you look and feel your best.</p>
                            </div>
                        </div>
                    </div>
                    <div itemscope itemtype="http://schema.org/Person">
                        <div class="center-cont consultant">
                            <div itemprop="brand" itemscope="" itemtype="https://schema.org/Brand">
                                <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="{{ URL::to('/') }}/images/logo-meta.png">
                                    <meta itemprop="width" content="225">
                                    <meta itemprop="height" content="225">
                                </div>
                                <meta itemprop="name" content="{{ env('APP_META_NAME') }}">
                            </div>
                            <div itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="{{ url()->to('/').'/images/caragh-.jpg' }}">
                                <meta itemprop="width" content="143">
                                <meta itemprop="height" content="143">
                            </div>
                            <img class="width14 left lazy" src="{{ url()->to('/') }}/images/img-preload.png" data-original="{{ url()->to('/') }}/images/caragh-.jpg">
                            <div class="left about-block padleft25 padright30-mob">
                                <h3 class="uppercase gift-head mb0" itemprop="name">Caragh Logan</h3>
                                <h4 class="uppercase color-green-prof" itemprop="description">Fashion Professional</h4>
                                <p>Having begun her career in retail and Personal Shopping, Caragh spent her early 20s working in the music and fashion industries, before securing her position as Fashion Editor at the largest Youth Culture magazine in the UK. Since, Caragh has worked across both editorial and styling, and has a practical understanding of how to put together a phenomenal outfit, no matter the style or occasion!</p>
                                <p>With a natural creative flair, Caragh has an expert understanding of ‘proportional dressing’ to flatter each body-shape and is passionate about empowering women to feel at their absolute best. She also provides a wealth of information in regards to menswear, from street style to structured suits. She is committed to providing thorough and considered responses, with examples and ‘how tos’ to assist you in achieving your desired look.</p>
                            </div>
                        </div>
                    </div>
                    <div itemscope itemtype="http://schema.org/Person">
                        <div class="center-cont consultant">
                            <div itemprop="brand" itemscope="" itemtype="https://schema.org/Brand">
                                <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="{{ URL::to('/') }}/images/logo-meta.png">
                                    <meta itemprop="width" content="225">
                                    <meta itemprop="height" content="225">
                                </div>
                                <meta itemprop="name" content="{{ env('APP_META_NAME') }}">
                            </div>
                            <div itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="{{ url()->to('/').'/images/jamilah-.jpg' }}">
                                <meta itemprop="width" content="143">
                                <meta itemprop="height" content="143">
                            </div>
                            <img class="width14 left lazy" src="{{ url()->to('/') }}/images/img-preload.png" data-original="{{ url()->to('/') }}/images/jamilah-.jpg">
                            <div class="left about-block padleft25 padright30-mob">
                                <h3 class="uppercase gift-head mb0" itemprop="name">Jamilah Estrianna Toni</h3>
                                <h4 class="uppercase color-green-prof" itemprop="description">Personal Shopper</h4>
                                <p>Jamilah is a young and experienced fashion stylist and consultant with more than 3 years of styling a range of editorials, fashion shows and E-commence for some of your favourite online stores. She has also worked as a personal shopper for a variety of clients and celebrities.</p>
                                <p>Jamilah graduated from London college of Fashion, she was emerged into the styling scene by appearing on a styling show on Channel 4. Since then she has been on a mission to share her styling tips!</p>
                                <p>"I like to make my clients feel super comfortable and happy with each step of the process. I try to work in a way that you find happiness from your own conclusion rather than working as a stylist who tells you that this is good."</p>
                            </div>
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


             <!--  FASHION AND STYLING   -->

        <div class="arrow-style-invert">

            <div class="container container1400">
                <div class="half left about-block on-black blog ask-us">
                    <h3 class="uppercase blog-head relative"><span class="fs44">Ask us anything about</span> <span class="color-blue">fashion and styling</span><img class="absolute fashion-icon mobile-none" alt="Blog icon" src="{{ url()->to('/') }}/images/blog-blue-icon.svg"></h3>
                    <p><span class="bold700">We will answer giving you the best advice to look and feel great.</span><br> Our style advice is meant to make you stand out in the crowd and look effortlessly chic and on-point.</p>
                </div>
            </div>

            <img class="right-image-team lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish computer" data-original="{{ url()->to('/') }}/images/manikeny.png" >

        </div>


        <!--  GET ON BOARD   -->




        <div class="arrow-style mob-right-to-left">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                    <img class="absolute position4 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish people lying" data-original="{{ url()->to('/') }}/images/trendy-individuals.jpg">
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                    <img class="absolute position6 visible990 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish people lying" data-original="{{ url()->to('/') }}/images/trendy-individuals.jpg">
                </div>
            </div>
            <div class="container get-on-board">
                <div class="row index3 mb32">
                    <div class="half left about-block">
                    </div>
                    <div class="half right nofloat-mob about-block pl30">
                        <h3 class="uppercase padright60on410 mb0">Get on board</h3>
                        <h4 class="uppercase color-cyan">With trendy individuals</h4>
                        <p>Are you fond of styling others and giving them dressing advice? Do you enjoy dressing up others? Do you get asked about your styling sense? If yes, why not join our style-experts’ team? At StyleSensei, we are always on the lookout of stylish and fashionable individuals who can make a difference in other people’s sense of dressing. We want to get positive, creative, and fun people on board with us who can help others look fabulous all day, every day.</p>
                        <p>So, if you think you have it in you, join our team by sending us your CV. Make sure you tell us your story, why you want to be a part of StyleSensei, and what’s special about you to get shortlisted.</p>
                    </div>
                </div>
                <div class="row index3">
                    <div class="half left about-block text-right pr30">
                        <h3 class="uppercase mb0">Make a move now!</h3>
                        <h4 class="uppercase color-cyan">We are searching for you!</h4>
                        <p>At StyleSensei, we are always searching for voguish individuals to be a part of our team. Our platform will help individuals get better styling and dressing advice, which is why we need experienced individuals to help us boost others’ confidence in their style and overall look. Get your style sorted out by getting in touch with our style-experts!</p>
                    </div>
                    <div class="half right about-block">
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                    <img class="absolute position7 visible990 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish clothes" data-original="{{ url()->to('/') }}/images/make-move-now.jpg">
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rb position5 lazy" src="{{ url()->to('/') }}/images/img-preload.png" alt="Stylish clothes" data-original="{{ url()->to('/') }}/images/make-move-now.jpg">
                </div>
            </div>
        </div>

    </section>
    @include('frontend/footer')
@stop