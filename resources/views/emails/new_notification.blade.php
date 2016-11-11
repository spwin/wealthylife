<html>
<body>
    <div>
        Dear <strong> {{ $user->first_name.' '.$user->last_name }},</strong><br/>
        You have new notification.<br/>
        <h3>{{ $notification->subject }}</h3>
        <p>{{ $notification->body  }}</p>
        <br/>
        You can also see on in your profile by clicking
        <a href="{{ action('FrontendController@notifications') }}">here</a>
        <p>
            <strong>STYLE</strong>SENSEI<br/>
            <a href="{{ url()->to('/') }}">www.stylesensei.co.uk</a>
        </p>
    </div>
</body>
</html>