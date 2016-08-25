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
                        @if (count($errors->credits) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->credits->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.credits.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.credits.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.credits.message') }}
                            </div>
                        @endif
                        <section class="pt-20px pb-20px">
                            @foreach($schemes as $scheme)
                                <div class="col-md-4 col-sm-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <H5 class="uppercase">{{ $scheme->credits }} credits for</H5>
                                        <span class="price">£{{ round($scheme->price) }}</span>
                                        <p class="discount"><span class="round">- {{ round(100 - ($scheme->price*100/$scheme->credits)) }}%</span></p>
                                        <p class="lead">{{ $scheme->questions }} questions</p>
                                        {!! Form::open([
                                            'role' => 'form',
                                            'url' => action('UserController@paymentCredits'),
                                            'method' => 'POST',
                                            'class' => 'buy-credits'
                                        ]) !!}
                                        {!! Form::hidden('scheme', $scheme->id) !!}
                                        <input type="submit" class="btn btn-filled btn-lg" value="Buy credits">
                                        {!! Form::close() !!}
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                            @endforeach
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