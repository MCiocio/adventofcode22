<?php
require_once (__DIR__ . '/vendor/autoload.php');
use AdventCode\Common\PrintCmnFns;
use AdventCode\Common\DayChallengeFactory;
echo '<head>';
PrintCmnFns::includeCss();
echo '</head>';
echo '<section class="sky">';

for ($index = 1; $index < 27; $index++) {
    PrintCmnFns::printSimpleRow("Round $index");
    // $day_challenge = new \AdventCode\DayChallanges\DayChallenge1();
    $day_challenge = DayChallengeFactory::factory($index);
    if (is_null($day_challenge)) {
        PrintCmnFns::printSimpleRow('is null');
        continue;
    }
    PrintCmnFns::printSimpleRow("Printing Day $index");
    $day_challenge->printFirstPartSolution();
    $day_challenge->printSecondPartSolution();
}

echo '</section>';


PrintCmnFns::includeJs();
