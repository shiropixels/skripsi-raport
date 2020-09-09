<?php

namespace App\Support;

use Log;

class Utilities
{
    //Start time must be a year string! e.g 2019, 2020, 2021
    public static function createSchoolYear($start_year = null){
        try{
            $start = $start_year;
            if($start_year == null) $start = (int) date("Y");

            return [
                "start_year" => $start,
                "end_year" => (string) ((int) $start+1)
            ];
        }catch(\Throwable $e){
            Log::error('Not a string exception: '.$e->getMessage());
            return null;
        }
    }

    public static function createSemester(){
        $currentMonth = (int) date("m");

        if($currentMonth < 7)
            return 1;

        return 2;
    }
}