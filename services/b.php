<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 09.07.19, 7:43
 */

const SERVICE_NAME = 'b_service';
const VERSION_NAME = '2.0.1';
const SLEEP_MIN = 2500;
const SLEEP_MAX = 5000;
const RANDOM_CRASH_RATE = 50;
const IS_RANDOM_CRASH = false;

(require __DIR__.'/lib/Service.php')
    ->configure(
        SERVICE_NAME,
        VERSION_NAME,
        IS_RANDOM_CRASH,
        RANDOM_CRASH_RATE
    )
    ->run();