@extends('frontend/frame')
@section('page-title', trans('seo.team.title'))
@section('meta-description', trans('seo.team.description'))
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover5.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">The team</h2>
                    <p class="lead mb0">Teamwork makes the dream work.</p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div>
                <h4>The Fashion-Forward Team of Stylesensei</h4>
                <p>Stylesensei is run by a group of highly talented fashion-forward individuals who have the unique creativity needed to style you on a daily basis. Our team consists of individuals who are true fashion fanatics, and keep tabs on the latest trends, fashion icons, and styling ideas to forward them to our customers. Whether you want to dress up to impress your new boss at a job interview or simply want to head out to a party with friends, we have got you covered.</p>
                <p>Ask us anything about fashion and styling, and we will answer giving you the best advice to look and feel great. Our style advice is meant to make you stand out in the crowd and look effortlessly chic and on-point.</p>
            </div>

            <div>
                <h4>Get on Board with Trendy Individuals</h4>
                <p>Are you fond of styling others and giving them dressing advice? Do you enjoy dressing up others? Do you get asked about your styling sense? If yes, why not join our style-experts’ team? At Stylesensei, we are always on the lookout of stylish and fashionable individuals who can make a difference in other people’s sense of dressing. We want to get positive, creative, and fun people on board with us who can help others look fabulous all day, every day.</p>
                <p>So, if you think you have it in you, join our team by sending us your CV. Make sure you tell us your story, why you want to be a part of Stylesensei, and what’s special about you to get shortlisted.</p>
            </div>

            <div>
                <h4>Make a Move Now!</h4>
                <p>At Stylesensei, we are always searching for voguish individuals to be a part of our team. Our platform will help individuals get better styling and dressing advice, which is why we need experienced individuals to help us boost others’ confidence in their style and overall look.</p>
            </div>

            <div>
                <h5>Get your style sorted out by getting in touch with our style-experts!</h5>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop