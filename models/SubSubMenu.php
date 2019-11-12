
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Permiso
	*/
	class SubSubMenu
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}
		//Funcion crear datos de subsubmenu
		public function create($codsubmenu,$codarticulo,$detalle1,$detalle2){

			$item = 0;
			$var_response = true;
			//recorrido de los arrays para ingresar uno a uno los datos en la tabla,. probenientes del archivo js del subsubmenu
			while ($item < count($codarticulo)) {
				$sql_detalle = "INSERT INTO subsubmenu (IDSubMenu,CodArticulo,Detalle1,Detalle2)
					VALUES ('$codsubmenu', '$codarticulo[$item]','$detalle1[$item]','$detalle2[$item]')";
				
				ejecutarConsulta($sql_detalle) or $var_response = false; //validacion
				$item=$item + 1;
			}
			return $var_response;
		}
		//Funcion editar datos de subsubmenu
		public function edit($idsubmenu,$codarticulo,$detalle1,$detalle2,$idsubsubmenu_id){
			$sql = "UPDATE subsubmenu SET IDSubMenu='$idsubmenu',CodArticulo='$codarticulo',
				Detalle1='$detalle1',Detalle2='$detalle2'
				WHERE IDSubSubMenu='$idsubsubmenu_id'";
			return ejecutarConsulta($sql);
		}
		//Funcion borrar datos de subsubmenu
		public function delete($idsubsubmenu/*,$id_user*/){
			$sql = "DELETE FROM subsubmenu WHERE IDSubSubMenu='$idsubsubmenu'";
			return ejecutarConsulta($sql);
		}
		//Funcion mostrar datos de subsubmenu en el formulario de edicion
		public function mostrar($idsubsubmenu){
			$sql = "SELECT IDSubSubMenu,IDSubMenu,CodArticulo,Detalle1,Detalle2 
				FROM subsubmenu 
				WHERE IDSubSubMenu='$idsubsubmenu'";
			return ejecutarConsultaPorFila($sql);
		}
		//Funcion listar todos los datos de subsubmenu en vista dataTable
		public function showAll(){
			$sql = "SELECT ss.IDSubSubMenu AS IDSubSubMenu,ss.IDSubMenu,ss.CodArticulo,
				s.NombreSubMenu,a.NombreArticulo,ss.Detalle1,ss.Detalle2
				FROM subsubmenu ss INNER JOIN submenu s ON ss.IDSubMenu=s.IDSubMenu
				INNER JOIN articulo a ON ss.CodArticulo=a.CodArticulo";
			return ejecutarConsulta($sql);
		}
	}
?>