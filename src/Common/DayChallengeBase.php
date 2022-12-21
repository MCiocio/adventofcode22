<?php

namespace AdventCode\Common;

use ReflectionClass;

abstract class DayChallengeBase implements DayChallengeInterface
{
    public function getTitle(): string
    {
        $number = $this->getDayNumber();
        return "Day $number";
    }

    protected function openStream()
    {
        $daynumber = $this->getDayNumber();
        return fopen("csv/day$daynumber/input.csv", 'r');
    }
    
    protected function getDayNumber(): int
    {
        $class_name = (new ReflectionClass($this))->getShortName();
        $number = substr($class_name, -1);
        return intval($number);
    }
}