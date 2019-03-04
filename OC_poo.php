<?php

class character{

	private $_force = 50;
	private $_local = "VW";
	private $_xp = 1;
	private $_dam =0;

	public function move(){
	}

	public function tap(character $persoTarget){
		$persoTarget->_dam += $this->_force;
	}

	public function lv_up(){
	}

	public function talk(){
		echo "I talk...";
	}

	public function get_force(){
		return $this->_force;
	}

	public function get_dam(){
		return $this->_dam;
	}

	public function get_xp(){
		return $this->_xp;
	}
	public function win_xp(){
		$this->_xp++;
	}
	
}

$perso = new character;

$perso2 = new character;

$perso->talk();

echo "<br>";

$perso->get_xp();
echo "<br>";
$perso->win_xp();
$perso->get_xp();
echo "<br>";

$perso->tap($perso2);
$perso->win_xp();

?><pre><?php
var_dump($perso);
var_dump($perso2);
?><pre><?php

$perso->setForce(10);
$perso->setXP(5);

echo "First Perso : <br> ";
echo "Force ",$perso->_force(),"<br>";
echo "Damage ",$perso->_dam(),"<br>";
echo "Experience ",$perso->_xp(),"<br>";

