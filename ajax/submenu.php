
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/SubMenu.php";

	$submenu = new SubMenu();

	$codsubmenu = isset($_POST["codsubmenu"])? limpiarCadena($_POST["codsubmenu"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':

			$found_codsubmenu=$submenu->search_cod($codsubmenu);

			if ($found_codsubmenu==0) {
				$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
				//$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $submenu->create($codsubmenu,$nombre);
				
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
									<i class='icon fa fa-times-circle'></i>Error! Codigo SubMenu ya existe
								</div>";
				break;
			}
		case 'edit':

			$codsubmenu_edit = isset($_POST["codsubmenu_edit"])? limpiarCadena($_POST["codsubmenu_edit"]):"";
			$codsubmenu_id_edit = isset($_POST["codsubmenu_id_edit"])? limpiarCadena($_POST["codsubmenu_id_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			//$id_user_edit = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";	
			
			$found_codsubmenu=$submenu->search_cod($codsubmenu_edit);

			if ($found_codsubmenu==0) {

				$response = $submenu->edit($codsubmenu_edit,$nombre_edit,$codsubmenu_id_edit);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			} else {
				if ($codsubmenu_edit==$codsubmenu_id_edit) {
					$response = $submenu->edit($codsubmenu_edit,$nombre_edit,$codsubmenu_id_edit);

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
										<i class='icon fa fa-times-circle'></i>Error! Codigo SubMenu ya existe
									</div>";
					break;
				}
			}
		case 'disable':
			$response = $submenu->disable($codsubmenu);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! SubMenu desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $submenu->enable($codsubmenu);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! SubMenu activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $submenu->mostrar($codsubmenu);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $submenu->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->NumSubMenu,
					'1'=>$item->NombreSubMenu,
					'2'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					//'4'=>$item->NombreUsuario,
					//'5'=>$item->updated_at,
					'3'=>($item->Estado) ? 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDSubMenu.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDSubMenu.')"><i class="fa fa-power-off"></i>
							</button>
						</div>' : 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDSubMenu.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDSubMenu.')"><i class="fa fa-power-off"></i>
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

		// case 'listarPermisos': //caso para listar las caategorias del select

		// 	require_once "../models/Permiso.php";

		// 	$permiso = new Permiso();
		// 	$response = $permiso->listarPermisos();

		// 	while ($item = $response->fetch_object()) {
		// 		echo '<option value=' .$item->CodPermiso . '>' . $item->NombrePermiso . '</option>';				
		// 	}
			
		// 	break;

		default:			
			break;
	}
?>