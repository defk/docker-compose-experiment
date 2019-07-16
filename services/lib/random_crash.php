<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 16.07.19, 7:28
 */

require_once __DIR__.'/get_random_int.php';

/**
 * @param int $rate
 *
 * @throws Exception
 */
function randomCrash(int $rate): void
{

    $isCrash = true;

    if ($rate < 100) {

        $isCrashExpect = [];

        for ($i = 0; $i < $rate; ++$i) {

            while (true) {

                $value = getRandomInt(0, 100);

                if (!isset($isCrashExpect[$value])) {

                    $isCrashExpect[$value] = $value;

                    break;
                }
            }
        }

        $isCrashActual = getRandomInt(0, 100);

        $isCrash = in_array($isCrashActual, $isCrashExpect);
    }

    if ($isCrash) {

        throw new Exception('Random crash!');
    }
}