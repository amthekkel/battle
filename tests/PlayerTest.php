<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Players\Brute;

final class PlayerTest extends TestCase
{
    public function test_player_creation_success_with_valid_name():void
    {
         
            $this->expectNotToPerformAssertions();
            $player =new Brute("Job Blogs");
    }


    public function test_player_creation_fails_with_empty_name():void
    {
         
            $this->expectException(\Exception::class);
            $player =new Brute("");
    }

    public function test_player_creation_fails_with_long_name():void
    {
         
        $this->expectException(\Exception::class);
        $player =new Brute("abcdefghijklmnopqrstuvwxyz12345678");  //over 30 characters
    }



    public function test_brute_player_intialise_valid_health():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectNotToPerformAssertions();
        $player->set_health(95, true);
    }

    public function test_brute_player_intialise_invalid_health():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectException(\Exception::class);
        $player->set_health(5, true);
    }

    public function test_brute_player_intialise_valid_strength():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectNotToPerformAssertions();
        $player->set_strength(65, true);
    }
    
    public function test_brute_player_intialise_invalid_strength():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectException(\Exception::class);
        $player->set_strength(85, true);
    }

    public function test_brute_player_intialise_valid_defence():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectNotToPerformAssertions();
        $player->set_defence(45, true);
    }
    
    public function test_brute_player_intialise_invalid_defence():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectException(\Exception::class);
        $player->set_defence(39, true);
    }
     
    public function test_brute_player_intialise_valid_speed():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectNotToPerformAssertions();
        $player->set_speed(45, true);
    }
    
    public function test_brute_player_intialise_invalid_speed():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectException(\Exception::class);
        $player->set_speed(29, true);
    }

    public function test_brute_player_intialise_valid_luck():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectNotToPerformAssertions();
        $player->set_luck(0.32, true);
    }
    
    public function test_brute_player_intialise_invalid_luck():void
    {
    
        $player =new Brute("Job Blogs");
        $this->expectException(\Exception::class);
        $player->set_luck(1.5, true);
    }
  

    //TODO: add further tests for the rest of the application
}
