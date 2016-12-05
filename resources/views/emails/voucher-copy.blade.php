@extends('emails.layout')
@section('email-content')
<div>
    <p>This is a copy of a voucher sent to <strong>{{ $params['voucher']->receiver_email }}</strong>:</p>
    Hey Lucky!<br/>
    <p>You have just received a gift voucher from StyleSensei sent to you as a present{{ $params['voucher']->anonymous ? '' : ' by '.$params['user']->first_name.' '.$params['user']->last_name }}. You can use this gift voucher on Stylesensei to get style, image, and fashion advice. Click <a href="{{ action('FrontendController@vouchers') }}">here</a> to log in, redeem your voucher credits and get started!</p>
    @if($params['voucher']->message)
        <p style="font-style: italic;">{{ $params['voucher']->message }}</p>
    @endif
    <p>Your Voucher Code: <span style="font-size: 16px;"><strong>{{ $params['voucher']->code }}</strong></span></p>
</div>
@endsection