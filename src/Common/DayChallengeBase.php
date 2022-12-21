<?php

namespace AdventCode\Common;

use ReflectionClass;

abstract class DayChallengeBase implements DayChallengeInterface
{
    public function getTitle(): string
    {
        $class_name = (new ReflectionClass($this))->getShortName();
        $number = substr($class_name, -1);
        return "Day $number";
    }
    
    abstract protected function openStream();
}