{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}


<div class="card box-outline box-shadow box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header"><i class="fas fa-chart-area"></i> <span class="text-success">Statistics</span></div>
    <div class="card-body inverse-text">
        <p>
            Total posts <strong>{{$total_posts = DB::table("posts")->count()}}</strong> • Total topics <strong>{{$total_topics = DB::table("topics")->count()}}</strong> • Total members <strong>{{$total_members = DB::table("users")->count()}}</strong> • Our newest member <strong><a href="/user/{{DB::table("users")->latest()->value('slug')}}" class="username readable" style="font-weight: 600; color:{{\App\User::find(\App\Topic::getLatestInForum($forum->id)->author)->roles->first()->color}};">{{$latest_member = DB::table("users")->latest()->value('display_name')}}</a></strong>
        </p>
    </div>
</div>
