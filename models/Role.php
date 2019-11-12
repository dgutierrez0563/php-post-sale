
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Puesto
	*/
	class Role
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}
		//funcion crear datos
		public function create($codrole,$nombre,$id_user){
			$sql = "INSERT INTO role (CodRole,Nombre,created_by,updated_by) VALUES('$codrole','$nombre','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}
		//funcion editar datos
		public function edit($codrole,$nombre,$id_user,$codrole_id){
			$sql = "UPDATE role SET CodRole='$codrole',Nombre='$nombre',updated_by='$id_user' WHERE CodRole='$codrole_id'";
			return ejecutarConsulta($sql);
		}
		//funcion deshabilitar role
		public function disable($codrole/*,$id_user*/){
			$sql = "UPDATE role SET Estado='0' WHERE CodRole='$codrole'";
			return ejecutarConsulta($sql);
		}
		//funcion habilitar role
		public function enable($codrole/*,$id_user*/){
			$sql = "UPDATE role SET Estado='1' WHERE CodRole='$codrole'";
			return ejecutarConsulta($sql);
		}
		//funcion para mostrar datos a editar
		public function mostrar($codrole){
			$sql = "SELECT * FROM role WHERE CodRole='$codrole'";
			return ejecutarConsultaPorFila($sql);
		}
		
		//funcion de listado de todos los role en vista
		public function showAll(){
			$sql = "SELECT r.CodRole,r.Nombre,r.Estado,r.updated_by,r.updated_at,u.CodUsuario,u.NombreUsuario FROM role r INNER JOIN usuario u ON r.updated_by=u.CodUsuario";
			return ejecutarConsulta($sql);
		}
		//funcion listar roles para los selectpicker
		public function listarRoles(){
			$sql = "SELECT CodRole,Nombre,Estado FROM role WHERE Estado='1' ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}
		//funcion de mostrar detalles en e formulario detalles role
		public function detalle($codrole){
			$sql = "SELECT r.CodRole,r.Nombre,r.Estado,
			r.created_at,r.updated_at,u.NombreUsuario
			FROM role r INNER JOIN usuario u ON r.updated_by=u.CodUsuario
			WHERE r.CodRole='$codrole'";
			return ejecutarConsultaPorFila($sql);
		}

		// public function topCodRole(){
		// 	$sql = "SELECT (CodRole+1) AS TopCod FROM role ORDER BY CodRole DESC LIMIT 0,1";
		// 	return ejecutarConsulta($sql);
		// }
		
		//funcion para buscar codigo a recibir si existe
		public function search_cod($codrole){
			$sql = "SELECT CodRole FROM role WHERE CodRole='$codrole'";
			return ejecutarConsultaPorFila($sql);
		}
		//funcion para ver todos los accesos por role
		public function viewRoleAccesos($codrole){
			$sql = "SELECT rp.CodRolePermiso,p.CodPermiso,p.NombrePermiso FROM rolepermiso rp INNER JOIN role r ON rp.CodRole=r.CodRole
			INNER JOIN permiso p ON rp.CodPermiso = p.CodPermiso
			WHERE p.Estado='1' AND r.CodRole='$codrole'";

			return ejecutarConsulta($sql);
		}
		//funcion para eliminar acceso a role en vista asiganciond de accesos
		public function deleteAcceso($id_acceso){
			$sql = "DELETE FROM rolepermiso WHERE CodRolePermiso='$id_acceso'";
			return ejecutarConsulta($sql);
		}
	}
?>