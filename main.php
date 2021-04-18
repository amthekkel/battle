<?php

require './vendor/autoload.php';

use App\Battle;

if(!defined('STDIN')){
	echo "Please run the application from a command line";
	exit(0);
}


$game=new Battle;
// $game=new Battle(5,50);
exit(1);