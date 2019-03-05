
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

	public function validName(){
		return !empty($this->_name);
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
		return $this->_db->query('SELECT COUNT(*) FROM character')->fetchColumn();
	}

	public function delete(Character $perso){
		//Execute DELETE Request ...
		// $this->_db->exec('DELETE FROM character WHERE id = '.$perso->id());
	}

	public function exists($info){
		//if int number, its an identifiant see the TRUE
		if(is_int($info)){
			return (bool) $this->_db->query('SELECT COUNT(*) FROM character WHERE id ='.$info)->fetchColumn();
		}
		//Execute COUNT() Request with WHERE case to return Boolean

		//if type Name
		$q = $this->_db->prepare('SELECT COUNT(*) FROM character WHERE name = :name');
		$q->execute([':name' => $info]);

		return (bool) $q->fetchColumn();
		//Execute COUNT() with WHERE & return Boolean
	}

	public function get($info){
		//if int number, We want get the Perso
		if(is_int($info)){
			$q = $this->_db->query('SELECT id, name, dam FROM character WHERE id = '.$info);
			$data = $q->fetch(PDO::FETCH_ASSOC);

			return new Character($data);
		}
		//Execute SELECT() Request with WHERE case to return OP Perso

		//if type Name
		else{
			$q = $this->_db->prepare('SELECT id, name, dam FROM character WHERE name = :name');
			$q->execute([':name' => $info]);

			return new Character($q->fetch(PDO::FETCH_ASSOC));
		}
		//Execute SELECT() with WHERE & return Perso
	}

	public function getList($name){
		//Return Perso List from other than him
		$persos = [];

		$q = $this->_db->prepare('SELECT id, name, dam FROM character WHERE name <> :name ORDER BY name');
		$q->execute([':name'=>$name]);

		while($data = $q->fetch(PDO::FETCH_ASSOC)){
			$persos[] = new character($data);
		}
		//Result in Instance table
		return $persos;
	}

	public function update(Character $perso){
		//Prepare UPDATE Request
		$q = $this->_db->prepare('UPDATE character SET dam = :dam WHERE id = :id');
		$q->bindValue(':dam',$perso->dam(), PDO::PARAM_INT);
		$q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
		//Assign Valor to Request
		$q->execute();
		//Execute Request
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}
}

?>

<!DOCTYPE html>

<html>
	<head>
		<title>Virtual Fight Mini-Game</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<form action="" method='post'>
			<p>
				Name: <input type="text" name="name" maxlength="50" />
				<input type="submit" value="Create Perso" name="Create" />
				<input type="submit" value="Use the Perso" name="Use" />
			</p>
		</form>
	</body>
</html>

<?php

function chargeClass($classname){
	require $classname.'.php';
}

spl_autoload_register('chargeClass');

session_start();//Call Session after AutoLoad

if(isset($_GET['disconect'])){
	session_destroy();
	header('location: .');
	exit();
}

$db = new PDO('mysql:host=localhost;dbname=rpg_op','root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//in case of Rquest Issue

$Manager = new PersoManager($db);

if(isset($_POST['Create']) && isset($_POST['name'])){
	//Create New
	$perso = new character(['name' => $_POST['name']]);

	if(!$perso->validName()){
		$message = "The Name is not Valid.";
		unset($perso);
	}
	elseif($manager->exists($perso->name())){
		$message = 'The Character Name is already use.';
		unset($perso);
	}
	else{
		$manager->add($perso);
	}
}

elseif(isset($_POST['Use']) && isset($_POST['name'])){
	if($manager->exists($_POST['name'])){
		$perso = $manager->get($_POST['name']);
	}
	else{
		$message = "This Perso does not Exist.";
	}
}