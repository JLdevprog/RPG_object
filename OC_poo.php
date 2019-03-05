<?php 

//First Part Character & Action

class Character{
	//Character details
	private $_id,
			$_dam,
			$_name;
	//Hydrate my data
	public function hydrate(array $data){
		foreach($data as $key => $value){
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}
	//Construct data
	public function __construct(array $data){
		$this->hydrate($data);
	}

	const ITS_ME = 1;
	CONST PERSO_DIE =2;
	const PERSO_TAP =3;

	public function tap(Character $perso){
		if($perso->id() == $this->_id){
			return self::ITS_ME;
		}
		//if Inform is trying...
		//Inform the Perso to receive it
	}

	public function receivDam(){
		$this->_dam += 5;
		if($this->_dam >= 100){
			return self::PERSO_DIE;
		}
		return self::PERSO_TAP;
	}
	//Getters
	public function dam(){
		return $this->_dam;
	}

	public function id(){
		return $this->_id;
	}

	public function name(){
		return $this->_name;
	}

	public function setDam($dam){
		$dam = (int) $dam;
		if($dam>=0 && $dam <=100){
			$this->_dam = $dam;
		}
	}

	public function setId($id){
		$id = (int) $id;
		if($id>0){
			$this->_id = $id;
		}
	}

	public function setName($name){
		if(is_string($name)){
			$this->_name = $name;
		}
	}

}

//Second Part DataBase Manager

class PersoManager{
	private $_db; // PDO Instance

	public function __construct($db){
		$this->setDb($db);
	}

	public function add(Character $perso){
		//Prepar Insert Request
		$q = $this->_db->
			prepare('INSERT INTO character(name) VALUES(:name)');
		//Assign Valor for Name
		$q->bindValue(':name', $perso->name());
		//Execute Request
		$q->execute();

		//Hydrate Character with parameter require
		$perso->hydrate([
			'id' => $this->_db->lastInsertId(),
			'dam' => 0,
		]);
	}

	public function count(){
		//Execute COUNT() request for result
	}

	public function delete(Character $perso){
		//Execute DELETE Request ...
	}

	public function exists($info){
		//if int number, its an identifiant
		//Execute COUNT() Request with WHERE case to return Boolean

		//if type Name
		//Execute COUNT() with WHERE & return Boolean
	}

	public function get($info){
		//if int number, We want get the Perso
		//Execute SELECT() Request with WHERE case to return OP Perso

		//if type Name
		//Execute SELECT() with WHERE & return Perso
	}

	public function getList($name){
		//Return Perso List from other than him
		//Result in Instance table
	}

	public function update(Character $perso){
		//Prepare UPDATE Request
		//Assign Valor to Request
		//Execute Request
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}
}