<?php

require_once 'Views/ApiView.php';
require_once 'Models/LibrosModel.php';
require_once 'AuthHelper/AuthApiHelper.php';

class ApiController{


	private $Model;
	private $View;
	private $Data;
	private $Helper;

	public function __construct(){
		$this->Model = new LibroModel();
		$this->View = new ApiView();
		$this->Data = file_get_contents("php://input");
		$this->Helper = new AuthApiHelper();
	}

	public function getInput(){
		return json_decode($this->Data);
	}

	//Endpoints metodos
	public function getLibros($params = null){
		$libros=null;

		// Campos de la tabla
		$fields = array('id', 'nombre', 'nombre_del_autor', 'anio_publicacion', 'descripcion', 'id_autor');
		// Tipos de orden
		$orderType = array('asc','desc');
		// Total de registros de la tabla
		$total = $this->Model->count();
		
		//Defino valores por defecto
		$sort = $fields[0];
		$order = $orderType[0];
		$limit = $total;
		$offset = 0;
		$field = null;
		$value = null;

		//Miembro b: filtrado
		if ((isset($_GET['field'])&& isset($_GET['value']))){
			$value = $_GET['value'];
			//se verifica que lo que se haya recibido por parametro GET pertenezca al array de opciones posibles
			if (in_array($_GET['field'], $fields))
			$field = $_GET['field'];
			else
			return $this->View->response("$field no es un campo existente de la tabla", 400);
		}

		// alumno  A llama y ordena el listado
		//Ordenado por un campo asc o desc Alumno A
		if ((isset($_GET['sort'])&&isset($_GET['order']))){
			// Verifica que lo que se haya recibido por parametro GET pertenezca al array de opciones posibles
			if (in_array($sort, $fields)&&in_array($order, $orderType)){
				$sort = $_GET['sort'];
				$order = $_GET['order'];   
			} 
			else 
				return $this->View->response("La ruta es incorrecta", 400);

		 }

		  //Paginacion Alumno A 
		if ((isset($_GET['limit'])&&(isset($_GET['pag'])))){
			if((int)$_GET['limit'] <= $total){
				$limit = (int)$_GET['limit'];
				$pages = round($total/$limit);
				if ((int)$_GET['pag']<=$pages){
					$page = (int)$_GET['pag'];                     
					$offset = $limit * ($page-1);
				} else {
					return $this->View->response("Las paginas existentes son $pages", 400);
				}
			} else {
					return $this->View->response("El limite debe ser menor a $total", 400);
			}
		}

		//Miembro B: Hago los llamados al modelo, en caso de que no haya entrado a los if anteriores, van los valores por defecto
		if ($field!=null&&$value!=null)
			if($field=='anio_publicacion')
				$libros = $this->Model->getAllFilterDate($field, $value, $limit, $offset, $sort, $order);
			else
				$libros = $this->Model->getAllFilter($field, $value, $limit, $offset, $sort, $order);
		else 
		   $libros = $this->Model->getLibros($limit, $offset, $sort, $order);

		
		//Hago el llamado a la vista
		if ($libros)
			return $this->View->response($libros, 201);
		else 
			return $this->View->response("No hay libros disponibles", 404);
	
	}


	public function getLibro($params = null){
		$id = $params[':ID'];		
		if(isset($id) && !empty($id)){
			$libros = $this->Model->getLibrosById($id);
			if($libros){
				$this->View->response($libros,200);
			}
			else{
				$this->View->response("Libro no encontrado",404);
			}

		}
	}

	public function AddLibro(){
		/*if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}*/
		$body = $this->getInput();

		if(isset($body->nombre,$body->nombre_del_autor,$body->anio_publicacion,$body->descripcion,$body->id_autor)){
				$id = $this->Model->AddLibro($body->nombre,$body->nombre_del_autor,$body->anio_publicacion,$body->descripcion,$body->id_autor);
			$libros = $this->Model->getLibrosById($id);
			$this->View->response($libros,201);			
		}else{
				$this->View->response('Complete los campos',400);
			}

	}

	public function EditLibro($params = null){
		/*if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}*/

		$id = $params[':ID'];
		$body = $this->Model->getLibrosById($id);
		if($body){
			$libros = $this->getInput();
			if (empty($libros->nombre)||empty($libros->nombre_del_autor)||empty($libros->anio_publicacion)||empty($libros->descripcion)||empty($libros->id_autor)){
				$this->View->response("Complete los datos", 400);
			} else {                
				$this->Model->UpdateLibro($libros->nombre, $libros->nombre_del_autor, $libros->anio_publicacion, $libros->descripcion, $libros->id_autor, $id);
				$libros = $this->Model->getLibrosById($id);
				$this->View->response($libros, 201);
			}
		} else {
			$this->View->response("No se encuentra el libro con el ID $id", 404);
		}
	}


	public function DeleteLibro($params = null){
		/*if(!$this->Helper->isLoggedIn()){
			$this->View->response("No estas logeado", 401);
			return;
		}*/
		$id = $params[':ID'];
		$libros = $this->Model->getLibrosById($id);
		if ($libros){
			$this->Model->DeleteLibro($libros->id);
			$this->View->response('Libro borrado',200);
		}else{
			$this->View->response("El libro con el $id no existe",404);
		}

	}


	//modularizacion

	//impide la entrada del usuario previniendo una inyeccion SQL
	public function OrderLibros($field){

			switch($field){
				
				case 'id':
					$order = $this->isOrderSet();
					$field = 'id';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				case 'nombre':
					$order = $this->isOrderSet();
					$field = 'nombre';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				case 'nombre_del_autor':
					$order = $this->isOrderSet();
					$field = 'nombre_del_autor';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				case 'anio_publicacion':
					$order = $this->isOrderSet();
					$field = 'anio_publicacion';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				case 'descripcion':
					$order = $this->isOrderSet();
					$field = 'descripcion';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				case 'id_autor':
					$order = $this->isOrderSet();
					$field = 'id_autor';
					$libros = $this->Model->OrderLibros($field,$order);
					$this->View->response($libros,200);
					break;
				default:
					$this->View->response('',204);
					break;
			}		
		
	}


	//Verificamos si el parametro de orden esta seteado
	//Por defecto es Descendente
	public function isOrderSet(){
		$order = 'DESC';
			if(isset($_GET['order']) && !empty($_GET['order'])){
				if($_GET['order'] == 'ASC') $order = 'ASC';
		}
		return $order;
	}

}