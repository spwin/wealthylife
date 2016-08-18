@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>Almost done! Please click <a href="{{ action('UserController@confirmation', ['key' => $params['key']]) }}">this link</a> to confirm your email and to complete your registration.</p>
    <br/>
</div>
@endsection