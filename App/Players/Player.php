<?php
declare(strict_types=1);

namespace App\Players;

use App\Config;

abstract class Player
{


    //Player properties

    /**
    * Type of player.
    *
    * @var string
    */
    protected $type = __CLASS__;


     //Name of the combatant,
     //String, 30 chars or less
    protected string $name;

    //Amount of health remaining
    //Whole number, 0 to 100
    protected int $health;

    protected int $min_health_allowed;

    protected int $max_health_allowed;

    //Damage that is done upon attack
    //Whole number, 0 to 100
    protected int $strength;

    protected int $min_strength_allowed;

    protected int $max_strength_allowed;

   //Damage reduction during defence of an attack
   //Whole number, 0 to 100
    protected int $defence;

    protected int $min_defence_allowed;

    protected int $max_defence_allowed;

    //Determines attack order
    //Whole number, 0 to 100
    protected int $speed;

    protected int $min_speed_allowed;

    protected int $max_speed_allowed;

    //Affects ability to dodge an attack
    //Decimal, 0 to 1
    protected float $luck;

    protected float $min_luck_allowed;

    protected float $max_luck_allowed;

    //type of skills the player has and the chance that the skill can be used
    // [SKILL_INDEX => CHANCE_SKILL_CAN_BE_USED]
    protected array $skills;
    
    //whether player is to miss next turn
    protected bool $miss_next_turn;

    public function __construct(string $player_name)
    {

        $this->set_name($player_name);
        $this->init_player();
    }


    /**
    * Return Player type
    *
    * @return string
    */

    public function get_type()
    {

        return $this->type;
    }


    /**
    * Return Player's name
    *
    * @return string
    */

    public function get_name()
    {

        return $this->name;
    }

    /**
    * Set Player's name
    *
    * @param string $name
    *
    * @return void
    */

    public function set_name($player_name)
    {

        if (empty($player_name)) {
            throw new \Exception("Player name cannot be empty");
        } else if (strlen($player_name) > Config::MAX_NAME_LENGTH) {
            throw new \Exception("Player name should not exceed ".Config::MAX_NAME_LENGTH." characters");
        }

        $this->name = ucwords(trim($player_name));
    }



    /**
    * Return Player's health
    *
    * @return int
    */

    public function get_health()
    {

        return $this->health;
    }

    
    /**
    * Set Player's health
    *
    * @param int $player_health
    *
    * @return player
    */

    public function set_health(int $player_health, $initialise = false):player
    {

        if ($player_health < Config::MIN_HEALTH || $player_health > Config::MAX_HEALTH) {
            throw new \Exception("Players health value {$player_health} out of bounds. Premissible range is ".Config::MIN_HEALTH." - ".Config::MAX_HEALTH);
        }
        
        if ($initialise && ($player_health < $this->min_health_allowed || $player_health > $this->max_health_allowed)) {
            throw new \Exception("During Initialisation, player Type health value {$player_health} out of bounds. Premissible range for Player type ".get_called_class()." is {$this->min_health_allowed} - {$this->max_health_allowed}");
        }

        $this->health = $player_health > 0 ? $player_health : 0;
        return $this;
    }

    /**
    * Return Player's strength
    *
    * @return int
    */

    public function get_strength()
    {

        return $this->strength;
    }

    /**
    * Set Player's Strength
    *
    * @param int $player_strength
    *
    * @return player
    */

    public function set_strength(int $player_strength, $initialise = false): player
    {
 
        if ($player_strength < Config::MIN_STRENGTH || $player_strength > Config::MAX_STRENGTH) {
            throw new \Exception("Players strength value {$player_strength} out of bounds. Premissible range is ".Config::MIN_STRENGTH." - ".Config::MAX_STRENGTH);
        }
        
        if ($player_strength < $this->min_strength_allowed || $player_strength > $this->max_strength_allowed) {
            throw new \Exception("Player Type strength value  {$player_strength} out of bounds. Premissible range for Player type ".get_called_class()." is {$this->min_strength_allowed} - {$this->max_strength_allowed}");
        }

        $this->strength = $player_strength;
        return $this;
    }


    /**
    * Return Player's defence
    *
    * @return int
    */

    public function get_defence()
    {

        return $this->defence;
    }

    /**
     * Set Player's Defence
     *
     * @param int $player_defence
     *
     * @return player
     */

    public function set_defence(int $player_defence, $initialise = false):player
    {

        if ($player_defence < Config::MIN_DEFENCE || $player_defence > Config::MAX_DEFENCE) {
            throw new \Exception("Players defence value  {$player_defence} out of bounds. Premissible range is ".Config::MIN_DEFENCE." - ".Config::MAX_DEFENCE);
        }
        
        if ($player_defence < $this->min_defence_allowed || $player_defence > $this->max_defence_allowed) {
            throw new \Exception("Player Type defence value  {$player_defence} out of bounds. Premissible range for Player type ".get_called_class()." is {$this->min_defence_allowed} - {$this->max_defence_allowed}");
        }

        $this->defence = $player_defence;
        return $this;
    }

