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
        echo "$text" . ($acapo ? '<br/>' : '');
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
        echo "<script type='text/javascript' src='/js/snow.js'></script>";
    }
}