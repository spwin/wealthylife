@extends('emails.layout')
@section('email-content')
<div>
    Dear <strong>{{ $params['user']->first_name.' '.$params['user']->last_name }}</strong>,<br/>
    <p>You are now a part of the stylish StyleSensei family. We are a group of fashion-forward
        individuals available to help you get your wardrobe and style sorted. If you have any questions about
        our team or our services, feel free to reach out to us by clicking <a href="{{ action('FrontendController@contacts') }}">here</a>. Starting a new relationship with
        you means a lot to us, which is why we will always be open to suggestions and feedback. If you would
        like to get fashion and styling tips from us on an on-going basis, stay in touch!</p>
</div>
@endsection