    /**
    * Return Player's speed
    *
    * @return int
    */

    public function get_speed()
    {

        return $this->speed;
    }

    /**
     * Set Player's speed
     *
     * @param int $player_speed
     *
     * @return player
     */

    public function set_speed(int $player_speed, $initialise = false):player
    {

        if ($player_speed < Config::MIN_SPEED || $player_speed > Config::MAX_SPEED) {
            throw new \Exception("Players speed value  {$player_speed} out of bounds. Premissible range is ".Config::MIN_SPEED." - ".Config::MAX_SPEED);
        } else if ($player_speed < $this->min_speed_allowed || $player_speed > $this->max_speed_allowed) {
            throw new \Exception("Player Type speed value {$player_speed} out of bounds. Premissible range for Player type ".get_called_class()." is {$this->min_speed_allowed} - {$this->max_speed_allowed}");
        }

        $this->speed = $player_speed;
        // $this->speed = 50;
        return $this;
    }
    

    /**
    * Return Player's luck
    *
    * @return int
    */

    public function get_luck()
    {

        return $this->luck;
    }

    /**
     * Set Player's luck
     *
     * @param float $player_luck
     *
     * @return player
     */

    public function set_luck(float $player_luck, $initialise = false):player
    {

        if ($player_luck < Config::MIN_LUCK || $player_luck > Config::MAX_LUCK) {
            throw new \Exception("Players luck value {$player_luck} out of bounds. Premissible range is ".Config::MIN_LUCK." - ".Config::MAX_LUCK);
        } else if ($player_luck < $this->min_luck_allowed || $player_luck > $this->max_luck_allowed) {
            throw new \Exception("Player Type luck value {$player_luck} out of bounds. Premissible range for Player type ".get_called_class()." is {$this->min_luck_allowed} - {$this->max_luck_allowed}");
        }

        $this->luck = $player_luck;
        return $this;
    }


    /**
    * Check if player is to miss next turn
    *
    * @return bool
    */

    public function check_miss_next_turn():bool
    {

        return $this->miss_next_turn;
    }

    /**
     * Set whether player is to miss next turn or not
     *
     * @param bool $miss_turn
     *
     * @return void
     */

    public function set_to_miss_next_turn(bool $miss_turn)
    {

        $this->miss_next_turn = $miss_turn;
    }



    /**
    * Return Player's current stats
    *
    * @return string
    */

    public function get_player_current_stats()
    {

        
        $message ="******************************************\n";
        $message .="|									 		\n";
        $message .="| Name       {$this->get_name()}			\n";
        $message .="|									 		\n";
        $message .="| Type       {$this->get_type()}			\n";
        $message .="|					      				    \n";
        $message .="| Health     {$this->get_health()}			\n";
        $message .="|									      	\n";
        $message .="| Strength   {$this->get_strength()}		\n";
        $message .="|									      	\n";
        $message .="| Defence    {$this->get_defence()}			\n";
        $message .="|									      	\n";
        $message .="| Speed      {$this->get_speed()}			\n";
        $message .="|									      	\n";
        $message .="| Luck       {$this->get_luck()}			\n";
        $message .="|									      	\n";
        $message .="******************************************\n";

        return $message;
    }

    /**
    * override toString
    *
    * @return string
    */
    public function __toString()
    {

        return $this->get_player_current_stats();
    }




    /**
    * Diplays message on the output medium
    *
    * @param string $message
    *
    * @return void
    */

    public function display_message($message)
    {

        //TODO: check if output medium is cli or api and output accordingly
        if (!empty($message)) {
            fwrite(STDOUT, "{$message}\n");
        }
    }

    /**
    * set individual player attributes
    *
    * @param string attribute_name
    *
    * @return void
    */
    protected function set_attribute(string $attribute_name)
    {

        try {
            $min_allowed_val = "min_".$attribute_name.'_allowed';
            $max_allowed_val = "max_".$attribute_name.'_allowed';
            $setter  = 'set_'.$attribute_name;

            if ($attribute_name == 'luck') {
                $rand_value = round($this->$min_allowed_val + mt_rand() / mt_getrandmax() * ($this->$max_allowed_val - $this->$min_allowed_val), 1, PHP_ROUND_HALF_DOWN);
            } else {
                $rand_value = rand($this->$min_allowed_val, $this->$max_allowed_val);
            }
            
            // $this->display_message(" rand value for ${attribute_name} is ${rand_value}");
            $this->$setter($rand_value, true);
        } catch (\Exception $e) {
        }
    }

    /**
    * get players skills
    *
    * @return array
    */

    public function get_skills():array
    {

        return $this->skills;
    }

    /**
     * Set player skills
     *
     * @return void
     */

    abstract protected function set_skills();



    /**
    * Initialise player attributes
    *
    * @return void
    */
    protected function init_player()
    {

        $this->set_attribute('health');
        $this->set_attribute('strength');
        $this->set_attribute('defence');
        $this->set_attribute('speed');
        $this->set_attribute('luck');
        $this->set_skills();
        $this->set_to_miss_next_turn(false);
    }


