@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover5.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">About Us</h2>
                    <p class="lead mb0">A descriptive subtitle for your page.</p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="pb0">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="uppercase">Diversity & Difference</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
                <div class="col-sm-7">
                    <h4 class="uppercase">Diversity & Difference</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="image-tile outer-title text-center">
                        <img alt="Pic" src="{{ url()->to('/') }}/images/team-1.jpg" />
                        <div class="title mb16">
                            <h5 class="uppercase mb0">Sally Marsh</h5>
                            <span>Creative Director</span>
                        </div>
                        <p class="mb0">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="image-tile outer-title text-center">
                        <img alt="Pic" src="{{ url()->to('/') }}/images/team-2.jpg" />
                        <div class="title mb16">
                            <h5 class="uppercase mb0">Tim Foley</h5>
                            <span>iOS Developer</span>
                        </div>
                        <p class="mb0">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="image-tile outer-title text-center">
                        <img alt="Pic" src="{{ url()->to('/') }}/images/team-3.jpg" />
                        <div class="title mb16">
                            <h5 class="uppercase mb0">Jake Robbins</h5>
                            <span>Brand Director</span>
                        </div>
                        <p class="mb0">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                        </p>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h3 class="mb64 uppercase">People &nbsp;
                        <i class="ti-heart"></i>&nbsp; Foundry</h3>
                    <div class="testimonials text-slider slider-arrow-controls">
                        <ul class="slides">
                            <li>
                                <p class="lead">It's clear to see just how seriously these guys take design. I've never come across a template with the level of polish as this - and don't even get me started on the page builder, there is simply NO competition. Customer for life.</p>
                                <div class="quote-author">
                                    <img alt="Avatar" src="{{ url()->to('/') }}/images/avatar1.png" />
                                    <h6 class="uppercase">Anna Thompson</h6>
                                    <span>Themeforest Customer</span>
                                </div>
                            </li>
                            <li>
                                <p class="lead">I love the ease-of-use the builder provides - I can quickly test different combinations and experiment with font and color combinations to find that sweet spot. Kudos for the amazing support too, really quick turnaround!</p>
                                <div class="quote-author">
                                    <img alt="Avatar" src="{{ url()->to('/') }}/images/avatar2.png" />
                                    <h6 class="uppercase">Rick Dempsey</h6>
                                    <span>Themeforest Customer</span>
                                </div>
                            </li>
                            <li>
                                <p class="lead">A fine example of atomic design brought to life. As a seasoned template user, I really appreciate the consistent styling for all common tags, it makes customising the sections that much easier. 5 stars as always for an amazing template.</p>
                                <div class="quote-author">
                                    <img alt="Avatar" src="{{ url()->to('/') }}/images/avatar3.png" />
                                    <h6 class="uppercase">Gill Sans</h6>
                                    <span>Themeforest Customer</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop