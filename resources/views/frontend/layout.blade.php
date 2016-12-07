<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('page-title', trans('seo.main.title'))</title>
    <meta name="description" content="@yield('meta-description', trans('seo.main.description'))">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    @yield('meta-content')
{{--<link rel="alternate" href="{{ url()->to('/') }}" hreflang="en-GB" />--}}
    <link href="{{ URL::to('/') }}/css/front-plugins.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/frontend.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/front-custom.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/fonts.css" rel="stylesheet">
</head>
<body class="@yield('body-class', 'default-class')">
@yield('after-body-snippet')
@yield('wrapper')
<div class="modal-container text-right">
    <a class="btn-modal" href="#"><div id="feedback-icon"></div></a>
    <div class="hidden">
        @include('frontend/elements/feedback')
    </div>
</div>
<div class="trigger-catcher"></div>
<script src="{{ URL::to('/') }}/js/front-plugins.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82199046-1', 'auto', {'legacyCookieDomain': '{{ url()->to('/') }}'});
  ga('send', 'pageview');

</script>
@stack('scripts')
</body>
</html>
