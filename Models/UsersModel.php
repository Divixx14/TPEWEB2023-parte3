<?php
require_once 'Models/config.php';

class UsersModel{

	private $db;

	function __construct(){
        $this->db = new PDO('mysql:host='. DB_HOST .';dbname='.DB_NAME .';charset='.DB_Charset,  DB_USER, DB_PASS);
    }

	public function setUser($email,$pwd){
		$query = $this->db->prepare('INSERT INTO users (email,password) VALUES(?,?)');
		$query->execute([$email,$pwd]);
	}

	public function getUser($email){
		$query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
		$query->execute([$email]);
		$user = $query->Fetch(PDO::FETCH_OBJ);
		return $user;
	}
}