<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />

        <title> @yield('title') | Rolsoftware</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ env('APP_DESCRIPTION') }}" name="description" />
        <meta content="Rolsoftware" name="author" />

        <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

        @include('layouts.head-css')
    </head>

    @section('body')
        <body data-sidebar="dark" data-layout-mode="light">
    @show
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>

        @if(isset($filter_page))
            @include($filter_page)
        @endif

        @include('layouts.vendor-scripts')

    </body>

</html>
