@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>You can now change your {{ env('APP_NAME') }} account password by clicking this link: </p>
    <p><a href="{{ action('FrontendController@newPassword', ['token' => $params['token']]) }}">{{ action('FrontendController@newPassword', ['token' => $params['token']]) }}</a></p>
    <br/>
</div>
@endsection