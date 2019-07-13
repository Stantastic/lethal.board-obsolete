<?php

namespace App\Helpers;
use DateTime;
class Helper
{
    public static function minsAgo($dateTime)
    {
        $start_date = time();
        $ago = $start_date - strtotime($dateTime);

        if (empty($dateTime)){
            return 'Never';
        }
        if($ago < 60){
            return trans('common.moments_ago');
        }elseif($ago < 3600){
            return floor($ago/60) . ' ' . trans('common.minutes') . ' ' . trans('common.ago');
        }else{
            return date( "H:i:s, m/d/Y", strtotime($dateTime));
        }
    }

    public static function daysTill($dateTime){

        $cdate = strtotime($dateTime);
        $today = time();
        $difference = $cdate - $today;
        if ($difference < 0) { $difference = 0;
            return trans('common.today');
        }else {
            return floor($difference / 60 / 60 / 24);
        }

    }

    public static function nextBDay($dateTime){
        $birthdate = date( "d-m-Y", strtotime($dateTime));
        $current_date = date("d-m-Y");

        $birth_time = strtotime($birthdate);
        $current_time = strtotime($current_date);

        $arr1 = explode("-", $birthdate);
        $year1 = $arr1[2];

        $arr2 = explode("-", $current_date);
        $year2 = $arr2[2];

        $year_diff = $year2-$year1;

        $time_new = strtotime("+".$year_diff." year", $birth_time);

        if($time_new<$current_time)
        {
            $time_new = strtotime("+1 year", $time_new);
        }

        $time_diff = $time_new - $current_time;

        $days = $time_diff/86400;

        if ($days < 1){
            $left = trans('common.today');
        }elseif ($days == 1) {
            $left = $days . ' ' . trans('common.day') . ' ' . trans('common.left');
        }else{
            $left = $days . ' ' . trans('common.days') . ' ' . trans('common.left');
        }

        return $left;
    }
}
