<?php
require_once 'Models/config.php';

class LibroModel{
	private $db;

	function __construct(){
        $this->db = new PDO('mysql:host='. DB_HOST .';dbname='.DB_NAME .';charset='.DB_Charset,  DB_USER, DB_PASS);
    }

	function count(){
        $query = $this->db->prepare("SELECT count(*) FROM libros");
        $query->execute();
        $total = $query->fetchColumn();
        return $total;
    }

	//Consultas

	public function getLibros(){
		$query = $this->db->prepare('SELECT * FROM libros');
		$query->execute();
		$libros = $query->FetchAll(PDO::FETCH_OBJ);
		return $libros;
	}

	public function getLibrosById($id){
		$query = $this->db->prepare('SELECT * FROM libros where id = ?');
		$query->execute([$id]);
		$libros = $query->Fetch(PDO::FETCH_OBJ);
		return $libros;
	}

    //Orden, paginacion y filtro 
    function getAllFilter($field, $value, $limit, $offset, $sort, $order){
        $query = $this->db->prepare("SELECT * FROM libros WHERE $field = $value ORDER BY $sort $order LIMIT $offset, $limit");
        $query->execute();

        $libros = $query->fetchAll(PDO::FETCH_OBJ); 

        return $libros;
    }
    //Orden, paginacion y filtro 
    function getAllFilterPuntos($field, $value, $limit, $offset, $sort, $order){
        $query = $this->db->prepare("SELECT * FROM libros WHERE $field <= ?  ORDER BY $sort $order LIMIT $offset, $limit");
        $query->execute([$value]);
        
        $libros = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de productos
        
        return $libros;
    }

	
	 // Alta Baja y modificacion
	  
	public function AddLibro($nombre,$nombre_del_autor,$anio_publicacion,$descripcion,$id_autor){
	 	$query = $this->db->prepare('INSERT INTO  libros (nombre, nombre_del_autor, anio_publicacion, descripcion, id_autor) VALUES (?,?,?,?,?)');
	 	$query->execute([$nombre,$nombre_del_autor,$anio_publicacion,$descripcion,$id_autor]);
	 	return $this->db->lastInsertId(); 
	 }

	public function DeleteLibro($id){
	 	$query = $this->db->prepare('DELETE FROM libros where id = ?');
	 	$query->execute([$id]);
	 }

	public function UpdateLibro($id,$nombre,$nombre_del_autor,$anio_publicacion,$descripcion,$id_autor){
	 	$query = $this->db->prepare('UPDATE libros SET nombre = ?, nombre_del_autor = ?, anio_publicacion = ?, descripcion = ?, id_autor = ? WHERE id=?');
	 	$query->execute([$id,$nombre,$nombre_del_autor,$anio_publicacion,$descripcion,$id_autor]);
		return $this->db->lastInsertId();
	 }
}