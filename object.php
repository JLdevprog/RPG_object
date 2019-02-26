<?php


/*

Imaginons un jeu de rôle.
Il existe plusieurs type de personnages : les Humains les Orques et les Elfes.

Chaque personnage possède :
	> Un nom
	> Des points de vie (par défaut 100)
	> Des points d'attaque (par défaut 10)
	> Des points de défense (par défaut 5)
	> Un cri de guerre (par exemple "A l'attaqqquuue !")

Chaque type de personnage possède des caractéristiques particulières :
	> Les Humains ont un bonus de +1 sur tous type d'arme.
	> Les Orques ont +2 en attaque et défense mais -10 de vie. 
	  Ils commencent donc avec 90 PV, 12 Atk et 7 dfs.
	> Les Elfes ont -3 en défense. Ils commencent donc avec 2 de défense.
	Les Elfes peuvent fuir n'importe quel combat en sacrifiant 20 point de vie.
	Quand un Elfe gagne un combat, il gagne 2 de défense et de 2 de vie.

-- Première étape :

Créer une classe Personnage.
Cette classe implémentera tous les attributs et méthodes communes aux personnages.

Mettre en place les différents type de personnage. Vous devez pouvoir créer des Elfes, des Orques ou des Humains.

-- Deuxième étape : 

Les Orques ne sont compris de personne.
Leur cri de guerre est dorénavant : "mlll wwouogrouroulou !!"

-- Troisième étape : 

Il existe plusieurs types d'équipements : Armure, épée, autres (vous pouvez en rajouter autant que vous voulez).

Chaque équipement est désigné par un nom et une description de l'objet.
Un équipement confère un bonus bien particulier.

Par exemple : une armure peut conférer +5 en défense, une épée +3 en attaque.
Il y'a même certains objet qui confère +10 en attaque mais baisse de 5 la défense.

Créer une classe Equipement.
Cette classe implémentera tous les attributs et méthodes communes aux équipements.

Mettre en place les différents type d'équipements. Vous devez pouvoir créer plusieurs équipements.
(Je vous laisse libre cours à votre imagination pour la création d'arme et de pouvoir spécifique....)

-- Quatrième étape :

Un personnage peut posséder plusieurs équipements mais :
	- Il ne peut être équipé que de 4 objet au total.
	- Il ne peut être équipé que de 2 épée a la fois.
	- Il ne peut porter qu'une seule armure.

Implémenter donc le fait qu'un personnage possède (ou non) un inventaire.

-- Cinquième étape :

Organiser des combats entre vos personnages !!
Rajouter des méthodes qui permettent de se battre entre vos personnages.

Décomptez les points de vies en fonction des attaques etc...
*/



/*
class race{

	private $type;
	private $bonus;
	public function __toString(){
		return "Type : ".$this->type."<br>"."Bonus : ".$this->bonus."<br>";
	}
	public function __construct($type,$bonus){
		$this->type=$type;
		$this->bonus=$bonus;
	}

	public function get_type(){
		return $this->type;
	}
	public function set_type($type){
		$this->type=$type;
	}

	public function get_bonus(){
		return $this->bonus;
	}
	public function set_bonus($bonus){
		$this->bonus=$bonus;
	}

}*/

class character {

	private $race;
	private $name;
	private $life_p = 100;
	private $attack_p = 10;
	private $defend_p = 5;
	private $shout = "A l'attaqqquuue !";
	private $equipment;

	public function __toString(){
		return "Profil : <br>".$this->name."<br>".$this->life_p."<br>".
		$this->attack_p."<br>".$this->defend_p."<br>".$this->shout."<br>";
	}
	public function __construct($name, $race, $shout){

		//parent::__construct();
		$this->name=$name;
		$this->set_Race($race);
		$this->shout = $shout;

	}
	public function get_name(){
		return $this->name;
	}
	public function set_name($name){
		$this->name=$name;
	}
	public function get_life(){
		return $this->life_p;
	}
	public function set_life($life_p){
		$this->life_p=$life_p;
	}
	public function get_attack(){
		return $this->attack_p;
	}
	public function set_attack($attack_p){
		$this->attack_p=$attack_p;
	}
	public function get_defend(){
		return $this->defend_p;
	}
	public function set_defend($defend_p){
		$this->defend_p=$defend_p;
	}
	public function get_shout(){
		return $this->shout;
	}
	public function set_shout($shout){
		$this->shout=$shout;
	}

	public function set_Race($race){
		//selon la $race, tu change les bonus

		$this->race=$race;

		if($race=="Ork"){
			echo "Ork power";
		}
		elseif($race=="Human"){
			echo "Human Armory";
		}
		elseif($race=="Elf"){
			echo 'Elf Vivacity';
		}

	}

	public function set_equipment($equipment){
		$this->equipment=$equipment;
	}
	public function get_equipment(){
		return  $this->equipment; 
	}

}

class equipment {

	private $category;
	private $life_p;
	private $attack_p;
	private $defend_p;

	public function __construct($category, $life_p, $attack_p, $defend_p){

	//parent::__construct();
	$this->category = $category;
	$this->life_p = $life_p;
	$this->attack_p = $attack_p;
	$this->defend_p = $defend_p;

	}

	public function get_category(){
		$this->category=$category;
	}
	public function set_category($category){
		return $this->category=$category;
	}

	public function set_life_p($life_p){
		$this->life_p=$life_p;
	}
	public function get_life_p(){
		return $this->life_p;
	}

	public function set_attack_p($attack_p){
		$this->attack_p=$attack_p;

		if($race=="Human"){
			$attack_p = $attack_p += 1;
		}

	}
	public function get_attack_p(){
		return $this->attack_p;
	}

	public function set_defend_p($defend_p){
		$this->defend_p=$defend_p;
	}

	public function get_defend_p(){
		return  $this->defend_p;
	}

}

echo "<hr>";

$johann = new character("Johann L","Human", "Hoha?!");
?><pre><?php
//var_dump($johann);
?><pre><?php
//echo $johann;

$sword = new equipment("sword", 0 , 10, 5);
?><pre><?php
//var_dump($sword);
?><pre><?php

$johann->set_equipment($sword);

$johann->get_equipment();
?><pre><?php
var_dump($johann);
?><pre><?php
//echo $johann;
//$johann->equipment=$sword;

echo "<hr>";

$simon = new character("Simon B","Elf", "Poah?!");
$bow = new equipment("bow", 1 , 8 , 1);
$simon->set_equipment($bow);

var_dump($simon);

echo "<hr>";

$roger = new character("Roger","Ork", "Groah?!");
$axe = new equipment("axe", 0 , 12 , 2);
$roger->set_equipment($axe);

var_dump($roger);

echo "<hr>";

echo $johann ."<br><br>". $simon ."<br><br>". $roger;

?>