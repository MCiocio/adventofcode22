<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;

class DayChallenge1 extends DayChallengeBase
{
    protected function openStream()
    {
        return fopen('csv/day1/calories.csv', 'r');
    }

    public function printFirstPartSolution(): void
    {
        PrintCmnFns::printTitle($this->getTitle() . ' PT1');
        $total_elf_num = 0;
        $saved_elf_num = 0;
        $saved_elf_calories = 0;
        $saved_num_object = 0;
        $current_elf_calories = 0;
        $num_object = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            if (empty($row[0])) {
                $total_elf_num++;
                if ($saved_elf_calories < $current_elf_calories) {
                    $saved_elf_calories = $current_elf_calories;
                    $saved_num_object = $num_object;
                    $saved_elf_num = $total_elf_num;
                }
                $current_elf_calories = 0;
                $num_object = 0;
                continue;
            }
            $current_elf_calories += intval($row[0]);
            $num_object++;
        }

        PrintCmnFns::printRow('L\'elfo in questione è il ', "$saved_elf_num/$total_elf_num");
        PrintCmnFns::printRow('Il numero di oggetti massimo è:', $saved_num_object);
        PrintCmnFns::printRow('Il numero di calorie totali di questo elfo è:', $saved_elf_calories);
    }

    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printTitle($this->getTitle() . ' PT2');
        $ranking_table = [0, 0, 0,];
        $total_elf_num = 0;
        $current_elf_calories = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            if (empty($row[0])) {
                $total_elf_num++;
                $temp_ranking = array_merge([$current_elf_calories], $ranking_table);
                rsort($temp_ranking);
                array_pop($temp_ranking);
                $ranking_table = $temp_ranking;
                $current_elf_calories = 0;
                continue;
            }
            $current_elf_calories += intval($row[0]);
        }
        foreach ($ranking_table as $position => $calories) {
            $index = $position + 1;
            PrintCmnFns::printRow("Il {$index}° elfo della classifica ha:", "{$calories} calorie");
        }
        PrintCmnFns::printRow('Il totale delle calorie è:', (array_sum($ranking_table)));
    }
}