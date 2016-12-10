@extends('emails.layout')
@section('email-content')
<div>
    Dear {{ $params['user']->first_name.' '.$params['user']->last_name }},<br/>
    <p>
        Your question is sent to our style experts for review. Kindly wait for our team to get back to you with an answer shortly. Once your question has been answered, we will notify you via email so that you can check it out.
    </p>
</div>
@endsection