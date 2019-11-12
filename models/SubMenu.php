
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Permiso
	*/
	class SubMenu
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codsubmenu,$nombre){
			$sql = "INSERT INTO submenu (NumSubMenu,NombreSubMenu) 
				VALUES('$codsubmenu','$nombre')";
			return ejecutarConsulta($sql);
		}

		public function edit($codsubmenu,$nombre,$codsubmenu_id){
			$sql = "UPDATE submenu SET NumSubMenu='$codsubmenu',NombreSubMenu='$nombre'
				WHERE NumSubMenu='$codsubmenu_id'";
			return ejecutarConsulta($sql);
		}

		public function disable($codsubmenu/*,$id_user*/){
			$sql = "UPDATE submenu SET Estado='0' WHERE IDSubMenu='$codsubmenu'";
			return ejecutarConsulta($sql);
		}

		public function enable($codsubmenu/*,$id_user*/){
			$sql = "UPDATE submenu SET Estado='1' WHERE IDSubMenu='$codsubmenu'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codsubmenu){
			$sql = "SELECT NumSubMenu,NombreSubMenu FROM submenu WHERE IDSubMenu='$codsubmenu'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT IDSubMenu,NumSubMenu,NombreSubMenu,Estado
				FROM submenu ORDER BY NumSubMenu ASC";
			return ejecutarConsulta($sql);
		}

		public function listarSubMenu(){
			$sql = "SELECT IDSubMenu,NumSubMenu,NombreSubMenu FROM submenu WHERE Estado='1' ORDER BY NumSubMenu ASC";
			return ejecutarConsulta($sql);
		}

		public function search_cod($codsubmenu){
			$sql = "SELECT NumSubMenu FROM submenu WHERE NumSubMenu='$codsubmenu'";
			return ejecutarConsultaPorFila($sql);
		}

		// public function topCodPermiso(){
		// 	$sql = "SELECT (CodPermiso+1) AS TopCod FROM permiso ORDER BY CodPermiso DESC LIMIT 0,1";
		// 	return ejecutarConsulta($sql);
		// }
	}
?>