@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover15.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">Services</h2>
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
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
                    <h3>A unique, process driven approach to delivering outstanding results for our partners.</h3>
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
                    <div class="feature feature-3 mb-xs-24 mb64">
                        <div class="left">
                            <i class="ti-panel icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Expert, Modular Design</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature feature-3 mb-xs-24 mb64">
                        <div class="left">
                            <i class="ti-medall icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Trusted, Elite Author</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature feature-3 mb-xs-24 mb64">
                        <div class="left">
                            <i class="ti-layout icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Ultimate Flexibility</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature feature-3 mb-xs-24 mb64">
                        <div class="left">
                            <i class="ti-comment-alt icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Dedicated Support</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature feature-3 mb-xs-24">
                        <div class="left">
                            <i class="ti-infinite icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Endless Layouts</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature feature-3 mb-xs-24">
                        <div class="left">
                            <i class="ti-dashboard icon-sm"></i>
                        </div>
                        <div class="right">
                            <h5 class="uppercase mb16">Built for Performance</h5>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                            </p>
                        </div>
                    </div>
                    <!--end of feature-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="image-bg overlay parallax">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 class="uppercase mb64 mb-xs-32">Our Process</h3>
                </div>
            </div>
            <!--end of row-->
            <div class="row">
                <div class="col-sm-4">
                    <div class="feature feature-1 boxed">
                        <div class="text-center">
                            <i class="ti-agenda icon"></i>
                            <h5 class="uppercase mb16">Research & Ideate</h5>
                        </div>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-sm-4">
                    <div class="feature feature-1 boxed">
                        <div class="text-center">
                            <i class="ti-pencil-alt2 icon"></i>
                            <h5 class="uppercase mb16">Design & Iterate</h5>
                        </div>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of feature-->
                </div>
                <div class="col-sm-4">
                    <div class="feature feature-1 boxed">
                        <div class="text-center">
                            <i class="ti-package icon"></i>
                            <h5 class="uppercase mb16">Ship & Support</h5>
                        </div>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of feature-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="pt64 pb64">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="mb8">Create something beautiful.</h2>
                    <p class="lead mb40">
                        Variant Page Builder, Over 100 Page Templates - The choice is clear.
                    </p>
                    <a class="btn btn-filled btn-lg mb0" href="#">Purchase Foundry</a>
                </div>
            </div>
            <!--end of row-->
            <div class="embelish-icons">
                <i class="ti-marker"></i>
                <i class="ti-layout"></i>
                <i class="ti-ruler-alt-2"></i>
                <i class="ti-eye"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
                <i class="ti-marker"></i>
                <i class="ti-layout"></i>
                <i class="ti-ruler-alt-2"></i>
                <i class="ti-eye"></i>
                <i class="ti-signal"></i>
                <i class="ti-pulse"></i>
            </div>
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop