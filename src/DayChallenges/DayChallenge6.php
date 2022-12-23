<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;
use Exception;

class DayChallenge6 extends DayChallengeBase
{
    public function printFirstPartSolution(string $input = null): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $fp = $this->openStream();
        $sequence = fgetcsv($fp);
        if (empty($sequence)) {
            throw new Exception('Input not valid!');
        }
        $sequence = $sequence[0];

        $packet_length = 4;
        $position = $this->getMarkerPosition($sequence, $packet_length);
        if ($position) {
            PrintCmnFns::printRow('Ciao', $position);
            PrintCmnFns::printRow('Ciao', substr($sequence, $position-$packet_length, $packet_length));
        }
    }

    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $fp = $this->openStream();
        $sequence = fgetcsv($fp);
        if (empty($sequence)) {
            throw new Exception('Input not valid!');
        }
        $sequence = $sequence[0];

        $packet_length = 14;
        $position = $this->getMarkerPosition($sequence, $packet_length);
        if ($position) {
            PrintCmnFns::printRow('Ciao', $position);
            PrintCmnFns::printRow('Ciao', substr($sequence, $position-$packet_length, $packet_length));
        }
    }
    
    protected function getMarkerPosition(string $sequence, int $packet_length): ?int
    {
        for ($i = 0; $i < strlen($sequence); $i++) {
            $string_to_check = substr($sequence, $i, $packet_length);
            foreach (str_split($string_to_check) as $index => $single_char) {
                if (strpos($string_to_check, $single_char, $index+1)) {
                    continue 2;
                }
            }
            return $i+$packet_length;
        }
        return null;
    }
    
}