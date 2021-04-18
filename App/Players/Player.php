<?php

namespace App\Players;

use App\Config;

abstract class Brute{


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

	protected int $min_luck_allowed;

	protected int $max_luck_allowed;



	public function __construct(string $player_name, int $num_of_players=0,int $num_of_rounds=0){

			
	}


	/**
    * Return Player type
    *
    * @return string
    */

	public function get_type(){

		return $this->type;
	}


	/**
    * Return Player's name
    *
    * @return string
    */

	public function get_name(){

		return $this->name;
	}

	/**
    * Set Player's name
    *
    * @param string $name 
    *
    * @return void
    */

	public function set_name($player_name){

		if(empty($player_name)){
			throw new \Exception("Player name cannot be empty");

		}else if(strlen($player_name) > Config::MAX_NAME_LENGTH){
			throw new \Exception("Player name should not exceed {Config::MAX_NAME_LENGTH} characters");
		}

		$this->name = ucwords(trim($player_name));
	}



	/**
    * Return Player's health
    *
    * @return int
    */

	public function get_health(){

		return $this->health;
	}

	
	/**
    * Set Player's health
    *
    * @param int $player_health
    *
    * @return void
    */

	public function set_health(int $player_health){

	 
	   
	}

	/**
    * Return Player's strength
    *
    * @return int
    */

	public function get_strength(){

		return $this->strength;
	}

	/**
	* Set Player's Strength
	*
	* @param int $player_strength
	*
	* @return void
	*/

	public function set_strength(int $player_strength){

		 
	}


	/**
    * Return Player's defence
    *
    * @return int
    */

	public function get_defence(){

		return $this->defence;
	}

	/**
     * Set Player's Defence
     *
     * @param int $player_defence
     *
     * @return void
     */

	public function set_defence(int $player_defence){

		 
	}

	/**
    * Return Player's speed
    *
    * @return int
    */

	public function get_speed(){

		return $this->speed;
	}

	/**
     * Set Player's speed
     *
     * @param int $player_speed
     *
     * @return void
     */

	public function set_speed(int $player_speed){

		 
	}
	

	/**
    * Return Player's luck
    *
    * @return int
    */

	public function get_luck(){

		return $this->luck;
	}

	/**
     * Set Player's luck
     *
     * @param int $player_luck
     *
     * @return void
     */

	public function set_luck(int $player_luck){

		 
	}


	/**
    * Return Player's current stats
    *
    * @return string
    */

	public function get_player_current_stats(){

		$stats=[
			"Name ".$this->get_name(),
			"Type ".$this->get_type(),
			"Health ".$this->get_health(),
			"Strenght ".$this->get_strength(),
			"Defence ".$this->get_defence(),
			"Speed ".$this->get_luck(),
		];

		return implode("\n",$stats);
	}


}