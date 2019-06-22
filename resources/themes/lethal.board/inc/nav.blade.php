{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark-20" style="margin-bottom: 20px;">
    <a class="navbar-brand" href="#"><img src={{theme_url('img/logo-slogan.png')}} height="42" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home2 <span class="sr-only">(current)</span></a>
            </li>
        </ul>


        <ul class="navbar-nav nav-center">
            <li class="nav-item">

            </li>
        </ul>


        @if (Auth::check())
            @if(empty(\App\Http\Controllers\User\UserDetailController::avatar(Auth::user()->id)) )
                <img src="{{ Avatar::create( isset(Auth::user()->display_name) ? Auth::user()->display_name : Auth::user()->email )->toBase64() }}" class="rounded" />
            @else
                <img src="{{ \App\Http\Controllers\User\UserDetailController::avatar(Auth::user()->id) }}" width="40" height="40" class="rounded"/>
            @endif
        @endif
        @include('inc.nav-login')
    </div>
</nav>

