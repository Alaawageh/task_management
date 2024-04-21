<?php

namespace App\Enums;

    class StatusEnum
    {
        const Pending = 1;
        const in_progress = 2;
        const Done = 3;

        
        public static function Labels(){
            return [
                self::Pending => 'Pending',
                self::in_progress => 'Proccessing',
                self::Done => 'Done',
            ];
        }
}