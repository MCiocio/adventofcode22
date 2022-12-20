<?php
namespace AdventCode\Common;
use AdventCode\Common\DayChallengeInterface;

abstract class DayChallengeBase implements DayChallengeInterface
{
    protected $title;
    public function getTitle(): string
    {
        return $this->title;
    }
}