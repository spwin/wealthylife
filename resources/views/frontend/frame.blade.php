@extends('frontend/layout')
@section('wrapper')
    @include('frontend/navigation')
    <div id="panel" class="main-container">
        @yield('content')
    </div>
    @include('frontend/modals')
@stop