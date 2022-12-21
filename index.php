<?php
require_once(__DIR__ . '/vendor/autoload.php');

use AdventCode\Common\DayChallengeFactory;
use AdventCode\Common\PrintCmnFns;

echo '<head>';
PrintCmnFns::includeCss();
echo '</head>';
echo '<section class="sky">';

for ($index = 1; $index < 25; $index++) {
    // PrintCmnFns::printSimpleRow("Round $index");
    // $day_challenge = new \AdventCode\DayChallenges\DayChallenge1();
    try {
        $day_challenge = DayChallengeFactory::factory($index);
    } catch (Exception $exception) {
        PrintCmnFns::printSimpleRow($exception->getMessage());
        continue;
    }
    $id = str_replace(' ', '', strtolower($day_challenge->getTitle()));
    PrintCmnFns::printTitle("Printing " . $day_challenge->getTitle(), $id);
    $day_challenge->printFirstPartSolution();
    $day_challenge->printSecondPartSolution();
    PrintCmnFns::printSeparator();
}

echo '</section>';


PrintCmnFns::includeJs();
