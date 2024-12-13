<?php
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dd')) {

    function dump(...$vars)
    {
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }
    }

    function dd(...$vars)
    {
        dump(...$vars);
        die(1); // Dừng thực thi
    }
}