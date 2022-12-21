<?php
require_once(__DIR__ . '/vendor/autoload.php');

use AdventCode\Common\DayChallengeFactory;
use AdventCode\Common\PrintCmnFns;

echo '<head>';
PrintCmnFns::includeCss();
echo '</head>';
echo '<section class="sky">';

for ($index = 1; $index < 27; $index++) {
    // PrintCmnFns::printSimpleRow("Round $index");
    // $day_challenge = new \AdventCode\DayChallenges\DayChallenge1();
    try {
        $day_challenge = DayChallengeFactory::factory($index);
    } catch (Exception $exception) {
        PrintCmnFns::printSimpleRow($exception->getMessage());
        continue;
    }
    PrintCmnFns::printTitle("Printing " . $day_challenge->getTitle());
    $day_challenge->printFirstPartSolution();
    $day_challenge->printSecondPartSolution();
    PrintCmnFns::printSeparator();
}

echo '</section>';


PrintCmnFns::includeJs();
