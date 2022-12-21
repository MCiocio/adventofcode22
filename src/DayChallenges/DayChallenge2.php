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
    private const DEFEAT_PT2 = 'X';
    private const DRAW_PT2 = 'Y';
    private const WIN_PT2 = 'Z';
    protected $legends_pt1 = [
        self::MYROCK    => 1,
        self::MYPAPER   => 2,
        self::MYSCISSOR => 3,
        self::DEFEAT    => 0,
        self::DRAW      => 3,
        self::WIN       => 6,
    ];
    protected $outcome_legend = [
        self::ROCK    => [
            'towin'  => self::MYPAPER,
            'tolose' => self::MYSCISSOR,
            'todraw' => self::MYROCK,
        ],
        self::PAPER   => [
            'towin'  => self::MYSCISSOR,
            'tolose' => self::MYROCK,
            'todraw' => self::MYPAPER,
        ],
        self::SCISSOR => [
            'towin'  => self::MYROCK,
            'tolose' => self::MYPAPER,
            'todraw' => self::MYSCISSOR,
        ],
    ];

    protected function openStream()
    {
        return fopen('csv/day2/strategy.csv', 'r');
    }

    public function printFirstPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $my_total_score = 0;
        $total_win = 0;
        $total_draw = 0;
        $total_defeat = 0;
        $total_battles = 0;
        $fp = $this->openStream();
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

    /**
     * @throws Exception
     */
    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $my_total_score = 0;
        $total_win = 0;
        $total_draw = 0;
        $total_defeat = 0;
        $total_battles = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            list($response, $outcome) = explode(' ', $row[0]);
            // PrintCmnFns::printSimpleRow($outcome);
            $myresponse = $this->getResponseToGive($response, $outcome);
            $score = $this->legends_pt1[$myresponse];

            if ($this->isWin($response, $myresponse)) {
                $total_win++;
                $score += 6;
            } elseif ($this->isDraw($response, $myresponse)) {
                $total_draw++;
                $score += 3;
            } else {
                $total_defeat++;
            }
            $my_total_score += $score;
            $total_battles++;
        }
        PrintCmnFns::printRow('Il numero delle mie vittorie è: ', "$total_win/$total_battles");
        PrintCmnFns::printRow('Il numero delle mie sconfitte è: ', "$total_defeat/$total_battles");
        PrintCmnFns::printRow('Il numero dei miei paregggi è: ', "$total_draw/$total_battles");
        PrintCmnFns::printRow('Il mio punteggio totale è:', $my_total_score);
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

    /**
     * @throws Exception
     */
    private function getResponseToGive(string $response, string $outcome)
    {
        switch ($outcome) {
            case self::DEFEAT_PT2:
                $myresponse = $this->outcome_legend[$response]['tolose'];
                break;
            case self::DRAW_PT2:
                $myresponse = $this->outcome_legend[$response]['todraw'];
                break;
            case self::WIN_PT2:
                $myresponse = $this->outcome_legend[$response]['towin'];
                break;
            default:
                throw new Exception('Outcome Not Managed');
        }
        return $myresponse;
    }
}