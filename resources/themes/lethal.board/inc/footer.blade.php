{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<footer class="footer mt-auto py-3 bg-dark-20" style="    box-shadow: 0px -5px 5px 1px rgba(0,0,0,0.75); border-top: 1px inset #00f078;">
    <div class="container">
        <span class="float-left">
            <a href="/" class="muted-a"><i class="fas fa-home"></i> @lang('common.index')</a>
            <a href="/team" class="muted-a"><i class="fas fa-user-shield ml-3"></i> @lang('common.team')</a>
            <a href="/members" class="muted-a"><i class="fas fa-users ml-3"></i> @lang('common.members')</a>
            <a href="https://github.com/Stantastic/lethal.board" class="muted-a"><i class="fab fa-github ml-3"></i> @lang('common.issues')</a>

            @can('acp-access')
                <a href="/acp" class="muted-a"><i class="fas fa-cogs ml-3"></i> @lang('common.admin_control_panel')</a>
            @endcan

        </span>
        <span class="float-right green">Made with <i class="fas fa-heart pulsate text-danger"></i> and <i class="fas fa-code text-success"></i></span>
    </div>
</footer>
