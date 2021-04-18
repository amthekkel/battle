<?php

namespace App\Players;

use App\Config;

class Grappler extends Player{


	//Settings for Grappler Player

	protected $type = 'Grappler';
	
	protected int $min_health_allowed = 60;

	protected int $max_health_allowed = 100;

	protected int $min_strength_allowed = 75;

	protected int $max_strength_allowed = 80;

	protected int $min_defence_allowed = 35;

	protected int $max_defence_allowed = 40;

	protected int $min_speed_allowed = 60;

	protected int $max_speed_allowed = 80;

	protected float $min_luck_allowed = 0.3;

	protected float $max_luck_allowed  = 0.4;

}