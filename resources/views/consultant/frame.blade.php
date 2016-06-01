@extends('consultant/layout')
@section('body-class', 'hold-transition skin-black sidebar-mini')
@section('wrapper')
    <div class="wrapper">
        @include('consultant/header')
        @include('consultant/sidebar')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content-header')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('consultant/footer')
        @include('consultant/control')
    </div>
    <!-- ./wrapper -->
@stop