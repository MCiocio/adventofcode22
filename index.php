<?php
require_once (__DIR__ . '/vendor/autoload.php');
use AdventCode\Common\PrintCmnFns;
use AdventCode\Common\DayChallengeFactory;
echo "<head>";
PrintCmnFns::includeCss();
PrintCmnFns::includeJs();
echo "</head>";

for ($i = 0; $i < 26; $i++) {
    PrintCmnFns::printSimpleRow("Round $i");
    $day_challenge = DayChallengeFactory::factory($i);
    if (is_null($day_challenge)) {
        PrintCmnFns::printSimpleRow("is null");
        continue;
    }
    PrintCmnFns::printSimpleRow("Printing Day $i");
    $day_challenge->printFirstPartSolution();
    $day_challenge->printSecondPartSolution();
}