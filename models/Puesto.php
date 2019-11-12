
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

		public function create($codpuesto,$nombre,$cod_departamento,$id_user){
			$sql = "INSERT INTO puesto (CodPuesto,NombrePuesto,CodDepartamento,created_by,updated_by) 
				VALUES('$codpuesto','$nombre','$cod_departamento','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codpuesto,$nombre,$cod_departamento,$id_user,$codpuesto_id_edit){
			$sql = "UPDATE puesto SET CodPuesto='$codpuesto',NombrePuesto='$nombre',
				CodDepartamento='$cod_departamento',updated_by='$id_user' WHERE CodPuesto='$codpuesto_id_edit'";
			return ejecutarConsulta($sql);
		}

		public function disable($codpuesto/*,$id_user*/){
			$sql = "UPDATE puesto SET Estado='0' WHERE CodPuesto='$codpuesto'";
			return ejecutarConsulta($sql);
		}

		public function enable($codpuesto/*,$id_user*/){
			$sql = "UPDATE puesto SET Estado='1' WHERE CodPuesto='$codpuesto'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codpuesto){
			$sql = "SELECT CodPuesto,NombrePuesto,CodDepartamento 
			FROM puesto WHERE CodPuesto='$codpuesto'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT p.CodPuesto AS CodPuesto,p.NombrePuesto AS NombrePuesto,
			d.CodDepartamento,d.NombreDepartamento AS NombreDepartamento,p.Estado AS Estado 
			FROM puesto p 
			INNER JOIN departamento d 
			ON p.CodDepartamento=d.CodDepartamento";
			return ejecutarConsulta($sql);
		}

		public function listarPuestos(){
			$sql = "SELECT CodPuesto,NombrePuesto 
			FROM puesto WHERE Estado='1' ORDER BY NombrePuesto ASC";
			return ejecutarConsulta($sql);
		}

		public function detalle($codpuesto){
			$sql = "SELECT p.CodPuesto,p.NombrePuesto,
			p.CodDepartamento,p.Estado,p.updated_by,p.created_at,
			p.updated_at,d.CodDepartamento,d.NombreDepartamento AS NombreDepartamento,u.CodUsuario,
			u.NombreUsuario
			FROM puesto p 
			INNER JOIN departamento d ON p.CodDepartamento=d.CodDepartamento
			INNER JOIN usuario u ON p.updated_by=u.CodUsuario
			WHERE p.CodPuesto='$codpuesto'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($codpuesto){
			$sql = "SELECT CodPuesto FROM puesto WHERE CodPuesto='$codpuesto'";
			return ejecutarConsultaPorFila($sql);
		}
	}
?>