@extends('admin/layout')
@section('body-class', 'hold-transition skin-black sidebar-mini')
@section('wrapper')
    <div class="wrapper">
        @include('admin/header')
        @include('admin/sidebar')
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
        @include('admin/footer')
        @include('admin/control')
    </div>
    <!-- ./wrapper -->
@stop