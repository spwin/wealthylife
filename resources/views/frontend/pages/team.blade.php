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
                        <h4 class="uppercase padright60on410">Team of <span class="color-pink">Stylesensei</span></h4>
                        <p>Stylesensei is run by a group of highly talented fashion-forward individuals who have the unique creativity needed to style you on a daily basis. Our team consists of individuals who are true fashion fanatics, and keep tabs on the latest trends, fashion icons, and styling ideas to forward them to our customers.</p>
                        <p>Whether you want to dress up to impress your new boss at a job interview or simply want to head out to a party with friends, <span class="color-pink bold700">we have got you covered.</span></p>
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rmw red-pos1" alt="Stylish man" src="{{ url()->to('/') }}/images/red-man.png">
                    <img class="curved-image-rmw red-pos2" alt="Stylish woman" src="{{ url()->to('/') }}/images/red-woman.png">
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="mobile-red-img mob-red-pos1 absolute visible990" alt="Stylish man" src="{{ url()->to('/') }}/images/red-man.png">
                    <img class="mobile-red-img mob-red-pos2 absolute visible990" alt="Stylish woman" src="{{ url()->to('/') }}/images/red-woman.png">
                </div>
            </div>
        </div>

             <!--  FASHION AND STYLING   -->

        <div class="arrow-style-invert">

            <div class="container container1400">
                <div class="half left about-block on-black blog ask-us">
                    <h3 class="uppercase blog-head relative"><span class="fs44">Ask us anything about</span> <span class="color-blue">fashion and styling</span><img class="absolute fashion-icon" alt="Blog icon" src="{{ url()->to('/') }}/images/blog-blue-icon.svg"></h3>
                    <p><span class="bold700">We will answer giving you the best advice to look and feel great.</span><br> Our style advice is meant to make you stand out in the crowd and look effortlessly chic and on-point.</p>
                </div>
            </div>

            <img class="right-image-team" alt="Stylish computer" src="{{ url()->to('/') }}/images/manikeny.png" >

        </div>


        <!--  GET ON BOARD   -->




        <div class="arrow-style mob-right-to-left">
            <div class="curve-wrap left-top-wrap">
                <div class="rotated left-top">
                    <div class="top-part"></div>
                    <img class="absolute position4" alt="Stylish people lying" src="{{ url()->to('/') }}/images/trendy-individuals.jpg">
                </div>
            </div>
            <div class="curve-wrap right-top-wrap">
                <div class="rotated right-top">
                    <div class="top-part"></div>
                    <img class="absolute position6 visible990" alt="Stylish people lying" src="{{ url()->to('/') }}/images/trendy-individuals.jpg">
                </div>
            </div>
            <div class="container get-on-board">
                <div class="row index3 mb32">
                    <div class="half left about-block">
                    </div>
                    <div class="half right nofloat-mob about-block pl30">
                        <h3 class="uppercase padright60on410 mb0">Get on board</h3>
                        <h4 class="uppercase color-cyan">With trendy individuals</h4>
                        <p>Are you fond of styling others and giving them dressing advice? Do you enjoy dressing up others? Do you get asked about your styling sense? If yes, why not join our style-experts’ team? At Stylesensei, we are always on the lookout of stylish and fashionable individuals who can make a difference in other people’s sense of dressing. We want to get positive, creative, and fun people on board with us who can help others look fabulous all day, every day.</p>
                        <p>So, if you think you have it in you, join our team by sending us your CV. Make sure you tell us your story, why you want to be a part of Stylesensei, and what’s special about you to get shortlisted.</p>
                    </div>
                </div>
                <div class="row index3">
                    <div class="half left about-block text-right pr30">
                        <h3 class="uppercase mb0">Make a move now!</h3>
                        <h4 class="uppercase color-cyan">We are searching for you!</h4>
                        <p>At Stylesensei, we are always searching for voguish individuals to be a part of our team. Our platform will help individuals get better styling and dressing advice, which is why we need experienced individuals to help us boost others’ confidence in their style and overall look. Get your style sorted out by getting in touch with our style-experts!</p>
                    </div>
                    <div class="half right about-block">
                    </div>
                </div>
                <div class="clearboth"></div>

            </div>

            <div class="curve-wrap left-bottom-wrap">
                <div class="rotated left-bottom">
                    <div class="bottom-part"></div>
                    <img class="absolute position7 visible990" alt="Stylish clothes" src="{{ url()->to('/') }}/images/make-move-now.jpg">
                </div>
            </div>
            <div class="curve-wrap right-bottom-wrap">
                <div class="rotated right-bottom">
                    <div class="bottom-part"></div>
                    <img class="curved-image-rb position5" alt="Stylish clothes" src="{{ url()->to('/') }}/images/make-move-now.jpg">
                </div>
            </div>
        </div>

    </section>
    @include('frontend/footer')
@stop