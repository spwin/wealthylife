@extends('frontend/frame')
@section('nav-style', 'nav-blog')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3 mb-xs-24">
                    <div class="post-snippet mb64">
                        <a href="#">

                        </a>
                        <div class="post-title">
                            <span class="label">23 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A simple image post for starters</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Lifestyle</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>
                        <a class="btn btn-sm" href="#">Read More</a>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">

                        <div class="post-title">
                            <span class="label">19 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A lovely audio post for good measure</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Music</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <blockquote>
                            It's our challenges and obstacles that give us layers of depth and make us interesting. Are they fun when they happen? No. But they are what make us unique. And that's what I know for sure... I think.
                        </blockquote>
                        <div class="post-title">
                            <span class="label">07 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A thoughtful blockquote post on life</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Thoughts</a>
                                        </span>
                            </li>
                        </ul>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">

                        </div>
                        <!--end of embed video container-->
                        <div class="post-title">
                            <span class="label">06 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">An engaging embedded video post to top it off</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Cool Videos</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of nine col-->
                <div class="col-md-3 col-md-pull-9 hidden-sm">
                    <div class="widget bg-secondary p24">
                        <h5 class="uppercase mb16">Subscribe Now</h5>
                        <p>
                            Subscribe to our newsletter for a round-up of the week's most popular articles.
                        </p>
                        <form>
                            <input type="text" class="mb0" name="email" placeholder="Email Address" />
                            <input type="submit" value="Subscribe" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Search Blog</h6>
                        <hr>
                        <form>
                            <input class="mb0" type="text" placeholder="Type Here" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">About The Author</h6>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem antium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Blog Categories</h6>
                        <hr>
                        <ul class="link-list">
                            <li>
                                <a href="#">Lifestyle</a>
                            </li>
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">Photography</a>
                            </li>
                            <li>
                                <a href="#">Freelance</a>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Recent Posts</h6>
                        <hr>
                        <ul class="link-list recent-posts">
                            <li>
                                <a href="#">A simple image post for starters</a>
                                <span class="date">September 23, 2015</span>
                            </li>
                            <li>
                                <a href="#">An audio post for good measure</a>
                                <span class="date">September 19, 2015</span>
                            </li>
                            <li>
                                <a href="#">A thoguhtful blockquote post on life</a>
                                <span class="date">September 07, 2015</span>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Latest Updates</h6>
                        <hr>
                        <div class="twitter-feed">
                            <div class="tweets-feed" data-widget-id="492085717044981760">
                            </div>
                        </div>
                    </div>
                    <!--end of widget-->
                </div>
                <!--end of sidebar-->
            </div>
            <!--end of container row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3 mb-xs-24">
                    <div class="post-snippet mb64">
                        <a href="#">

                        </a>
                        <div class="post-title">
                            <span class="label">23 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A simple image post for starters</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Lifestyle</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>
                        <a class="btn btn-sm" href="#">Read More</a>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">

                        <div class="post-title">
                            <span class="label">19 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A lovely audio post for good measure</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Music</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <blockquote>
                            It's our challenges and obstacles that give us layers of depth and make us interesting. Are they fun when they happen? No. But they are what make us unique. And that's what I know for sure... I think.
                        </blockquote>
                        <div class="post-title">
                            <span class="label">07 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A thoughtful blockquote post on life</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Thoughts</a>
                                        </span>
                            </li>
                        </ul>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">

                        </div>
                        <!--end of embed video container-->
                        <div class="post-title">
                            <span class="label">06 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">An engaging embedded video post to top it off</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Cool Videos</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of nine col-->
                <div class="col-md-3 col-md-pull-9 hidden-sm">
                    <div class="widget bg-secondary p24">
                        <h5 class="uppercase mb16">Subscribe Now</h5>
                        <p>
                            Subscribe to our newsletter for a round-up of the week's most popular articles.
                        </p>
                        <form>
                            <input type="text" class="mb0" name="email" placeholder="Email Address" />
                            <input type="submit" value="Subscribe" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Search Blog</h6>
                        <hr>
                        <form>
                            <input class="mb0" type="text" placeholder="Type Here" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">About The Author</h6>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem antium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Blog Categories</h6>
                        <hr>
                        <ul class="link-list">
                            <li>
                                <a href="#">Lifestyle</a>
                            </li>
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">Photography</a>
                            </li>
                            <li>
                                <a href="#">Freelance</a>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Recent Posts</h6>
                        <hr>
                        <ul class="link-list recent-posts">
                            <li>
                                <a href="#">A simple image post for starters</a>
                                <span class="date">September 23, 2015</span>
                            </li>
                            <li>
                                <a href="#">An audio post for good measure</a>
                                <span class="date">September 19, 2015</span>
                            </li>
                            <li>
                                <a href="#">A thoguhtful blockquote post on life</a>
                                <span class="date">September 07, 2015</span>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Latest Updates</h6>
                        <hr>
                        <div class="twitter-feed">
                            <div class="tweets-feed" data-widget-id="492085717044981760">
                            </div>
                        </div>
                    </div>
                    <!--end of widget-->
                </div>
                <!--end of sidebar-->
            </div>
            <!--end of container row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3 mb-xs-24">
                    <div class="post-snippet mb64">
                        <a href="#">

                        </a>
                        <div class="post-title">
                            <span class="label">23 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A simple image post for starters</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Lifestyle</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>
                        <a class="btn btn-sm" href="#">Read More</a>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">

                        <div class="post-title">
                            <span class="label">19 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A lovely audio post for good measure</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Music</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <blockquote>
                            It's our challenges and obstacles that give us layers of depth and make us interesting. Are they fun when they happen? No. But they are what make us unique. And that's what I know for sure... I think.
                        </blockquote>
                        <div class="post-title">
                            <span class="label">07 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">A thoughtful blockquote post on life</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">James Hillier</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Thoughts</a>
                                        </span>
                            </li>
                        </ul>
                    </div>
                    <!--end of post snippet-->
                    <div class="post-snippet mb64">
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">

                        </div>
                        <!--end of embed video container-->
                        <div class="post-title">
                            <span class="label">06 Sep</span>
                            <a href="#">
                                <h4 class="inline-block">An engaging embedded video post to top it off</h4>
                            </a>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-user"></i>
                                        <span>Written by
                                            <a href="#">Craig Garner</a>
                                        </span>
                            </li>
                            <li>
                                <i class="ti-tag"></i>
                                        <span>Tagged as
                                            <a href="#">Cool Videos</a>
                                        </span>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <!--end of post snippet-->
                    <div class="text-center">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of nine col-->
                <div class="col-md-3 col-md-pull-9 hidden-sm">
                    <div class="widget bg-secondary p24">
                        <h5 class="uppercase mb16">Subscribe Now</h5>
                        <p>
                            Subscribe to our newsletter for a round-up of the week's most popular articles.
                        </p>
                        <form>
                            <input type="text" class="mb0" name="email" placeholder="Email Address" />
                            <input type="submit" value="Subscribe" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Search Blog</h6>
                        <hr>
                        <form>
                            <input class="mb0" type="text" placeholder="Type Here" />
                        </form>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">About The Author</h6>
                        <hr>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem antium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                        </p>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Blog Categories</h6>
                        <hr>
                        <ul class="link-list">
                            <li>
                                <a href="#">Lifestyle</a>
                            </li>
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">Photography</a>
                            </li>
                            <li>
                                <a href="#">Freelance</a>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Recent Posts</h6>
                        <hr>
                        <ul class="link-list recent-posts">
                            <li>
                                <a href="#">A simple image post for starters</a>
                                <span class="date">September 23, 2015</span>
                            </li>
                            <li>
                                <a href="#">An audio post for good measure</a>
                                <span class="date">September 19, 2015</span>
                            </li>
                            <li>
                                <a href="#">A thoguhtful blockquote post on life</a>
                                <span class="date">September 07, 2015</span>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                    <div class="widget">
                        <h6 class="title">Latest Updates</h6>
                        <hr>
                        <div class="twitter-feed">
                            <div class="tweets-feed" data-widget-id="492085717044981760">
                            </div>
                        </div>
                    </div>
                    <!--end of widget-->
                </div>
                <!--end of sidebar-->
            </div>
            <!--end of container row-->
        </div>
        <!--end of container-->
    </section>
@stop