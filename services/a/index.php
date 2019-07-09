<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 09.07.19, 7:43
 */

const SERVICE_NAME = 'a_service';
const VERSION_NAME = '1.0.4';
const SLEEP_MIN = 2500;
const SLEEP_MAX = 5000;

$guid = getGUID();

while (true) {

    output(
        vsprintf(
            '[%s]: Service: %s [vesrion: %s], sleep: %.3f s',
            [
                $guid,
                SERVICE_NAME,
                VERSION_NAME,
                ($sleep = sleep_time()) / 1000,
            ]
        )
    );

    usleep($sleep * 1000);
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
function sleep_time(int $min = SLEEP_MIN, int $max = SLEEP_MAX): int
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