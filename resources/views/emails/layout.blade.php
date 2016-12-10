<html>
<body>
<div>
    @yield('email-content')
    <p>Thank you for using our services.</p>
    <p>
        @include('emails.signature')
    </p>
</div>
</body>
</html>