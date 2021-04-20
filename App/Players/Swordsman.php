<?php
declare(strict_types=1);

namespace App\Players;

use App\Config;

class Swordsman extends Player
{


    //Settings for Swordsman Player

    protected $type = 'Swordsman';
    
    protected int $min_health_allowed = 40;

    protected int $max_health_allowed = 60;

    protected int $min_strength_allowed = 60;

    protected int $max_strength_allowed = 70;

    protected int $min_defence_allowed = 20;

    protected int $max_defence_allowed = 30;

    protected int $min_speed_allowed = 90;

    protected int $max_speed_allowed = 100;

    protected float $min_luck_allowed = 0.3;

    protected float $max_luck_allowed  = 0.5;

    // protected int $skill  = Config::SKILL_LUCKY_STRIKE;

    protected array $skills;



    protected function set_skills()
    {

        $this->skills = [Config::SKILL_LUCKY_STRIKE => Config::COUNTER_ATTACK_PROBABILITY];
    }
}
