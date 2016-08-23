<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('page-title', 'Professional image and style consultation online only £20')</title>
    <meta name="description" content="@yield('meta-description', 'Finding an answer to your style related questions has never been easier. With only few mouse clicks you can get great advice about your outfit from expert team.')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" href="{{ url()->to('/') }}" hreflang="en-GB" />
    <link href="{{ URL::to('/') }}/css/front-plugins.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/frontend.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/front-custom.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/fonts.css" rel="stylesheet">
</head>
<body class="scroll-assist">
@yield('after-body-snippet')
@yield('wrapper')
<script src="{{ URL::to('/') }}/js/front-plugins.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82199046-1', 'auto');
  ga('send', 'pageview');

</script>
@stack('scripts')
</body>
</html>