    /**
    * Process a player attacking another player
    *
    * @param Player defender
    *
    * @return bool
    */
    public function attack(Player $defender)
    {

        //check if player is to miss their turn
        if ($this->check_miss_next_turn()) {

            $message="{$this->get_name()} has to miss their turn \n";
            $this->display_message($message);
            $this->set_to_miss_next_turn(false);
            return false;
        }

        $successful_attack =$this->is_attack_successful($defender);
         
        $this->compute_skill_usage($defender, $successful_attack);

        return true;
    }

    /**
    * compute damage to defender
    *
    * @param Player $defender
    *
    * @return void
    */
    // abstract protected function compute_damage(Player $defender,bool $successful_attack);


    /**
    * Compute if the attack is successful
    *
    * @param Player defender
    *
    * @return bool
    */
    private function is_attack_successful(Player $defender):bool
    {
 
        $defender_luck = $defender->get_luck();
        $rand_value = round(
            Config::MIN_LUCK+ mt_rand() / mt_getrandmax() * (Config::MAX_LUCK - Config::MIN_LUCK),
            1,
            PHP_ROUND_HALF_DOWN
        );

        if ($rand_value <= $defender_luck) {
            return false;
        }
        return TRUE;
    }
    

    /**
    * Compute if the attack is successful
    *
    * @param Player defender
    *
    * @return void
    */
    public function compute_skill_usage(Player $defender, $successful_attack = false)
    {
        $response=[
            "stength"=>0,
            "miss_turn"=>false
        ];

        $strength = $this->get_strength();
        $attacker_health= $this->get_health();
        $defender_defence= $defender->get_defence();
        $defender_health= $defender->get_health();
        

        $rand_value =  rand(0, 100);
        $message="";

        if ($successful_attack) {

            foreach ($this->skills as $s_key => $s_val) {

                $skill_probability = $s_val;
                $skill_name = isset(Config::SKILL_NAMES[$s_key]) ? Config::SKILL_NAMES[$s_key] : 'Unknown';

                switch ($s_key) {
                    case Config::SKILL_LUCKY_STRIKE:

                        if ($rand_value <= $skill_probability) {

                            $strength = $strength * Config::LUCKY_STRIKE_STRENGTH_MULTIPLIER;

                            $message .= "{$this->get_name()} uses {$skill_name} skill to attack {$defender->get_name()}. {$this->get_name()} gets double the strength of {$strength} for attacking. \n";

                        }else {
                            $message = "{$this->get_name()} attacks and deals a blow to {$defender->get_name()}. \n";
                        }
                        break;

                    case Config::SKILL_STUNNING_BLOW:

                        if ($rand_value <= $skill_probability) {

                            $defender->set_to_miss_next_turn(true);
                            $message .= "{$this->get_name()} uses {$skill_name} skill to attack {$defender->get_name()}. {$defender->get_name()} is to miss their next turn. \n";
                        }else {

                            $message .= "{$this->get_name()} attacks and deals a blow to {$defender->get_name()}. \n";
                        }
                        break;

                    default:
                        $message = "{$this->get_name()} attacks and deals a blow to {$defender->get_name()}. \n";
                        break;
                }

                $damage = $strength -   $defender_defence ;
                $new_health = ($defender_health - $damage) > 0 ? ($defender_health - $damage) : 0;

                $defender->set_health($new_health);

                $message .="Damage done is {$damage}. {$defender->get_name()}'s health is now down to {$defender->get_health()} ------- {$this->get_name()}'s health is at {$this->get_health()} \n";

                $this->display_message($message);
            }

        } else {
          
            foreach ($defender->skills as $s_key => $s_val) {

                $skill_probability = $s_val;
                $skill_name = isset(Config::SKILL_NAMES[$s_key]) ? Config::SKILL_NAMES[$s_key] : 'Unknown';

                if ($s_key == Config::SKILL_COUNTER_ATTACK) {

                    // Map skill probability for counter attack to the luck value of the defender
                    $skill_probability = $defender->get_luck() * 100;

                    if ($rand_value <= $skill_probability) {

                        $damage = Config::COUNTER_ATTACK_DAMAGE_INDUCED;
                        $new_health = ($attacker_health - $damage) > 0 ? ($attacker_health - $damage) : 0;

                        $this->set_health($new_health);

                        $message .= "{$defender->get_name()} evades {$this->get_name()} attack. ";
                        $message .= "{$defender->get_name()} uses {$skill_name} skill to reduce {$this->get_name()}'s health.\n";
                        
                        $message .="Damage done is {$damage}.{$this->get_name()}'s health is now down to {$this->get_health()} ------- {$defender->get_name()}'s health is at {$defender->get_health()}\n";
                    }

                } else {

                    $message .= "{$this->get_name()} attacks but fails to deal a blow at {$defender->get_name()}. \n";
                    $message .="{$this->get_name()}'s health is at {$this->get_health()} ------- {$defender->get_name()}'s health is at {$defender->get_health()}\n";
                }


                $this->display_message($message);
            }
        }
        
        return true;
    }
}
