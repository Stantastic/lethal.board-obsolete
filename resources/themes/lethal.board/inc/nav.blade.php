{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark-20 fixed-top" style="margin-bottom: 20px; border-bottom: 1px inset #00f078; box-shadow: 0px 5px 5px 1px rgba(0,0,0,0.75);
">
    <a class="navbar-brand" href="/"><img src={{theme_url('img/logo-slogan.png')}} height="42" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Quick Nav
                </a>
                <div class="dropdown-menu dropdown-menu-right mainnav-dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile/edit">Control Panel</a>
              </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li>
                <a href="" class="nav-link"><i class="fas fa-server  fa-fw"></i> Servers
                </a>
            </li>
        </ul>

        <ul class="navbar-nav mr-auto">
            <li>
                <a href="" class="nav-link">
                    <i class="fas fa-question fa-fw"></i> FAQ
                </a>
            </li>
        </ul>

        @if (Auth::check())
        <ul class="navbar-nav d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-bell fa-fw" aria-hidden="true"></i> Notifications <span class="badge badge-success">0</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav mr-5 d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-envelope fa-fw " aria-hidden="true"></i> Messages <span class="badge badge-success">0</span>
                </a>
            </li>
        </ul>
        @endif

        @include('inc.nav-login')
    </div>
</nav>

