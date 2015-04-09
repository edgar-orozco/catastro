<?php

class FechasHelper 
{

    public static function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = $start_date;
        $end_ts = $end_date;
        $user_ts = $evaluame;
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

}
