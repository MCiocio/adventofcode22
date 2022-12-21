<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\PrintCmnFns;

class DayChallenge5 extends DayChallengeBase
{
    /*
     *                 [M]     [W] [M]    
     *             [L] [Q] [S] [C] [R]    
     *             [Q] [F] [F] [T] [N] [S]
     *     [N]     [V] [V] [H] [L] [J] [D]
     *     [D] [D] [W] [P] [G] [R] [D] [F]
     * [T] [T] [M] [G] [G] [Q] [N] [W] [L]
     * [Z] [H] [F] [J] [D] [Z] [S] [H] [Q]
     * [B] [V] [B] [T] [W] [V] [Z] [Z] [M]
     *  1   2   3   4   5   6   7   8   9 
     * */
    private const STARTING_MATRIX = [
        1 => ['B', 'Z', 'T'],
        2 => ['V', 'H', 'T', 'D', 'N'],
        3 => ['B', 'F', 'M', 'D'],
        4 => ['T', 'J', 'G', 'W', 'V', 'Q', 'L'],
        5 => ['W', 'D', 'G', 'P', 'V', 'F', 'Q', 'M',],
        6 => ['V', 'Z', 'Q', 'G', 'H', 'F', 'S'],
        7 => ['Z', 'S', 'N', 'R', 'L', 'T', 'C', 'W'],
        8 => ['Z', 'H', 'W', 'D', 'J', 'N', 'R', 'M'],
        9 => ['M', 'Q', 'L', 'F', 'D', 'S'],
    ];

    public function printFirstPartSolution(): void
    {
        // Containings
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $fp = $this->openStream();
        $matrix = self::STARTING_MATRIX;
        while ($command = fgetcsv($fp)) {
            list($crate_to_move, $starting_stack, $destination_stack) = $this->formatAndReturnMoveInformation($command[0]);
            for ($index = 0; $index < $crate_to_move; $index++) {
                $crate = array_pop($matrix[$starting_stack]);
                array_push($matrix[$destination_stack], $crate);
            }
        }
        $return_command = $this->getCommandToReturn($matrix);
        $this->printOutput($matrix, $return_command);

    }

    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $matrix = self::STARTING_MATRIX;
        $fp = $this->openStream();
        while ($command = fgetcsv($fp)) {
            list($crate_to_move, $starting_stack, $destination_stack) = $this->formatAndReturnMoveInformation($command[0]);
            $crate_to_move_array = array_slice($matrix[$starting_stack], -$crate_to_move);
            for ($i = 0; $i < $crate_to_move; $i++) {
                array_pop($matrix[$starting_stack]);
            }
            array_push($matrix[$destination_stack], ...$crate_to_move_array);
        }
        $return_command = $this->getCommandToReturn($matrix);
        $this->printOutput($matrix, $return_command);
    }

    private function printOutput($matrix, $return_command): void
    {
        PrintCmnFns::printSimpleRow('Matrice iniziale');
        PrintCmnFns::printMatrix(self::STARTING_MATRIX);
        PrintCmnFns::printSimpleRow('Matrice finale');
        PrintCmnFns::printMatrix($matrix);
        PrintCmnFns::printRow('Il comando finale è: ', $return_command);
    }

    private function formatAndReturnMoveInformation(string $command_string)
    {
        $command_string = str_replace('move ', '', $command_string);
        $command_string = str_replace(' from ', ',', $command_string);
        $command_string = str_replace(' to ', ',', $command_string);
        list($crate_to_move, $starting_stack, $destination_stack) = explode(',', $command_string);
        return [
            intval($crate_to_move),
            intval($starting_stack),
            intval($destination_stack)
        ];
    }

    private function getCommandToReturn($matrix)
    {
        $return = '';
        foreach ($matrix as $stack => $values) {
            $return .= array_pop($values);
        }
        return $return;
    }
}