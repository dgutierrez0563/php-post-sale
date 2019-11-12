
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Permiso.php";

	$permiso = new Permiso();

	$codpermiso = isset($_POST["codpermiso"])? limpiarCadena($_POST["codpermiso"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':

			$found_permiso=$permiso->search_cod($codpermiso);

			if ($found_permiso==0) {
				$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
				$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
				$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $permiso->create($codpermiso,$nombre,$detalle,$id_user);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
				break;
			} else {
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Codigo permiso ya existe
								</div>";
				break;
			}
		case 'edit':

			$codpermiso_edit = isset($_POST["codpermiso_edit"])? limpiarCadena($_POST["codpermiso_edit"]):"";
			$codpermiso_id_edit = isset($_POST["codpermiso_id_edit"])? limpiarCadena($_POST["codpermiso_id_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$detalle_edit = isset($_POST["detalle_edit"])? limpiarCadena($_POST["detalle_edit"]):"";
			$id_user_edit = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";	
			
			$found_permiso=$permiso->search_cod($codpermiso_edit);

			if ($found_permiso==0) {

				$response = $permiso->edit($codpermiso_edit,$nombre_edit,$detalle_edit,$id_user_edit,$codpermiso_id_edit);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			} else {
				if ($codpermiso_edit==$codpermiso_id_edit) {
					$response = $permiso->edit($codpermiso_edit,$nombre_edit,$detalle_edit,$id_user_edit,$codpermiso_id_edit);

					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
					break;
				} else {
					echo $response = 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! Codigo permiso ya existe
									</div>";
					break;
				}
			}
		case 'disable':
			$response = $permiso->disable($codpermiso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $permiso->enable($codpermiso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $permiso->mostrar($codpermiso);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $permiso->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodPermiso,
					'1'=>$item->NombrePermiso,
					'2'=>$item->Detalle,
					'3'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'4'=>$item->NombreUsuario,
					'5'=>$item->updated_at,
					'6'=>($item->Estado) ? 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->CodPermiso.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->CodPermiso.')"><i class="fa fa-power-off"></i>
							</button>
						</div>' : 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->CodPermiso.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-success btn-xs" onclick="enable('.$item->CodPermiso.')"><i class="fa fa-power-off"></i>
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

		case 'listarPermisos': //caso para listar las caategorias del select

			require_once "../models/Permiso.php";

			$permiso = new Permiso();
			$response = $permiso->listarPermisos();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodPermiso . '>' . $item->NombrePermiso . '</option>';				
			}			
			break;

		default:			
			break;
	}
?>