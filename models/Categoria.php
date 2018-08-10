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

		public function create($nombre,$detalle,$id_user){
			$sql = "INSERT INTO categoria(Nombre,Detalle,created_by,updated_by) VALUES('$nombre','$detalle','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}


		public function edit($id_categoria,$nombre,$detalle,$id_user){
			$sql = "UPDATE categoria SET Nombre='$nombre',Detalle='$detalle',updated_by='$id_user' WHERE IDCategoria='$id_categoria'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_categoria/*,$id_user*/){
			/*$sql_aux = "SELECT IDCategoria,Estado FROM categoria WHERE IDCategoria='$id'";
			if ($id==1) {
				$status=0;
				$sql = "UPDATE categoria SET Estado='$status' WHERE IDCategoria='$id'";
			}else{
				$status=1;
				$sql = "UPDATE categoria SET Estado='$status' WHERE IDCategoria='$id'";
			}
			*/
			//$sql = "UPDATE categoria SET Estado='0',updated_by='$id_user' WHERE IDCategoria='$id_categoria'";
			$sql = "UPDATE categoria SET Estado='0' WHERE IDCategoria='$id_categoria'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_categoria/*,$id_user*/){
			$sql = "UPDATE categoria SET Estado='1' WHERE IDCategoria='$id_categoria'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_categoria){
			$sql = "SELECT * FROM categoria WHERE IDCategoria='$id_categoria'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT IDCategoria,Nombre,Detalle,Estado,updated_at FROM categoria";
			return ejecutarConsulta($sql);
		}
	}
?>