<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 16.07.19, 7:30
 */

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