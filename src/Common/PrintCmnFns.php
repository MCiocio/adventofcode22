<?php

namespace AdventCode\Common;

class PrintCmnFns
{
    public static function printTitle(string $title, string $id = ''): void
    {
        self::printSimpleRow("<h3 id='$id'>$title </h3>", false);
    }

    public static function printSubtitle(string $subtitle): void
    {
        self::printSimpleRow("<h4>$subtitle </h4>", false);
    }

    public static function printRow(string $prefix, string $subject): void
    {
        echo "<font color='#228b22'> $prefix </font><font color='#F5624D'>$subject</font><br/>";
    }

    public static function printSimpleRow(string $text, bool $acapo = true): void
    {
        echo "<span>$text</span>" . ($acapo ? '<br/>' : '');
    }

    public static function printColoredRow(string $text, bool $acapo = true, string $color = 'black'): void
    {
        echo "<font color='$color'>$text</font>" . ($acapo ? '<br/>' : '');
    }

    public static function printSeparator(): void
    {
        echo '<hr/>';
    }

    public static function includeCss()
    {
        echo "<link rel='stylesheet' href='/css/style.css'/>";
    }

    public static function includeJs()
    {
        echo "<script type='text/javascript' src='/js/snow.js'></script>";
    }

    public static function printCode($variable, bool $use_vardump = true): void
    {
        echo '<pre>';
        if ($use_vardump) {
            var_dump($variable);
        } else {
            print_r($variable);
        }
        echo '</pre>';
    }
    public static function printMatrix($variable): void
    {
        $max = 0;
        foreach($variable as $index => $values) {
            $max = max($max, count($values));
        }
        echo '<table>';
        for ($i = $max-1; $i >= 0; $i--) {
            echo '<tr>';
            foreach($variable as $index => $values) {
                echo '<td>'.(is_null($values[$i]) ? '' : '['.$values[$i].']').'</td>';
            }
            echo '</tr>';
        }
        echo '<tfoot>';
        echo '<tr>';
        echo '<td>'.implode('</td><td>', array_keys($variable));
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
    }
}