@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>
        Good news! Our experts have answered your question. Click <a href="{{ action('FrontendController@viewAnswer', ['id' => $params['question']->id]) }}">here</a> to view the answer in your Stylesensei answers inbox.
    </p>
</div>
@endsection