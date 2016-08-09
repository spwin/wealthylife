<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Foundry Multi-purpose HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::to('/') }}/css/front-plugins.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/frontend.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/front-custom.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/fonts.css" rel="stylesheet">
</head>
<body class="scroll-assist">
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
