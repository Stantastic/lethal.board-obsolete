<?php

namespace App\Http\Controllers;

use App\Sessions;

class SessionsController extends Controller
{
    public function liveSessions()
    {

        // Get time session life time from config.
        $time = time() - (config('session.lifetime') * 1);

        // Total login users (user can be log on 2 devices will show once.)
        $totalActiveUsers = sessions::where('last_activity', '>=', $time)->count(DB::raw('DISTINCT user_id'));


    }

    public static function activeUsers(){
        $time = time() - (config('session.lifetime') * 60);
        // Total active sessions
        return $totalActiveUsers = sessions::where('last_activity', '>=', $time)->select('user_id','ip_address')->distinct()->get();
    }
}
