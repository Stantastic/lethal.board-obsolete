{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark-20" style="margin-bottom: 20px;">
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
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-bell fa-fw" aria-hidden="true"></i> Notifications <span class="badge badge-success">0</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-envelope fa-fw" aria-hidden="true"></i> Messages <span class="badge badge-success">0</span>
                </a>
            </li>
        </ul>

        @include('inc.nav-login')
    </div>
</nav>

