
<?php  
	
	require_once "../models/Role.php";

	$role = new Role();

	$id_role = isset($_POST["id_role"])? limpiarCadena($_POST["id_role"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			
			if (empty($id_role)) {
				$response = $role->create($nombre,$id_user);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
			}else{
				$response = $role->edit($id_role,$nombre,$id_user);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
			}

			break;
		case 'disable':
			$response = $role->disable($id_role);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Rol desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $role->enable($id_role);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Rol activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $role->mostrar($id_role);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $role->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Nombre,
					'1'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',
					'2'=>$item->NombreUsuario,
					'3'=>$item->updated_at,
					'4'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDRole.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDRole.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDRole.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDRole.')"><i class="fa fa-power-off"></i>
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

		default:			
			break;
	}
?>