<?php
declare(strict_types=1);

namespace App;

use App\Players\Player;
use App\Config;

class Battle
{

	private array $players;
	
	 //Number of players in the game
	private int $num_of_players;

	 //Maximum number of rounds
	private int $num_of_rounds;

	 //Amount of health remaining
	 //Whole number, 0 to 100
	protected int $health;

	 //reference the winning player
	private Player $winner;

	  //whether the program is running in test mode
	private int $mode=Config::MODE_CLI;

	/**
	 * Player types
	 *
	 * @var string
	 */
	// private static $combatants = array(
		
	//     '\BattleSimulator\Combatants\Swordsman',
	//     '\BattleSimulator\Combatants\Brute',
	//     '\BattleSimulator\Combatants\Grappler',
	// );


	public function __construct(int $num_of_players = 0, int $num_of_rounds = 0)
	{

		$this->set_num_of_players($num_of_players);
		$this->set_num_of_rounds($num_of_rounds);
	}


	/**
	* Diplays message on the output medium
	*
	* @param string $message
	*
	* @return void
	*/

	private function display_output($message)
	{

		//TODO: check if output medium is cli or api and output accordingly
		if (!empty($message)) {
			$mode = $this->get_mode();

			if ($mode == Config::MODE_CLI) {
				fwrite(STDOUT, "{$message}\n");
			} elseif ($mode == Config::MODE_GUI) {
				echo json_encode(["message"=>$message]);
			}
		}
	}



	/**
	* Capture user input from cli
	*
	* @return void
	*/

	private function get_input()
	{

		//TODO: check if input medium is cli or api and process accordingly
		 return trim(fgets(STDIN));
	}



	/**
	* Return number of players
	*
	* @return int
	*/

	public function get_num_of_players()
	{

		return $this->num_of_players;
	}

	
	/**
	* Set Number of players playing the game
	*
	* @param int $num_of_players
	*
	* @return void
	*/

	public function set_num_of_players(int $num_of_players)
	{

		$this->num_of_players = !empty($num_of_players) ? intval($num_of_players) : Config::NUM_OF_PLAYERS;
	}


	/**
	* check whether the application needs to run in CLI or GUI
	*
	* @return int
	*/

	public function get_mode()
	{

		return $this->mode;
	}

	
	/**
	* Set whether the application needs to run in CLI or GUI
	*
	* @param int  $mode
	*
	* @return void
	*/

	public function set_mode(int $mode):void
	{

		$this->mode = $mode;
	}


	/**
	* Get players in the game
	*
	* @return int
	*/

	private function get_players()
	{

		return $this->players;
	}

	
	/**
	* Set players
	*
	* @param int $num_of_players
	*
	* @return void
	*/

	private function set_players(array $players_arr)
	{

		$this->players = $players_arr;
	}

	/**
	* Return number of rounds
	*
	* @return int
	*/

	public function get_num_of_rounds()
	{

		return $this->num_of_rounds;
	}

	
	/**
	* Set Number of players playing the game
	*
	* @param int $num_of_players
	*
	* @return void
	*/

	public function set_num_of_rounds(int $num_of_rounds)
	{

		$this->num_of_rounds = !empty($num_of_rounds) ? intval($num_of_rounds) : Config::NUM_OF_ROUNDS;
	}


	/**
	* Returns the winning player
	*
	* @return int
	*/

	public function get_winner()
	{

		return $this->winner;
	}

	
	/**
	* Set winning player
	*
	* @param player $player
	*
	* @return void
	*/

	public function set_winner(Player $player)
	{

		$this->winner = $player;
	}

	/**
	* Start the Battle simulation
	*
	* @return void
	*/
	public function start()
	{

		try {
			$message = "******************************************\n";
			$message .="* \t  STARTING GAME                      \n";
			$message .="* \t  NUMBER OF PLAYERS : {$this->get_num_of_players()} \n";
			$message .="* \t  NUMBER OF ROUNDS : {$this->get_num_of_rounds()} \n";
			$message .="******************************************\n";
			$this->display_output($message);
			$this->initialize_battle();
	
			for ($i=1; $i <= $this->num_of_rounds; $i++) {
				$message = "******************************************\n";
				$message .="* \t  Round {$i}                         *\n";
				$message .="******************************************\n";
				$this->display_output($message);
	
				$combatants = $this->order_starting_positions($this->players);

				//TODO: look at supporting multiple players rather than just 2
				$attacker=$combatants[0];
				$opponent=$combatants[1];

				//First attacker attacks
				$message ="* \t  {$attacker->get_name()} attacks first *\n";
				$this->display_output($message);
				$attacker->attack($opponent);
				if ($this->check_for_winners($attacker, $opponent)) {
					break;
				}

				//Second attacker attacks
				$message ="* \t  {$opponent->get_name()} attacks second *\n";
				$this->display_output($message);
				$opponent->attack($attacker);
				if ($this->check_for_winners($opponent, $attacker)) {
					break;
				}
			}

			$this->game_result();
		} catch (\Exception $e) {
		}
	}


