{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

<div class="card box-outline box-shadow box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header"><i class="fas fa-globe"></i> <span class="text-success">Online Users</span></div>
    <div class="card-body inverse-text text-success readable">

            @php
                $activeUsers = App\Http\Controllers\SessionsController::activeUsers();
                $usersArray = array();
                foreach ($activeUsers as $activeUser){
                    if(!empty($activeUser->user_id)){
                        $user = App\User::getDisplayName($activeUser->user_id);
                        $userLink = '<a href="'.$activeUser->user_id.'">'.$user.'</a>';
                        array_push($usersArray, $userLink);
                    }
                }
                echo implode(', ', $usersArray);

                if(empty($usersArray)){ echo 'There is no one online right now.';}

            @endphp



    </div>
</div>
