<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 09.07.19, 7:43
 */

const SERVICE_NAME = 'c_service';
const VERSION_NAME = '1.0.4';
const SLEEP_MIN = 2500;
const SLEEP_MAX = 5000;
const RANDOM_CRASH_RATE = 50;
const IS_RANDOM_CRASH = true;

$guid = getGUID();

while (true) {

    if (IS_RANDOM_CRASH) {

        randomCrash();
    }

    output(
        vsprintf(
            '[%s]: Service: %s [vesrion: %s], sleep: %.3f s',
            [
                $guid,
                SERVICE_NAME,
                VERSION_NAME,
                ($sleep = getRandomInt(SLEEP_MIN, SLEEP_MAX)) / 1000,
            ]
        )
    );

    usleep($sleep * 1000);
}

/**
 * @param int $rate
 *
 * @throws Exception
 */
function randomCrash(int $rate = RANDOM_CRASH_RATE): void
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

/**
 * @return string
 */
function getGUID(): string
{

    try {

        $content = random_bytes(64 * 1024);
    } catch (Exception $e) {

        $content = uniqid(mt_rand(0, 1000000)).microtime(true);
    }
    $data = md5($content);

    return
        strtoupper(
            implode(
                '-',
                [
                    substr($data, 0, 8),
                    substr($data, 8, 4),
                    substr($data, 12, 4),
                    substr($data, 16, 4),
                    substr($data, 20, 12),
                ]
            )
        );
}


/**
 * @param string $message
 */
function output(string $message): void
{

    echo $message, PHP_EOL;
}

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