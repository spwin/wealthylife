@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>
        Unfortunately, your question has been rejected. You have been refunded credits you used on StyleSensei system. Please click <a href="{{ action('FrontendController@viewAnswer', ['id' => $params['question']->id]) }}">here</a> to check the rejection reason.
    </p>
</div>
@endsection