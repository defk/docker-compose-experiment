<?php
/**
 * Created by PhpStorm.
 * User: Andrey V Senko
 * DateTime: 16.07.19, 7:34
 */

require_once __DIR__.'/get_guid.php';
require_once __DIR__.'/get_random_int.php';
require_once __DIR__.'/output.php';
require_once __DIR__.'/random_crash.php';

class Service
{

    private $guid;

    private $serviceName;
    private $versionName;
    private $isRandomCrash;
    private $randomCrashRate;

    public function __construct()
    {

        $this->guid = getGUID();
    }

    /**
     * @param string $serviceName
     * @param string $versionName
     * @param bool   $isRandomCrash
     * @param int    $randomCrashRate
     *
     * @return Service
     */
    public function configure(string $serviceName, string $versionName, bool $isRandomCrash, int $randomCrashRate): self
    {

        $this->serviceName = $serviceName;
        $this->versionName = $versionName;
        $this->isRandomCrash = $isRandomCrash;
        $this->randomCrashRate = $randomCrashRate;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {

        while (true) {

            if (IS_RANDOM_CRASH) {

                randomCrash($this->randomCrashRate);
            }

            output(
                vsprintf(
                    '[%s]: Service: %s [version: %s], sleep: %.3f s',
                    [
                        $this->guid,
                        $this->serviceName,
                        $this->versionName,
                        ($sleep = getRandomInt(SLEEP_MIN, SLEEP_MAX)) / 1000,
                    ]
                )
            );

            usleep($sleep * 1000);
        }
    }
}

return new Service();