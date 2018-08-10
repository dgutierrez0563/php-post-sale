<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Articulo
	*/
	class Articulo
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codigo,$nombre,$id_categoria,$stock,$detalle,$imagen,$id_user){
			$sql = "INSERT INTO articulo (Codigo,Nombre,IDCategoria,Stock,Detalle,Imagen,created_by,updated_by) VALUES('$codigo','$nombre','$id_categoria','$stock','$detalle','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_articulo,$codigo,$nombre,$id_categoria,$stock,$detalle,$imagen,$id_user){
			$sql = "UPDATE articulo SET Codigo='$codigo',Nombre='$nombre',IDCategoria='$id_categoria',Stock='$stock',Detalle='$detalle',Imagen='$imagen',updated_by='$id_user' WHERE IDArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_articulo){
			$sql = "UPDATE articulo SET Estado='0' WHERE IDArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_articulo){
			$sql = "UPDATE articulo SET Estado='1' WHERE IDArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_articulo){
			$sql = "SELECT * FROM articulo WHERE IDArticulo='$id_articulo'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT a.IDArticulo,a.Codigo,a.Nombre,a.Stock,a.Detalle,a.Imagen,a.Estado,a.updated_at,c.IDCategoria,c.Nombre AS NombreCategoria FROM articulo a INNER JOIN categoria c ON a.IDCategoria=c.IDCategoria";
			return ejecutarConsulta($sql);
		}

		public function listarCategorias(){
			$sql = "SELECT IDCategoria, Nombre, Estado FROM categoria WHERE Estado=1";
			return ejecutarConsulta($sql);
		}

		public function actualizarStock($id_articulo,$qty,$id_user){
			//$aux_qty = obtenerStock($id_articulo);

			$sql = "UPDATE articulo SET Stock='$qty',updated_by='$id_user' WHERE IDArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}

		public function obtenerStock($id_articulo){
			$sql = "SELECT Stock FROM articulo WHERE IDArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}
	}
?>