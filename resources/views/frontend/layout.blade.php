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
@stack('scripts')
</body>
</html>
