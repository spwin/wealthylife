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
                        <h4 class="uppercase mb16">Gift vouchers</h4>
                        @if (count($errors->voucher) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->voucher->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('flash_notification.voucher.message'))
                            <div class="alert alert-{{ Session::get('flash_notification.voucher.level') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('flash_notification.voucher.message') }}
                            </div>
                        @endif
                        <section class="pt-20px pb-20px">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center">
                                        <p class="voucher-back"><i class="ti-gift"></i></p>
                                        <H5 class="uppercase">Go here to</H5>
                                        <span class="price">Buy</span>
                                        <p class="lead">£20 - £90 gift vouchers</p>
                                        <p>Great gift for your loved one</p>
                                        <a class="btn btn-filled btn-lg" href="{{ action('FrontendController@buyVoucher') }}">Make someone happy</a>
                                    </div>
                                    <!--end of pricing table-->
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-table pt-1 text-center boxed">
                                        <p class="voucher-back"><i class="ti-gift"></i></p>
                                        <H5 class="uppercase">Enter code to</H5>
                                        <span class="price">Claim</span>
                                        {!! Form::open([
                                            'role' => 'form',
                                            'url' => action('UserController@checkVoucher'),
                                            'method' => 'POST',
                                            'class' => 'login-profile'
                                        ]) !!}
                                        <p class="lead"><input type="text" name="code" class="voucher-claim" placeholder="Enter your code here"></p>
                                        <input type="submit" class="btn btn-filled btn-lg voucher-check" value="Confirm and continue">
                                        {!! Form::close() !!}
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
                                    <p class="lead mb48">Bring the joy to someone's heart</p>
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