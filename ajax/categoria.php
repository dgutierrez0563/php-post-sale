<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Categoria.php";

	$categoria = new Categoria();

	$codcategoria = isset($_POST["codcategoria"])? limpiarCadena($_POST["codcategoria"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			
			$found_codcategoria=$categoria->search_cod($codcategoria);

			if ($found_codcategoria==0) {

				$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
				$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
				$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $categoria->create($codcategoria,$nombre,$detalle,$id_user);

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
									<i class='icon fa fa-times-circle'></i>Error! Codigo Categoria ya existe
								</div>";
				break;
			}
		case 'edit':

			$codcategoria_id_edit = isset($_POST["codcategoria_id_edit"])? limpiarCadena($_POST["codcategoria_id_edit"]):"";
			$codcategoria_edit = isset($_POST["codcategoria_edit"])? limpiarCadena($_POST["codcategoria_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$detalle_edit = isset($_POST["detalle_edit"])? limpiarCadena($_POST["detalle_edit"]):"";
			$id_user_edit = $_SESSION["coduser"];// isset($_POST["id_user_edit"])? limpiarCadena($_POST["id_user_edit"]):"";

			$found_codcategoria=$categoria->search_cod($codcategoria_edit);

			if ($found_codcategoria==0) {

				$response = $categoria->edit($codcategoria_edit,$nombre_edit,$detalle_edit,$id_user_edit,$codcategoria_id_edit);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			} else {
				if ($codcategoria_edit==$codcategoria_id_edit) {
					$response = $categoria->edit($codcategoria_edit,$nombre_edit,$detalle_edit,$id_user_edit,$codcategoria_id_edit);

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
										<i class='icon fa fa-times-circle'></i>Error! Codigo Categoria ya existe
									</div>";
					break;
				}				
			}
		case 'disable':
			$response = $categoria->disable($codcategoria);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria desactivada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $categoria->enable($codcategoria);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria activada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $categoria->mostrar($codcategoria);
			echo json_encode($response);
	 		break;
		case 'detalle':
			$response = $categoria->detalle($codcategoria);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $categoria->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodCategoria,
					'1'=>$item->NombreCategoria,
					'2'=>$item->Detalle,
					'3'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'4'=>$item->updated_at,
					'5'=>($item->Estado) ? 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" onclick="mostrar('.$item->CodCategoria.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" onclick="disable('.$item->CodCategoria.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" onclick="detalle('.$item->CodCategoria.')"><i class="fa fa-eye"></i>
							</button>
						</div>' :  
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" onclick="mostrar('.$item->CodCategoria.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Activar" onclick="enable('.$item->CodCategoria.')"><i class="fa fa-power-off"></i>
							</button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" onclick="detalle('.$item->CodCategoria.')"><i class="fa fa-eye"></i>
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
		default:			
			break;
	}
?>