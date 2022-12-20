<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;
use Exception;

class DayChallenge2 extends DayChallengeBase
{
    private const ROCK = 'A';
    private const PAPER = 'B';
    private const SCISSOR = 'C';
    private const MYROCK = 'X';
    private const MYPAPER = 'Y';
    private const MYSCISSOR = 'Z';
    private const DEFEAT = 'DEFEAT';
    private const WIN = 'WIN';
    private const DRAW = 'DRAW';
    protected $title = 'Day Two';
    protected $legends_pt1 = [
        self::MYROCK    => 1,
        self::MYPAPER   => 2,
        self::MYSCISSOR => 3,
        self::DEFEAT    => 0,
        self::DRAW      => 3,
        self::WIN       => 6,
    ];

    public function printFirstPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->title . ' PT1');
        $fp = fopen('csv/day2/strategy.csv', 'r');
        $my_total_score = 0;
        $total_win = 0;
        $total_draw = 0;
        $total_defeat = 0;
        $total_battles = 0;
        while ($row = fgetcsv($fp)) {
            list($response, $myresponse) = explode(' ', $row[0]);
            $score = $this->legends_pt1[$myresponse];
            $outcome = $this->getOutcome($response, $myresponse);
            $score += $this->legends_pt1[$outcome];
            $my_total_score += $score;
            if ($this->isWin($response, $myresponse)) {
                $total_win++;
            } elseif ($this->isDraw($response, $myresponse)) {
                $total_draw++;
            } else {
                $total_defeat++;
            }
            $total_battles++;
        }

        PrintCmnFns::printRow('Il numero delle mie vittorie è: ', "$total_win/$total_battles");
        PrintCmnFns::printRow('Il numero delle mie sconfitte è: ', "$total_defeat/$total_battles");
        PrintCmnFns::printRow('Il numero dei miei paregggi è: ', "$total_draw/$total_battles");
        PrintCmnFns::printRow('Il mio punteggio totale è:', $my_total_score);
    }

    public function printSecondPartSolution(): void
    {
    }

    private function isWin(string $response, string $myresponse): bool
    {
        return
            $response === self::ROCK && $myresponse === self::MYPAPER
            || $response === self::PAPER && $myresponse === self::MYSCISSOR
            || $response === self::SCISSOR && $myresponse === self::MYROCK;
    }

    private function isDraw(string $response, string $myresponse): bool
    {
        return
            $response === self::ROCK && $myresponse === self::MYROCK
            || $response === self::PAPER && $myresponse === self::MYPAPER
            || $response === self::SCISSOR && $myresponse === self::MYSCISSOR;
    }

    private function getOutcome($response, $myresponse): string
    {
        return $this->isWin($response, $myresponse) ? self::WIN : ($this->isDraw($response, $myresponse) ? self::DRAW : self::DEFEAT);
    }
}