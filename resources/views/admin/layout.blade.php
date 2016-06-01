<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FIT sensei | Dashboard</title>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::to('/') }}/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ URL::to('/') }}/css/admin.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="@yield('body-class')">
@yield('header')
@yield('wrapper')
<script src="{{ URL::to('/') }}/js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="{{ URL::to('/') }}/js/admin/bootstrap.min.js"></script>
<script src="{{ URL::to('/') }}/js/admin/app.min.js"></script>
<script src="{{ URL::to('/') }}/js/plugins.js"></script>
@stack('scripts')
</body>
</html>