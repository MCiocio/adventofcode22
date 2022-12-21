<?php

namespace AdventCode\Common;

use Exception;

class DayChallengeFactory
{
    private const NAMESPACE = "AdventCode\\DayChallenges\\";

    /**
     * @throws Exception
     */
    public static function factory(int $day): ?DayChallengeInterface
    {
        $class = self::NAMESPACE . 'DayChallenge' . $day;
        // return new DayChallenge1();
        if (class_exists($class)) {
            // if($class instanceof DayChallengeInterface){
            return new $class();
            // }
        }
        throw new Exception('DayChallange not defined for this day');
    }
}