{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}


@if (Auth::check())

    @if(empty(\App\Profile::get(Auth::user()->id)->avatar) )
        <img src="{{ Avatar::create( Auth::user()->display_name)->toBase64() }}" width="40" height="40"/>
    @else
        <img src="{{ \App\Profile::get(Auth::user()->id)->avatar }}" width="40" height="40" class="rounded"/>
    @endif

    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('common.greeting'), {{{ isset(Auth::user()->display_name) ? Auth::user()->display_name : Auth::user()->email }}}
            </a>
            <div class="dropdown-menu dropdown-menu-right mainnav-dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/profile/edit">Control Panel</a>
                <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">View Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/conversations">Messages</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"> <button type="button" class="btn btn-danger btn-block"><i class="fas fa-sign-out-alt"></i> @lang('auth.logout')</button></a>
            </div>
        </li>
    </ul>
@else
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-sign-in-alt"></i> @lang('common.login_signup')
            </a>
            </a>
            <div class="dropdown-menu dropdown-menu-right mainnav-dropdown-menu direct-text" style="width: 250px; left: 40px!important;" aria-labelledby="navbarDropdown">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="email" >{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="password" >{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">



                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-check">

                                <div class="form-check abc-checkbox  abc-checkbox-success">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-10 offset-md-1">
                            <button type="submit" class="btn btn-success btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                        <div class="col-md-10 offset-md-1 mt-2">
                            <a href="/register" class="btn btn-danger btn-block">
                                {{ __('Register') }}
                            </a>
                        </div>

                </div>
            </div>
        </li>
    </ul>
@endif
