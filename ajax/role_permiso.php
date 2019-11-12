
<?php  
	session_start();
	require_once "../models/RolePermiso.php";
	
	$acceso = new RolePermiso();
	
	$id_role_asignacion = isset($_POST["id_role_asignacion"])? limpiarCadena($_POST["id_role_asignacion"]):"";
	$id_permiso = isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";
	$permisos = isset($_POST["permisos"]) ;//? limpiarCadena($_POST["permisos"]):"";
	$id_user = $_SESSION["coduser"];// isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";


	switch ($_GET["action"]) {

		case 'createAcceso':
			//falta completar los parametros que entran para crear accesos
			//existeRolePermisoID
			$row = $acceso->existeRolePermisoID($id_role_asignacion,$id_permiso);

			if (empty($row)) {

				// $num_items = 0;
				// $var_stop = true;

				// while ($num_items < count($_POST['permisos'])) {
				// 	$aux=$permisos[$num_items];
				// 	// $sql = "INSERT INTO RolePermiso (CodRole,CodPermiso,created_by,updated_by)
				// 	// VALUES ('$id_role_asignacion','$aux','$id_user','$id_user')";

				// 	// return ejecutarConsulta($sql) OR $var_stop = false;
				// 	//$response = $acceso->create($id_role_asignacion,$aux,$id_user);
				// 	echo $aux;
				// 	$num_items = $num_items ++;
					
				// 	echo $response ? "<div class='alert alert-info alert-dismissable'>
				// 						<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
				// 					</div>" : 
				// 					"<div class='alert alert-warning alert-dismissable'>
				// 						<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
				// 					</div>";
				// }

				//return $var_stop;

				$response = $acceso->create($id_role_asignacion,$id_permiso,$id_user);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
								
			}else{
				echo $response = "<div class='alert alert-danger alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Warning! Tipo de permiso asignado al Role ya existe
								</div>";
			}

			break;

		case 'viewRoleAccesos':

			$response = $acceso->view();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					//'0'=>$item->NombreRole,
					'0'=>$item->NombrePermiso,
					'2'=>$item->NombreUsuario,
					'3'=>$item->updated_at,
					'4'=>'<button class="btn btn-danger btn-xs" onclick="deleteAcceso('.$item->CodRolePermiso.')">
							<i class="fa fa-trash"></i>
						  </button>'
				);
				$no++;
			}

			$results = array(
				'sEcho'=>1, //information for dataTables
				'iTotalRecords'=>count($data), //total items for dataTables
				'iTotalDisplayRecords'=>count($data),//total items for view
				'aaData'=>$data
			);
			echo json_encode($results);
			break;

		case 'deleteAcceso':

			//require_once "../models/RolePermiso.php";

			//$acceso = new RolePermiso();

			$response = $acceso->delete($id_role);
			echo json_encode($response);
	 		break;

		case 'listarRoles':

			require_once "../models/Role.php";

			$role = new Role();

			$response = $role->listarRoles();
			echo json_encode($response);
	 		break;

		case 'listarPermisos': //caso para listar las caategorias del select

			require_once "../models/Permiso.php";

			$permiso = new Permiso();
			$response = $permiso->listarPermisos();

			while ($item = $response->fetch_object()) {
				echo '<li> <input type="checkbox" id="permisos[]" name="permisos[]" value="' .$item->CodPermiso. '"> ' .$item->NombrePermiso. ' </li> ';
			}
			
			break;

		default:			
			break;
	}
?>