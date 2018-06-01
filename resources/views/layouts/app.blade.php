@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/skin-blue.min.css') }}">

    @yield('styles')
@endsection

@section('body')
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('home') }}" class="logo">
                    <span class="logo-mini"><b>{{ config('app.initial') }}</b></span>
                    <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
                </a>

                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('profile.index') }}">
                                    <span class="hidden-xs">Welcome, {{ Auth::user()->name }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="hidden-xs">Sign out</span>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
                        @if (! $isUser)
                            <li><a href="{{ route('admins.index') }}"><i class="fa fa-users"></i> <span>Admins</span></a></li>
                            <li><a href="#"><i class="fa fa-building"></i> <span>Outlets</span></a></li>
                            <li><a href="{{ route('schedules.index') }}"><i class="fa fa-calendar"></i> <span>Schedules</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
                            <li><a href="#"><i class="fa fa-users"></i> <span>Users</span></a></li>
                        @endif
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        @yield('header')
                    </h1>

                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} {{ config('app.name') }}</strong>
            </footer>
        </div>
    </body>
@endsection

@section('js')
    <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    @yield('javascript')
@endsection
