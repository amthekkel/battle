<?php

require './vendor/autoload.php';

use App\Battle;

if (!defined('STDIN')) {
    echo "Please run the application from a command line";
    exit(0);
}


$game=new Battle();
//$game=new Battle(2,1); // To test drawn battle
$game->start();

exit(1);
