{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | {{ config('app.name', 'lethal.Board') }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#9f9f9f">
        <meta name="theme-color" content="#00f078">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('inc.head-scripts')
    </head>
    <body>
        @include('inc.nav')
    <div class="container container-fluid" style="margin-top: 75px;" >
        @yield('breadcrumb')
        @include('inc.announcements')


        @include('inc.alerts')
        @yield('content')
        @yield('widgets')

        <div style="height: 70px;"></div>
    </div>

        @include('inc.footer')
        @include('inc.body-scripts')
    </body>
</html>
