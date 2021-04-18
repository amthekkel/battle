<?php

namespace App;

use App\Players\Player;
use App\Config;

class Battle{
	
	 //Number of players in the game	 
	 private int $num_of_players; 

	 //Maximum number of rounds
	 private int $num_of_rounds; 

	 //Amount of health remaining
	 //Whole number, 0 to 100
	 protected int $health;

	 //reference the winning player
	 private Player $winner;


	public function __construct(int $num_of_players=0,int $num_of_rounds=0){

		$this->set_num_of_players($num_of_players);
		$this->set_num_of_rounds($num_of_rounds);
		
		$message= "hello ".$this->get_num_of_players()." rounds ".$this->get_num_of_rounds();;
		$this->display_output($message);
		
	}


	/**
    * Diplays message on the output medium
	*
	* @param string $message    
    *
    * @return void
    */

	private function display_output($message){

		//TODO: check if output medium is cli or api and output accordingly
		if(!empty($message)){
			fwrite(STDOUT, "{$message}\n");
		}
	}



	/**
    * Capture user input from cli		
    *
    * @return void
    */

	private function get_input(){

		//TODO: check if input medium is cli or api and process accordingly
		 return trim(fgets(STDIN));
	}



	/**
    * Return number of players
    *
    * @return int
    */

	public function get_num_of_players(){

		return $this->num_of_players;
	}

	
	/**
    * Set Number of players playing the game
    *
    * @param int $num_of_players
    *
    * @return void
    */

	public function set_num_of_players(int $num_of_players){

		$this->num_of_players = !empty($num_of_players) ? intval($num_of_players) : Config::NUM_OF_PLAYERS;
	   
	}

	/**
    * Return number of rounds
    *
    * @return int
    */

	public function get_num_of_rounds(){

		return $this->num_of_rounds;
	}

	
	/**
    * Set Number of players playing the game
    *
    * @param int $num_of_players
    *
    * @return void
    */

	public function set_num_of_rounds(int $num_of_rounds){

		$this->num_of_rounds = !empty($num_of_rounds) ? intval($num_of_rounds) : Config::NUM_OF_ROUNDS;
	   
	}


}