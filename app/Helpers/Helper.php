<?php

namespace App\Helpers;
use DateTime;
class Helper
{
    public static function minsAgo(string $dateTime)
    {
        $start_date = time();
        $ago = $start_date - strtotime($dateTime);

        if($ago < 60){
            return trans('common.moments_ago');
        }elseif($ago < 3600){
            return floor($ago/60) . ' ' . trans('common.minutes') . ' ' . trans('common.ago');
        }else{
            return date( "H:i:s, m/d/Y", strtotime($dateTime));
        }
    }

    public static function daysTill(string $dateTime){

        $cdate = mktime(0, 0, 0, 12, 31, 2009, 0);
        $today = time();
        $difference = $cdate - $today;
        if ($difference < 0) { $difference = 0;
            return trans('common.today');
        }else {
            return floor($difference / 60 / 60 / 24);
        }

    }
}
