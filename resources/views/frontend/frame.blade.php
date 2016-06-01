@extends('frontend/layout')
@section('wrapper')
    @include('frontend/navigation')
    <div class="main-container">
        @yield('content')
    </div>
@stop