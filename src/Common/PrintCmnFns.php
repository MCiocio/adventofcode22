<?php
namespace AdventCode\Common;

class PrintCmnFns
{
    public static function printTitle(string $title): void
    {
        echo "<h4>$title </h4>";
    }

    public static function printRow(string $prefix, string $subject): void
    {
        echo "<font color='#228b22'> $prefix </font><font color='#F5624D'>$subject</font><br/>";
    }

    public static function printSimpleRow(string $text): void
    {   
        echo "$text <br/>";
    }

    public static function printSeparator(): void
    {   
        echo "<hr/>";
    }

    public static function includeCss()
    {
        echo "<link rel='stylesheet' href='/css/style.css'/>";
    }

    public static function includeJs()
    {
        echo "<script type='javascript' src='/js/snow.js'></script>";
    }
}