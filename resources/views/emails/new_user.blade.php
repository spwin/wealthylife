<html>
<body>
    <div>
        Dear <strong> {{ $user->first_name.' '.$user->last_name }},</strong><br/>
        You have created new account, your confirmation link:<br/>
        <a href="{{ action('UserController@confirmation', ['key' => $key]) }}">Confirm my email</a>
    </div>
</body>
</html>