@extends('frontend/frame')
@section('page-title', trans('seo.examples.title'))
@section('meta-description', trans('seo.examples.description'))
@section('nav-style', 'nav-authorize-question')
@section('meta-content')
    @include('frontend/elements/twitter-card')
@stop
@section('body-class', 'examples-page')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="container page-first-header">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase mb8 page-h2">Examples</h1>
                    <h2 class="lead mb0 below">Check what you can get <span class="color-pink">for only £20.</span></h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>


        <!--  FIRST CONTAINER   -->

        <div class="arrow-style mob-left-to-right">
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
            <div class="container inner-blog">

                <div class="text-center blog-button-txt mb24">
                    <p class="mb16">Get <span class="color-blue-prof bold700">Professional</span> Advice!</p>
                    <div class="modal-container">
                        <a class="btn btn-modal text-left btn-filled blue-button" href="#"><span class="display-inlineblock">Ask stylist now</span></a>
                        <div class="hidden">
                            @if(\App\Helpers\Helpers::isMobile())
                                @include('mobile/frontend/elements/question')
                            @else
                                @include('frontend/elements/question')
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row example">
                    <h3><span class="color-pink bold">Question 1:</span></h3>
                    <h4>
                        Hello, how can I combine clothes to look more elegant and graceful without making myself
                        look older (which I tend to do, Oops). Thanks!
                    </h4>
                    <p>Female, 25 years, 177cm, 80kg (1 photo attached)</p>
                    <h3><span class="color-blue-prof bold">Answer:</span></h3>
                    <p>
                        Good Morning,
                    </p>
                    <p>
                        Thanks for your questions.
                    </p>
                    <p>
                        Lovely pictures! The key to creating an elegant and graceful look, and avoiding making ourselves look older, is understanding our body shape and proportion and then dressing it accordingly.
                        From the images provided, it appears that you have an hourglass figure. Lucky you! Only 8.4% of women have this body shape. You are the envy of all the other figure types! Women with pear, apple and rectangle shape bodies are always trying to add balance to their silhouette in order to create the illusion of an hour glass.
                    </p>
                    <p>
                        You are in the company of beauties such as Marilyn Monroe, Sophia Loren, Beyonce, Kim Kardashian and Scarlett Johansson.
                    </p>
                    <p>
                        <img src="{{ url()->to('/').'/images/example_c1.png' }}">
                        <img src="{{ url()->to('/').'/images/example_c2.png' }}">
                        <img src="{{ url()->to('/').'/images/example_c3.png' }}">
                        <img src="{{ url()->to('/').'/images/example_c4.png' }}">
                        <img src="{{ url()->to('/').'/images/example_c5.png' }}">
                    </p>
                    <p>
                        As you naturally have that balance to your figure, you can accentuate your curves, and create beautiful outfits. The best thing about the hourglass figure is that it oozes femininity – make the most of it to avoid looking older!
                    </p>
                    <p>
                        As an hour glass shape, you should:
                        <ul>
                            <li>- Highlight your curves.</li>
                            <li>- Make your cinched waist the focal point of your outfits.</li>
                            <li>- Proportionally balance your upper and lower body simultaneously.</li>
                        </ul>
                    </p>
                    <p>
                        Here are some hints and tips of how to combine – and make the most of your clothes – to best suit your figure.
                        <ul>
                            <li>1. Make sure all your underwear is well fitting; to look and feel wonderful in any outfit, it is important that you set the standard with your undergarments. Ensuring your bra is well fitted will offer good support and keep your curves in all the right places – this is especially important for the hourglass woman!</li>
                            <li>2. Choose fitted options to show off your curves. Fitted doesn’t have to mean tight, so you can maintain comfort if you are not comfortable in tight clothing.</li>
                            <li>3. Avoid baggy and boxy cuts. In order to maintain the hourglass shape, it is important to maintain the integrity of your waist, otherwise you are covering up the smallest width of your body and creating the illusion that you are bigger that you actually are.</li>
                            <li>4. Where possible, opt for light-weighted and thinner fabrics rather than bulky and thick textures. Cotton and silk, or even thin needs, will glide over your shape and create a much more flattering image.</li>
                            <li>5. Choose waist defined coats and jackets to create structure and flatter, no matter the weather!</li>
                        </ul>
                    </p>
                    <p>
                        You can find out more about choosing flattering clothes specifically for your shape, here: <i>(URL)</i>
                    </p>
                    <p>
                        We also LOVE this Pinterest board, which includes loads of inspiration for gorgeous outfits for your body type: <i>(URL)</i>
                    </p>
                    <p>
                        However, for a gorgeous, elegant look for you this festive season, these are our essential picks:
                        <ul>
                            <li>
                                <b>1. Black Velvet thigh split embellished dress (River Island)</b><br/>
                                This dress will bring you bang up to date, with this seasons must have fabric – velvet. A little black dress is always classic and slimming and the length will flatter your shape perfectly.
                                <i>(LINK)</i>
                            </li>
                            <li>
                                <b>2. Navy Glitter Court Shoes (River Island)</b><br/>
                                These courts will add the perfect amount of sass for festive season.
                                <i>(LINK)</i><br/>
                                Or, to keep the look more classic, opt for these grey satin courts <i>(LINK)</i>
                            </li>
                            <li>
                                <b>3. Team with this statement clutch to complete the look</b> <i>(LINK)</i>
                            </li>
                        </ul>
                    </p>
                    <hr/>
                </div>

                <div class="row example mt-15px">
                    <h3><span class="color-pink bold">Question 2:</span></h3>
                    <h4>
                        Dear Style Expert!I had the same hair style – long and blond and straight hair forever! I’m
                        looking to refresh thus what would you recommend? Maybe changing my hair colour, or there are easy
                        ways of pinning them up quickly in the mornings?
                    </h4>
                    <p>Female (1 photo attached)</p>
                    <h3><span class="color-blue-prof bold">Answer:</span></h3>
                    <p>
                        Hi,
                    </p>
                    <p>
                        Unfortunately we don’t all have hair stylists on hand to help us keep our locks
                        looking fabulous and refreshed. I know it can be too difficult to find a new look, and
                        if we don’t have any current ideas we tend to keep our hair the same.
                        As winter is approaching why not try a darker tone.
                        I would suggest the less painful way to approach this would to slowly make a
                        change.
                    </p>
                    <p>
                        If you are scared to transition quickly to being a brunette or a dark haired babe- A
                        small suggestion could be to replace any chunky, over-bleached blonde highlights
                        with darker blondes that are subtle and frame your face.
                    </p>
                    <p>
                        In regards to hairstyles, why not try a faux bob?
                        This hair trend was big last year, and is easy to achieve at home. It’s a great style fix
                        and can create a shock factor when people initially think you’ve been brave and
                        taken the chop. This is great for medium/long hair and easy to achieve at home. It
                        only takes a couple of clear elastic hair bands, some grips, product and a couple of
                        mirrors to master this technique. If you like this, Why not go for the actual chop?
                        To mix up your daily hairstyles why not try a half bun.
                    </p>
                    <p>
                        The half bun is the sort of magical hairstyle achieved from indecision: hair up or hair
                        down? Bun or top-knot? The result is a hairstyle that can be roughed up at the roots
                        for an easy daytime look or slicked back for a high-impact evening moment.
                        Spritz your hair with a shine-free salt spray for texture and backcomb the top
                        section of your hair for volume before gathering into a bun.
                    </p>
                    <p>
                        If you take my advice and try for a few new highlights, a great pairing would be to
                        add an easy beach wave. There’s a well-known hack behind getting easy laid-back
                        beach waves that’s quick and ingenious. Try parting your hair into inch-wide
                        sections, plaiting them and using a flat iron on those plaits to be left with cool girl
                        curls.
                    </p>
                    <p>
                        If all else fails, try these simple hair tips for when you make that hair appointment.
                    </p>
                    <ul>
                        <li>1. A classic bob cut with a slight off-centre parting is great for framing an oval face.</li>
                        <li>2. Using a flat hair can weigh the face down and that is exactly what you don’t want
                            if you have an oval face, as it will make it appear longer.</li>
                        <li>3. Sleek, healthy-looking hair works for dressing down in the day and for more
                            glamorous evening events.</li>
                        <li>4. An a-line fringe and the root volume break up an oval face shape. The volume at
                            the roots and the sweeping side fringe softens her oval face and detracts focus from
                            the shape as the hair cuts at the cheekbone.</li>
                    </ul>
                    <hr/>
                </div>

                <div class="row example mt-15px">
                    <h3><span class="color-pink bold">Question 3:</span></h3>
                    <h4>
                        Hi, can you please help me! I find it difficult to find the right frame glasses that would
                        actually suit my face shape . It is quite wide and oval. I can’t wear contact lenses because of the
                        environment I work in.
                    </h4>
                    <p>Female, 23 years (1 photo attached)</p>
                    <h3><span class="color-blue-prof bold">Answer:</span></h3>
                    <p>
                        Hello,
                    </p>
                    <p>
                        <img src="{{ url()->to('/').'/images/example_e1.png' }}">
                    </p>
                    <p>
                        Based on your photograph, it looks like you have a round face. A round face is very feminine and there are lots of glasses on the market that will make the most of your amazing features.
                    </p>
                    <p>
                        <b>Facial Features:</b> You have full cheeks, a rounded chic and full length and width.
                    </p>
                    <p>
                        <b>Frames to try:</b> Angular and geometric frames such as rectangular and horizontal styles.Look for strong details and decorations, wider than tall frames and nose pads for height.
                    </p>
                    <p>
                        <b>Frames to avoid:</b> Small frames don’t do anything for round faces. Round frames will make your face look even rounder.
                    </p>
                    <p>
                        <b>Celebrity Inspirations:</b> Cameron Diaz, Christina Ricci and Kristin Dunst
                    </p>
                    <p>
                        <img src="{{ url()->to('/').'/images/example_e2.png' }}">
                    </p>
                    <h4>
                        Great frames that will suit your face:
                    </h4>
                    <ul>
                        <li>
                            <img src="{{ url()->to('/').'/images/example_e3.png' }}">
                        </li>
                        <li>
                            <i>(LINK)</i>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <img src="{{ url()->to('/').'/images/example_e4.png' }}">
                        </li>
                        <li>
                            <i>(LINK)</i>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <img src="{{ url()->to('/').'/images/example_e5.png' }}">
                        </li>
                        <li>
                            <i>(LINK)</i>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <img src="{{ url()->to('/').'/images/example_e6.png' }}">
                        </li>
                        <li>
                            <i>(LINK)</i>
                        </li>
                    </ul>
                </div>
                <div class="clearboth"></div>

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

    </section>
    @include('frontend/footer')
@stop