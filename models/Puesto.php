
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Puesto
	*/
	class Puesto
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($nombre,$id_departamento,$id_user){
			$sql = "INSERT INTO puesto (Nombre,IDDepartamento,created_by,updated_by) VALUES('$nombre','$id_departamento','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_puesto,$nombre,$id_departamento,$id_user){
			$sql = "UPDATE puesto SET Nombre='$nombre',IDDepartamento='$id_departamento',updated_by='$id_user' WHERE IDPuesto='$id_puesto'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_puesto/*,$id_user*/){
			$sql = "UPDATE puesto SET Estado='0' WHERE IDDepartamento='$id_puesto'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_puesto/*,$id_user*/){
			$sql = "UPDATE puesto SET Estado='1' WHERE IDPuesto='$id_puesto'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_puesto){
			$sql = "SELECT * FROM puesto WHERE IDPuesto='$id_puesto'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT p.IDPuesto,p.Nombre,p.IDDepartamento,p.Estado,p.updated_at,d.IDDepartamento,d.Nombre AS NombreDepartamento FROM puesto p INNER JOIN departamento d ON p.IDDepartamento=d.IDDepartamento";
			return ejecutarConsulta($sql);
		}
	}
?>