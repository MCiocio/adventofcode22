<?php
namespace AdventCode\Common;
use AdventCode\DayChallanges\DayChallenge1;
use AdventCode\Common\DayChallengeInterface;
class DayChallengeFactory
{
    public static function factory(int $day): ?DayChallengeInterface
    {
        $class_name = 'DayChallenge'.$day;
        if (class_exists($class_name)){
            return new $class_name();
        }
        return null;
    }
}