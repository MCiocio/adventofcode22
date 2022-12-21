<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;
use Exception;

class DayChallenge3 extends DayChallengeBase
{
    protected const PRIORITIES = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => 4,
        'e' => 5,
        'f' => 6,
        'g' => 7,
        'h' => 8,
        'i' => 9,
        'j' => 10,
        'k' => 11,
        'l' => 12,
        'm' => 13,
        'n' => 14,
        'o' => 15,
        'p' => 16,
        'q' => 17,
        'r' => 18,
        's' => 19,
        't' => 20,
        'u' => 21,
        'v' => 22,
        'w' => 23,
        'x' => 24,
        'y' => 25,
        'z' => 26,
        'A' => 27,
        'B' => 28,
        'C' => 29,
        'D' => 30,
        'E' => 31,
        'F' => 32,
        'G' => 33,
        'H' => 34,
        'I' => 35,
        'J' => 36,
        'K' => 37,
        'L' => 38,
        'M' => 39,
        'N' => 40,
        'O' => 41,
        'P' => 42,
        'Q' => 43,
        'R' => 44,
        'S' => 45,
        'T' => 46,
        'U' => 47,
        'V' => 48,
        'W' => 49,
        'X' => 50,
        'Y' => 51,
        'Z' => 52,
    ];

    protected function openStream()
    {
        return fopen('csv/day3/items.csv', 'r');
    }

    /**
     * @throws Exception
     */
    public function printFirstPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $priority_sum = 0;
        $fp = $this->openStream();
        while ($row = fgetcsv($fp)) {
            list($first_part_items, $second_part_items) = str_split($row[0], strlen($row[0])/2);
            if (strlen($first_part_items) !== strlen($second_part_items)) {
                throw new Exception('The items are not divisible in two equal parts');
            }
            $first_items_array = str_split($first_part_items);
            $second_items_array = str_split($second_part_items);
            $common_item = $this->getCommonItem($first_items_array, $second_items_array);
            if (is_null($common_item)) {
                throw new Exception('There is no common item');
            }
            $priority = self::PRIORITIES[$common_item];
            if (is_null($priority)) {
                PrintCmnFns::printCode($common_item);
                PrintCmnFns::printCode($first_items_array);
                PrintCmnFns::printCode($second_items_array);
                throw new Exception('Element not find in priorities mapping');
            }
            $priority_sum += $priority;
        }
        PrintCmnFns::printRow('Il totale delle priorità è: ', "$priority_sum");

    }

    /**
     * @throws Exception
     */
    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $priority_sum = 0;
        $fp = $this->openStream();
        while ($elf1 = fgetcsv($fp)) {
            $elf2 = fgetcsv($fp);
            $elf3 = fgetcsv($fp);
            if ($elf2 === false || $elf3 === false) {
                throw new Exception('Ciao Mondo');
            }
            $elf1 = $elf1[0];
            $elf2 = $elf2[0];
            $elf3 = $elf3[0];
            $elf1_array = str_split($elf1);
            $elf2_array = str_split($elf2);
            $elf3_array = str_split($elf3);

            $item_a = $this->getCommonItems($elf1_array, $elf2_array);
            $item_b = $this->getCommonItems($elf1_array, $elf3_array);
            if (empty($item_a) || empty($item_b)) {
                PrintCmnFns::printCode($elf1);
                PrintCmnFns::printCode($elf2);
                PrintCmnFns::printCode($elf3);
                PrintCmnFns::printCode($item_a);
                PrintCmnFns::printCode($item_b);
                throw new Exception('There is no common item');
            }
            
            $common_item = $this->getCommonItems($item_a, $item_b);
            if (count($common_item) > 1) {
                throw new Exception('Gli elementi trovati sono piu di uno!!!');
            } else {
                $common_item = $common_item[0];
            }
            $priority = self::PRIORITIES[$common_item];
            $priority_sum += $priority;

        }
        PrintCmnFns::printRow('Il totale delle priorità è: ', "$priority_sum");
    }

    private function getCommonItem($first_items_array, $second_items_array, array $items_to_exclude = []): ?string
    {
        foreach ($first_items_array as $single_item) {
            if (in_array($single_item, $second_items_array, true) && !in_array($single_item, $items_to_exclude, true)) {
                return $single_item;
            }
        }
        return null;
    }

    private function getCommonItems($first_items_array, $second_items_array): array
    {
        $common_items = [];
        while (!is_null($this->getCommonItem($first_items_array, $second_items_array, $common_items))) {
            $common_items[] = $this->getCommonItem($first_items_array, $second_items_array, $common_items);
        }
        return $common_items;
    }
}