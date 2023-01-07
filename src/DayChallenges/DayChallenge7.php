<?php

namespace AdventCode\DayChallenges;

use AdventCode\Common\DayChallengeBase;
use AdventCode\Common\File;
use AdventCode\Common\PrintCmnFns;
use Exception;
use function current;
use function is_numeric;
use function is_object;
use function mysqli_thread_safe;

class DayChallenge7 extends DayChallengeBase
{
    private $tree = [];
    private $total_size = 0;
    public function printFirstPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT1');
        $fp = $this->openStream();
        $this->readInput($this->tree, $fp);
        
        echo "<a onclick='showTree'>show tree</a><br>";
        echo "<div id='tree'>";
        echo "<pre>";
        $this->printTree($this->tree, 0);
        echo "</pre>";
        echo "</div>";
        echo "<script>
            document.getElementById('tree').style.display = 'none';
        function showTree() {
            console.log('ciao');
            document.getElementById('tree').style.display = 'block';
        }
</script>";
        $dimension = $this->sumSize($this->tree);
        PrintCmnFns::printRow('La dimensione totale è di: ', $dimension);
        PrintCmnFns::printRow('La dimensione della somma delle cartelle minori di 10k è: ', $this->total_size);
    }

    private function readInput(array &$tree, $fp)
    {
        $new_current_dir = null;
        while ($row = fgetcsv($fp)) {
            $first_char = substr($row[0], 0, 1);
            if ($first_char === '$') {
                $full_command = str_replace('$ ', '', $row[0]);
                $command = substr($full_command, 0, 2);
                if ($command === 'ls') {
                    if (is_null($new_current_dir)) {
                        throw new Exception('E\' qui?');
                    }
                    if ($new_current_dir === '/') {
                        $this->readInput($tree, $fp);
                    } else {
                        $this->readInput($tree[$new_current_dir], $fp);
                    }
                } elseif ($command === 'cd') {
                    $new_current_dir = explode(' ', $full_command)[1];
                    if ($new_current_dir == '..') {
                        return;
                    }
                } else {
                    throw new Exception('Command Not Managed: '.$command);
                }
                // COMMAND
            } elseif (is_numeric($first_char)) {
                // FILE
                list($dimension, $filename) = explode(' ', $row[0]);
                $file = new File($filename, $dimension);
                $tree[] = $file;
            } elseif ($first_char === 'd') {
                // directory
                $dirname = str_replace('dir ', '', $row[0]);
                $tree[$dirname] = [];
            }
        }
    }

    public function printSecondPartSolution(): void
    {
        PrintCmnFns::printSubtitle($this->getTitle() . ' PT2');
        $fp = $this->openStream();
    }
    
    private function printTree($tree, $level = 0)
    {
        echo "<ul>";
        foreach($tree as $dir => $values) {
            if (!is_numeric($dir) && !empty($dir)) {
                $row = "<li>$dir (dir)</li>";
                echo $row;
            }
            if (is_array($values)) {
                $this->printTree($values, $level+1);
            } else {
                if (!is_object($values) || !($values instanceof File)) {
                    throw new Exception('non è un file');
                }
                // list($filename, $dimension) = explode('|', $values);
                $text = $values->__toString();
                $row = "<li>$text</li>";
                echo $row;
            }
        }
        echo "</ul>";

    }
    
    
    private function sumSize(array $tree, $dir_name = '/'): int 
    {
        $sum = 0;
        foreach ($tree as $dir => $value) {
            if (is_array($value)) {
                $sum += $this->sumSize($tree[$dir], $dir);
                // if ($sum < 100000) {
                //     PrintCmnFns::printColoredRow("$dir with dimension minor than 100k ($sum)", true, 'green');
                //     $this->total_size += $sum;
                // } else {
                //     PrintCmnFns::printColoredRow("$dir ignored, dimension greater than 100k ($sum)", true, 'red');
                // }
                // $sum = 0;
            } elseif (is_object($value) && $value instanceof File) {
                $sum += intval($value->dimension);
            } else {
                throw new Exception('File non funziona');
            }
        }
        if ($sum < 100000) {
            PrintCmnFns::printColoredRow("Directory $dir_name considered, dimension minor than 100k ($sum)", true, 'green');
            $this->total_size += $sum;
        } else {
            PrintCmnFns::printColoredRow("Directory $dir_name ignored, dimension greater than 100k ($sum)", true, 'red');
        }
        return $sum;
    }
}