	/**
	* Initialize the Battle simulation
	*
	* @return void
	*/
	private function initialize_battle()
	{

		$message = "******************************************\n";
		$message .="* \t Initialising Players            *\n";
		$message .="******************************************\n";
		$this->display_output($message);
		$this->set_players($this->initialize_players());
		
		
		$message = "******************************************\n";
		$message .="* \t Introducing Player STATS            *\n";
		$message .="******************************************\n";

		foreach ($this->players as $player) {
			$message.=(string) $player;
		}
		$this->display_output($message);
	}


	/**
	* display players current stats
	*
	* @param player $player_1
	* @param player $player_2
	*
	* @return void
	*/

	public function display_players_current_stats(Player $player_1, Player $player_2)
	{
		$message="";
		$message .= "******************************************\n";
		$message .="* PLAYER STATS                        *";
		$message .="******************************************\n";
		$message .="|***********|*******************************|********************************|\n";
		$message .="|			|   Player 1       				| Player 2						 |\n";
		$message .="|***********|*******************************|********************************|\n";
		$message .="|			|						 		|	 			 				 |\n";
		$message .="| Name      | {$player_1->get_name()}	    | {$player_2->get_name()}        |\n";
		$message .="|			|						 		|	 			 				 |\n";
		$message .="| Type      | {$player_1->get_type()}		| {$player_2->get_type()}        |\n";
		$message .="|			|						        |				 			     |\n";
		$message .="| Health    | {$player_1->get_health()}		| {$player_2->get_health()}      |\n";
		$message .="|			|						 		|				 			     |\n";
		$message .="| Strength  | {$player_1->get_strength()}	| {$player_2->get_strength()}    |\n";
		$message .="|			|						 		|					 			 |\n";
		$message .="| Defence   | {$player_1->get_type()}		| {$player_2->get_type()}        |\n";
		$message .="|			|						 		|					 			 |\n";
		$message .="| Luck      | {$player_1->get_type()}		| {$player_2->get_type()}        |\n";
		$message .="|			|						 		|	 			 				 |\n";
		$message .="******************************************************************************\n";

		$this->display_output($message);
	}

	/**
	* Setup Players
	*
	* @return array of players
	*/
	private function initialize_players()
	{

		$players = [];

		for ($i=1; $i <= $this->get_num_of_players(); $i++) {
				$get_player_name = true;
			
			do {
				try {

					$message="Please enter the name of Player ${i}";
					$this->display_output($message);

					//Get names of each player participating in the game.
					$player_name = $this->get_input();

					//get a random player type
					$player = $this->get_random_player_type();
					$players[]=new $player($player_name);
					$get_player_name=false;

				} catch (\Exception $e) {

					$message="Error setting up player ${i}. Error message : {$e->getMessage()}";
					$this->display_output($message);
					$get_player_name=true;
				}
				
			} while ($get_player_name);
		}

		return $players;
	}


	/**
	* get Random players
	*
	* @params array $existing_players
	*
	* @return array
	*/
	private function get_random_player_type($existing_players = [])
	{

		$rand_val = array_rand(Config::PLAYER_TYPES, 1);

		return Config::PLAYER_TYPES[$rand_val];
	}

	/**
	* Sort order of players based on speed and defence
	* Speed of the combatants determines which one will attack first, if two combatants have
	* the same speed the one with the lower defence should go first
	* @params array $existing_players
	*
	* @return array
	*/

	private function order_starting_positions($players)
	{

		usort($players, function (Player $p1, Player $p2): int {
			if ($p1->get_speed() === $p2->get_speed()) {
				return $p2->get_defence() <=> $p1->get_defence();
			}
			return $p2->get_speed() <=>  $p1->get_speed();
		});

		return $players;
	}






	/**
	* Check health of players and determine if there is a winner
	*
	* @return boolean
	*/

	private function check_for_winners($player_1, $player_2)
	{

		if ($player_1->get_health() == 0) {
			$this->set_winner($player_2);
			return true;
		}

		if ($player_2->get_health() == 0) {
			$this->set_winner($player_1);
			return true;
		}

		return false;
	}

		/**
	* Display the results of the game
	*
	* @return void
	*/

	private function game_result()
	{
		$message="";
		if (!empty($this->winner)) {
			$winner = $this->get_winner();
			$message = "\n\n******************************************\n";
			$message .="\t GAME RESULT 					\n";
			$message .="******************************************\n";		
			$message .="\t WINNER IS : {$winner->get_name()}  \n";
		} else {
			$message = "\n\n******************************************\n";
			$message .="\t GAME ENDED IN A DRAW 					\n";				
		}

		$message .= "******************************************\n\n";
		$message .="\t GAME OVER 					\n";
		$message .= "******************************************";

		$this->display_output($message);
	}
}
