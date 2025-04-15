<?php

function show($stuff, bool $dump = false): void
{
    echo '<pre>';
    
    if ($dump) {
        var_dump($stuff);
    } else {
        print_r($stuff);
    }

    echo '</pre>';
}