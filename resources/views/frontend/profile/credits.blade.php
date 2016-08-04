@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">Ask question</a>
                            @include('frontend/elements/question')
                        </div>
                        <h4 class="uppercase mb16">Buy credits</h4>
                        @if (Session::has('flash_notification.question.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.question.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.question.message') }}
                            </div>
                        @endif
                        <section class="pt-20px pb-20px">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="pricing-table pt-1 text-center">
                                            <H5 class="uppercase">20 credits for</H5>
                                            <span class="price">£20</span>
                                            <p class="lead">1 question</p>
                                            <a class="btn btn-filled btn-lg" href="#">Buy credits</a>
                                        </div>
                                        <!--end of pricing table-->
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="pricing-table pt-1 text-center boxed">
                                            <H5 class="uppercase">60 credits for</H5>
                                            <span class="price">£55</span>
                                            <p class="lead">3 questions</p>
                                            <a class="btn btn-filled btn-lg" href="#">Buy credits</a>
                                        </div>
                                        <!--end of pricing table-->
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="pricing-table pt-1 text-center emphasis">
                                            <H5 class="uppercase">100 credits for</H5>
                                            <span class="price">£90</span>
                                            <p class="lead">5 questions</p>
                                            <a class="btn btn-white btn-lg" href="#">Buy credits</a>
                                        </div>
                                        <!--end of pricing table-->
                                    </div>
                                </div>
                                <!--end of row-->
                        </section>
                        <section class="pt-20px pb-0px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="uppercase mb16">How it works</h2>
                                    <p class="lead mb48">Get more pay less!</p>
                                    <p>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend/footer')
@stop