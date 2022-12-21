<?php

namespace AdventCode\Common;

interface DayChallengeInterface
{
    public function printFirstPartSolution(): void;

    public function printSecondPartSolution(): void;

    public function getTitle(): string;
}