<?php

namespace App;

use App\Players\Brute;
use App\Players\Grappler;
use App\Players\Swordsman;

class Config
{

    const NUM_OF_PLAYERS =2;

    const NUM_OF_ROUNDS = 30;

    const MAX_NAME_LENGTH = 30;

  //Min and Max values for each player properties

    const MIN_HEALTH =0;

    const MAX_HEALTH =100;

    const MIN_STRENGTH =0;

    const MAX_STRENGTH =100;

    const MIN_DEFENCE =0;

    const MAX_DEFENCE =100;

    const MIN_SPEED =0;

    const MAX_SPEED =100;

    const MIN_LUCK =0;

    const MAX_LUCK =1;

    const PLAYER_TYPES=[
    '\App\Players\Brute',
    '\App\Players\Grappler',
    '\App\Players\Swordsman'
    ];


    const SKILL_LUCKY_STRIKE = 1;
    const SKILL_STUNNING_BLOW = 2;
    const SKILL_COUNTER_ATTACK = 3;

    const LUCKY_STRIKE_PROBABILITY = 5;
    const STUNNING_BLOW_PROBABILITY = 2;
    const COUNTER_ATTACK_PROBABILITY = 40;

    const LUCKY_STRIKE_STRENGTH_MULTIPLIER = 2;
    const COUNTER_ATTACK_DAMAGE_INDUCED = 10;

    const SKILL_NAMES =[
    "Unkown",
    "Lucky Strike",
    "Stunning Blow",
    "Counter Attack",
    ];


    const MODE_CLI=1;
    const MODE_GUI=2;
}
