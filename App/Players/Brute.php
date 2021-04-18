<?php

namespace App\Players;

use App\Config;

abstract class Brute extends Player{


	//Settings for Brute Player

	protected $type = 'Brute';
	
	protected int $min_health_allowed = 90;

	protected int $max_health_allowed = 100;

	protected int $min_strength_allowed = 65;

	protected int $max_strength_allowed = 75;

	protected int $min_defence_allowed = 40;

	protected int $max_defence_allowed = 50;

	protected int $min_speed_allowed = 40;

	protected int $max_speed_allowed = 65;

	protected float $min_luck_allowed = 0.3;

	protected float $max_luck_allowed  = 0.35;

}