<?php

namespace App\Enums;

    class PriorityEnum
    {
        const Low = 1;
        const Middle = 2;
        const High = 3;

        
        public static function Labels(){
            return [
                self::Low => 'Low',
                self::Middle => 'Middle',
                self::High => 'High',
            ];
        }
}