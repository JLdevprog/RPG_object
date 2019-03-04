<?php

/*
Revoyons notre jeu de rôle.

--------

Ce jeu est constitué d'aventuriers.
Chacun de ces aventuriers possèdent : 
	> Un nom
	> Des points de vie (par défaut 100)
	> Des points d'attaque (par défaut 10)
	> Des points de défense (par défaut 5)
	> Des points de vitesse (par défaut 3)

Ces aventuriers peuvent appartenir à l'une de ces races : Elfe, Orc, Humain.
Par défaut, ils sont Humains (ils sont forcément d'une race).

Ces aventuriers ont plusieurs actions possibles : 
	> Ils attaquent
	> Ils peuvent parer un coup
	> Ils peuvent utiliser leur pouvoir

Chaque race possède sa propre façon de faire ces actions.

Pour les Orcs :
	> Ils attaquent avec rage. Si ils attaquent un Elfe qui n'a pas de bouclier, l'Elfe perd 50 point de vie ! 
	> Ils peuvent parer n'importe quel coup mais perdent 2 de défense.
	> L'Orc peut utiliser son pouvoir pour devenir presque invincible. Il gagne +20 de défense mais perds -10 d'attaque.

Pour les Elfes :
	> Ils attaquent avec dextérité. Bonus de +2 d'attaque à chaque dague qu'il possède.
	> Ils peuvent parer n'importe quel coup mais perdent +1 d'attaque à chaque parade.
	> L'Elfe utilise son pouvoir pour prendre +3 de vitesse.

Pour les Humains : 
	> Quand un Humain attaque à main nue (sans arme de poing), il obtient un bonus de +3 d'attaque.
	> Ils peuvent parer n'importe quel coup d'un Elfe. Par contre, si il rencontre un Orc ou un Humain, il a une chance sur deux pour parer.
	> L'Humain utilise son pouvoir de vie pour reprendre +20 points de vie.

Chaque personnage ne peut utiliser son pouvoir qu'une seule fois par combat !
Le déroulement d'un combat est détaillé plus bas.

--------

Il existe plusieurs types d'équipements : Armure, Epée, Bijou, autres (vous pouvez en rajouter autant que vous voulez).

Chaque équipement est désigné par un nom, un type(épée, armure...), un bonus d'attaque, un bonus de défense et un bonus de vitesse.

Exemples : 
	- Une armure peut conférer +5 en défense mais 0 en attaque et vitesse.
	- Une épée peut conférer +3 en attaque mais 0 en défense et vitesse.
	- Une épée peut conférer +10 en attaque mais -5 en défense et 0 de vitesse.
	- Un collier (bijou) peut conférer +3 de vitesse mais 0 en attaque et défense.

(Je laisse libre cours à votre imagination pour la création d'arme et de pouvoir spécifique.... vous pouvez créer ce que vous voulez).

--------

Un personnage possède un inventaire.
Cet inventaire est vide par défaut et il peut être remplis d'équipements.

Un personnage peut donc posséder plusieurs équipements mais :
	- Il ne peut être équipé que de 4 objet au total.
	- Il ne peut être équipé que de 2 épée a la fois.
	- Il ne peut porter qu'une seule armure.
	- Il ne peut porter qu'un seul bijou.

--------

Un monstre est une créature maléfique qui attaque parfois nos aventuriers sans raison.
Un monstre est représenté par :
	> Des points de vie.
	> Des points d'attaque.
	> Des points d'expérience (XP).

Ces monstres ont plusieurs actions possibles : 
	> Ils attaquent
	Ils attaquent directement les points de vie  d'un personnage avec leurs griffes (même si un personnage possède de la défense).
	> Ils peuvent parer un coup
	Ils parent une fois sur 6, si ils réussissent le prochain coup ne leur fait rien,  sinon il perdent toute leur vie.

Un monstre n'a pas d'équipement.

--------

Il existe 2 types de combat, les duels et les escarmouches.

Les duels : 
	> Durant un duel, 2 aventuriers se combattent.
	> Lorsque l'un d'eux à perdu plus de 80% de ses point de vie ou fuit, il perd le duel.
	> L'aventurier qui gagne le combat prend 100 d'expérience (XP). Voir l'XP dans la partie suivante.
	> Les deux aventuriers retrouvent leur état initial à la fin du combat.

Les escarmouches : 
	> Durant une escarmouche, un ou plusieurs aventuriers combatent un ou plusieurs monstres (voir plus loin).
	> Lorsqu'un joueur tombe à 0 point de vie, il meurt à tout jamais.
	> Lorsqu'un monstre est tué, l'aventurier qui l'a tué récupère ses points d'XP.

	> Lorsqu'une escarmouche est finie : 
		- Les aventuriers encore en vie retrouvent leur état initiale.
		- Ils gagnent autant d'equipements que de monstre vaincus. L'ordre de répartition entre personnage se fait sur l'XP (plus grand au plus petit).


--------

Les aventuriers pratiquent également un métier au sein d'une guilde.
Voici les différents métiers : Mage, Guerrier ou Voleur.

Une guilde est représentée par :
	> Un nom

Un métier est représenté par : 
	> Une appartenance à une guilde.
	> Une expérience (XP)

Les métiers apportent plusieurs choses aux aventuriers :
	> Tous les métiers apportent de l'expérience de vie. +3 de santé.
	> Tous les métiers ont une capacité propre.
	> On peut également afficher le métier et ses caractéristiques.

Voici les différentes caractéristiques pour les métiers.

Le Voleur : 
	> Le voleur est rapide et discret, il à 4 point de vie en moins que les autres mais +2 d'attaque et +2 de vitesse. 
	> Le voleur ne peut porter que des armures légères (de +1 à +3 de défense) 
		et s'armer d'une ou deux dagues (+1 à +3 d'attaque).
	> La capacité du Voleur est le Chapardage
		Il jete un Dé 6.
		Si le résultat est supérieur ou égal à 4, il vole un objet à un autre aventurier.
		Si le résultat est inférieur à 4, il perd 3 point de vie et ne vole rien.
	
Le Mage : 
	> Le Mage peut peut jeter une boule de feu (attaque * 2,5) 
		mais doit préparer durant un tour et ne tirera la boule de feu qu'au tour suivant.
	> La capacité du Mage est le Soin, il récupère 5 point de vie.

Le Guerrier : 
	> Le Guerrier est féroce, +1 d'attaque pour chaque arme sur lui. Cependant il est lent, -1 de vitesse pour chaque arme.
	> Le Guerrier n'a pas de limite d'armure ou d'épée. Il peut s'équiper de n'importe quel équipement.
	> La capacité du Guerrier est la Derniere Chance
		Quand il tombe à 0 pv tout pile, il obtient un dernier souffle, +10 de vie.

--------

Ecrire un programme avec les classes et interfaces qui correspondent.
Organisez des duels entre 10 aventuriers.
Celui qui est le dernier debout est le maitre des duels.
Organisez des escarmouches entre plusieurs personnages et monstres.
*/

abstract class EtreVivant{

	protected $name;
	protected $life_p = 100;
	protected $attack_p = 10;
	protected $defence_p = 5;
	protected $speed_p = 3;

	public function __construct
		($name, $life_p, $attack_p, $defence_p, $speed_p){

		$this->name = $name;
		$this->life_p = $life_p;
		$this->attack_p = $attack_p;
		$this->defence_p = $defence_p;
		$this->speed_p = $speed_p;

	}

	//

}

?>