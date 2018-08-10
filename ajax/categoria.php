<?php  
	
	require_once "../models/Categoria.php";

	$categoria = new Categoria();

	$id_categoria = isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			//if (empty($id_categoria) && !empty($nombre) && !empty($detalle) && !empty($id_user)) {
				if (empty($id_categoria)) {
					$response = $categoria->create($nombre,$detalle,$id_user);
					//echo $response ? "Datos registrados correctamente" : "Error!\nNo se completo el registro";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
				}else{
					$response = $categoria->edit($id_categoria,$nombre,$detalle,$id_user);
					//echo $response ? "<div class='clean-green' align='left'><i class='fa fa-check' style='text-align:left;'></i>  Datos actualizados correctamente</div>" : "<div class='clean-orange'>Error!\nNo se completo la actualizacion";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
				}
			break;
		case 'disable':
			$response = $categoria->disable($id_categoria);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria desactivada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $categoria->enable($id_categoria);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria activada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $categoria->mostrar($id_categoria);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $categoria->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					//'0'=>$item->IDCategoria,
					//'0'=>'<button class="btn btn-default btn-xs" onclick="showItem('.$item->IDCategoria.')"><i class="fa fa-edit" style="font-size:10px;"></i></button>',
					//'0'=>$no,
					'0'=>$item->Nombre,
					'1'=>$item->Detalle,
					'2'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',//$item->Estado,
					'3'=>$item->updated_at,
					'4'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDCategoria.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDCategoria.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDCategoria.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDCategoria.')"><i class="fa fa-power-off"></i>
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