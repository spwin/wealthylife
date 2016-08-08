@extends('frontend/layout')
@section('wrapper')
    <div class="main-container">
        <section class="cover fullscreen image-bg overlay">
            <div class="background-image-holder">
                <img alt="image" class="background-image" src="{{ url()->to('/') }}/images/page-coming-soon.jpg" />
            </div>
            <div class="container v-align-transform">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
                        <div class="feature bordered text-center">
                            <h3 class="uppercase">Launching Soon</h3>
                            <p>
                                We'll be launching our new site in the coming months. Thanks for your interest!
                            </p>
                        </div>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
    </div>
@stop