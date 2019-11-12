<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Categoria
	*/
	class Categoria
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codcategria,$nombre,$detalle,$id_user){
			$sql = "INSERT INTO categoria(CodCategoria,NombreCategoria,Detalle,created_by,updated_by) VALUES('$codcategria','$nombre','$detalle','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codcategria,$nombre,$detalle,$id_user,$codcategoria_id){
			$sql = "UPDATE categoria SET CodCategoria='$codcategria', NombreCategoria='$nombre',Detalle='$detalle',updated_by='$id_user' 
			WHERE CodCategoria='$codcategoria_id'";
			return ejecutarConsulta($sql);
		}

		public function disable($codcategria/*,$id_user*/){
			$sql = "UPDATE categoria SET Estado='0' WHERE CodCategoria='$codcategria'";
			return ejecutarConsulta($sql);
		}

		public function enable($codcategria/*,$id_user*/){
			$sql = "UPDATE categoria SET Estado='1' WHERE CodCategoria='$codcategria'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codcategria){
			$sql = "SELECT CodCategoria,NombreCategoria,Detalle,updated_by FROM categoria WHERE CodCategoria='$codcategria'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT CodCategoria,NombreCategoria,Detalle,Estado,updated_at FROM categoria";
			return ejecutarConsulta($sql);
		}

		public function listarCategorias(){
			$sql = "SELECT CodCategoria, NombreCategoria FROM categoria WHERE Estado='1'";
			return ejecutarConsulta($sql);
		}

		public function detalle($codcategria){
			$sql = "SELECT c.CodCategoria,c.NombreCategoria,c.Detalle AS DetalleC,
			c.Estado,c.updated_by,c.created_at AS created_at,c.updated_at AS updated_at,
			u.CodUsuario,u.NombreUsuario FROM categoria c INNER JOIN usuario u 
			ON c.updated_by=u.CodUsuario
			WHERE c.CodCategoria='$codcategria'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($codcategria){
			$sql = "SELECT CodCategoria FROM categoria WHERE CodCategoria='$codcategria'";
			return ejecutarConsultaPorFila($sql);
		}
	}
?>