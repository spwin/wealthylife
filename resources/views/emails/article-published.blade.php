@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>
        Your Article has been published on the StyleSensei page. You can view it by clicking this link: <a href="{{ $params['link'] }}">{{ $params['link'] }}</a>
    </p>
</div>
@endsection