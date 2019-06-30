{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

    <nav class="nav nav-fill nav-simple flex-column flex-sm-row box-shadow box-outline box-dark">
        @can('acp-edit-settings')
            <div class=" nav-item dropdown text-sm-center nav-link">
                <a class=" dropdown-toggle pointer" type="link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sliders-h fa-fw direct-text"></i> @lang('common.board_settings')
                </a>
                <div class="dropdown-menu subnav-dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        @endcan
        @can('acp-edit-nodes')
            <div class=" nav-item dropdown text-sm-center nav-link">
                <a class=" dropdown-toggle pointer" type="link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sitemap fa-fw direct-text"></i> @lang('common.categories_forums')
                </a>
                <div class="dropdown-menu subnav-dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/acp/nodes"><i class="fas fa-fw fa-sitemap"></i> List Nodes</a>
                    <a class="dropdown-item" href="/acp/nodes/link/create"><i class="fas fa-fw fa-link"></i> Add Link</a>
                    <a class="dropdown-item" href="/acp/nodes/forum/create"><i class="fas fa-fw fa-folder"></i> Add Forum</a>
                    <a class="dropdown-item" href="/acp/nodes/category/create"><i class="fas fa-fw fa-bars"></i> Add Category</a>
                </div>
            </div>
        @endcan
        @can('acp-edit-users')
            <div class=" nav-item dropdown text-sm-center nav-link">
                <a class=" dropdown-toggle pointer" type="link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users-cog fa-fw direct-text"></i> @lang('common.users')</a>
                </a>
                <div class="dropdown-menu subnav-dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        @endcan
        @can('acp-edit-roles')
            <div class="nav-item dropdown text-sm-center nav-link">
                <a class=" dropdown-toggle pointer" type="link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-shield-alt fa-fw direct-text"></i> @lang('common.roles_permissions')
                </a>
                <div class="dropdown-menu subnav-dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        @endcan
        @can('acp-edit-communication')

            <div class="nav-item dropdown text-sm-center nav-link">
                <a class=" dropdown-toggle pointer" type="link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bullhorn fa-fw direct-text"></i> @lang('common.communication')
                </a>
                <div class="dropdown-menu subnav-dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        @endcan
    </nav>
