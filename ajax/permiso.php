
<?php  
	
	require_once "../models/Permiso.php";

	$permiso = new Permiso();

	$id_permiso = isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			
			if (empty($id_permiso)) {
				$response = $permiso->create($nombre,$id_user);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
			}else{
				$response = $permiso->edit($id_permiso,$nombre,$detalle,$id_user);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
			}

			break;
		case 'disable':
			$response = $permiso->disable($id_permiso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $permiso->enable($id_permiso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $permiso->mostrar($id_permiso);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $permiso->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Nombre,
					'1'=>$item->Detalle,
					'2'=>$item->NombreUsuario,
					'3'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',
					'4'=>$item->updated_at,
					'5'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDPermiso.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDPermiso.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDPermiso.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDPermiso.')"><i class="fa fa-power-off"></i>
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