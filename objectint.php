<?php

/*
-- Exercice P.O.O - Interface & Classes abstraites :

- Partie 1 : 
Un animal est représenté par un nombre de pates, une couleur de poil, un sexe et un nom.
Un chien est capable d'aboyer.
Un chat est capable de miauler.

	-> Créer les classes qui correspondent.

- Partie 2 :

Un être humain est une créature magique qui n'appartiens pas au règne animal mais qui est représenté par un nom, une couleur de cheveux et un sexe.

Un robot est une créature mécanique qui est définit par un identifiant et une couleur.

	-> Créer les classes qui correspondent.

- Partie 3 :

L'être Humain et le robot sont capable de travailler.

	-> Créer l'interface correspondante.

Partie 4 : 

Un être humain est capable de parler.

	-> Modifier votre code pour créer les classes qui correspondent.


Partie 5 :

Chaque objet devra être afficher avant de faire son action.
Exemple : "L'homme Patrick, qui est blond, va travailler."

Créer un script PHP qui va utiliser vos objets et générer de façon aléatoire des chiens/chat/humain/robot :

	- Chien / Chat / Humain doivent produire des sons sur 10 cycles.
	- Humain / Robot doivent travailler sur 10 cycles.
*/


abstract class EtreVivant{

	protected $hair;
	protected $sexe;
	protected $name;
	protected $talk;

	public function __construct($hair, $sexe, $name, $talk){

		$this->hair = $hair;
		$this->sexe = $sexe;
		$this->name = $name;
		$this->talk = $talk;

	}

	public function set_talk($talk){
		$this->talk=$talk;
	}
	public function get_talk(){
		return $this->talk;
	}

	//public function talk();

}

/*abstract class work{
	echo "Work...";
}*/

abstract class animal extends EtreVivant{

	protected $leg;

	public function __construct($hair, $sexe, $name, $talk, $leg){
		parent::__construct($hair, $sexe, $name, $talk);
		$this->leg = $leg;

	}

	//set get

}

class dog extends animal {

	public function set_talk($talk){
		$this->talk="Wouaf";
	}

	public function get_talk(){
		return $this->talk;
	}

}

class cat extends animal{

	public function talk(){
	echo "Meaou";
	}
}



abstract class human extends EtreVivant{

	//public function work();

	/*public function talk {
		echo "I know how to talk?!";
	}*/

	public function talk(){
	echo "I know to Talk ?!";
	}

}

abstract class robot {

	protected $id;
	protected $color;

	public function __construct($id , $color){

		$this->id =$id;
		$this->color= $color;
	}
	//public function work();
}


$test = new dog("Black","Male", "Roger","", "4");
?><pre><?php
var_dump($test);
?><pre><?php

echo $test;

?>