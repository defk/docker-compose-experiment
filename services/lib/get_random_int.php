<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 16.07.19, 7:29
 */

/**
 * @param int $min
 * @param int $max
 *
 * @return int
 */
function getRandomInt(int $min, int $max): int
{

    if ($min > $max) {

        [$min, $max] = [$max, $min];
    }

    try {

        $sleep = random_int($min, $max);
    } catch (Exception $e) {

        $sleep = mt_rand($min, $max);
    }

    return $sleep;
}