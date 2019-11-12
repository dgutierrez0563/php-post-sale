
<?php
	//Validacion de session
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Accesos.php"; //inclusion del modelo

	$acceso = new Accesos(); //instanciacion del modelo
	//Recepcion de ids del formulario HTML
	$id_role = isset($_POST["id_role_asignacion"])? limpiarCadena($_POST["id_role_asignacion"]):"";
	$id_user = $_SESSION["coduser"]; //captura del id del usuario logueado

	switch ($_GET["action"]) { //Sentencias CASE
		//Validacion guardar datos
		case 'save_edit':
			
			if (empty($id_role)) {
				//si no existe el codigo de acceso se crea uno nuevo
				$response = $acceso->create($id_role,$_POST['permiso']);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
			}else{
				//si extiste el codigo de acceso se edita el codigo existente
				$codrole = $role->topCodRole();
				$response = $role->edit($codrole,$nombre,$id_user,$id_role);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
			}

			break;

		case 'listarAccesos': //listado de accesos en el formulario de permisos asiganados al role
			$response = $acceso->listarAccesos();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$no,
					'1'=>$item->Nombre,
					'2'=>$item->NombrePermiso,
					//'2'=>$item->Estado
					'3'=>($item->Estado ) ?
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;"> 
							<button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Eliminar" 
							onclick="eliminar('.$item->CodRolePermiso.')"><i class="fa fa-trash"></i>
							</button> </div>' :
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;"> 
							<button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Eliminar" 
							onclick="eliminar('.$item->CodRolePermiso.')"><i class="fa fa-trash"></i>
							</button>
						</div>'
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

		case 'eliminar': //configuracion de eliminar acceso al role en vista de permisos asignados
			//$id_role=4;
			$response = $acceso->eliminar($id_role);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso borrado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'listarRoles': //caso para listar las los roles del select

			$response = $acceso->listarRoles();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodRole . '>' . $item->Nombre . '</option>';				
			}
			
			break;

		case 'listarPermisos': //caso para listar las permisos del select

			require_once "../models/Permiso.php";

			$permiso = new Permiso();
			$response = $acceso->listarPermisos();

			while ($item = $response->fetch_object()) {
				echo '<li> <input type="checkbox" name="permiso[]" value="' .$item->CodPermiso. '"> ' .$item->NombrePermiso. ' </li> ';
			}			
			break;

		default:			
			break;
	}
?>