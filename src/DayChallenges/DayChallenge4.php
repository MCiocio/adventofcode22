<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;
use Exception;

class DayChallenge4 extends DayChallengeBase
{

    public function printFirstPartSolution(): void
    {
        // Containings
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $total_range_containing = 0;
        $total_range = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            list($elf1_min, $elf1_max) = explode('-', $row[0]);
            list($elf2_min, $elf2_max) = explode('-', $row[1]);
            $elf1_min = intval($elf1_min);
            $elf1_max = intval($elf1_max);
            $elf2_min = intval($elf2_min);
            $elf2_max = intval($elf2_max);
            $total_range++;
            if (($elf1_min >= $elf2_min && $elf1_max <= $elf2_max) || ($elf1_min <= $elf2_min && $elf1_max >= $elf2_max) ) {
                $total_range_containing++;
            }
        }
        PrintCmnFns::printRow('Il numero di range che sono contenuti uno nell\'altro è: ', "$total_range_containing/$total_range");

    }

    public function printSecondPartSolution(): void
    {
        // Overlapping
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $total_range_overlapping = 0;
        $total_range = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            list($elf1_min, $elf1_max) = explode('-', $row[0]);
            list($elf2_min, $elf2_max) = explode('-', $row[1]);
            $elf1_min = intval($elf1_min);
            $elf1_max = intval($elf1_max);
            $elf2_min = intval($elf2_min);
            $elf2_max = intval($elf2_max);
            $total_range++;
            if (($elf1_min <= $elf2_max || $elf1_max <= $elf2_min) && ($elf1_min >= $elf2_min || $elf1_max >= $elf2_min )) {
                if ($total_range > 100 && $total_range < 150) 
                    PrintCmnFns::printCode($row[0] . ' | ' . $row[1]);
                $total_range_overlapping++;
            } else {
                // PrintCmnFns::printCode($row[0] . ' | ' . $row[1]);
            }

        }
        PrintCmnFns::printRow('Il numero di range che sono si overlappano è: ', "$total_range_overlapping/$total_range");
    }
}