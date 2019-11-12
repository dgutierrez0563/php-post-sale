<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Departamento.php";

	$departamento = new Departamento();

	$coddepartamento = isset($_POST["coddepartamento"])? limpiarCadena($_POST["coddepartamento"]):"";

	switch ($_GET["action"]) {

		case 'save_edit':
			$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
			$id_user = 1;

			$found_coddepartamento = $departamento->search_cod($coddepartamento);

			if ($found_coddepartamento==0) {
				$response = $departamento->create($coddepartamento,$nombre,$id_user);
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
				break;
			}else{
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Codigo Departamento ya existe
								</div>";
				break;
			}

		case 'edit':
			$coddepartamento_id_edit = isset($_POST["coddepartamento_id_edit"])? limpiarCadena($_POST["coddepartamento_id_edit"]):"";
			$coddepartamento_edit = isset($_POST["coddepartamento_edit"])? limpiarCadena($_POST["coddepartamento_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$id_user_edit = 1;// isset($_POST["id_user_edit"])? limpiarCadena($_POST["id_user_edit"]):"";

			$found_coddepartamento = $departamento->search_cod($coddepartamento_edit);
			
			if ($found_coddepartamento==0) {
				$response = $departamento->edit($coddepartamento_edit,$nombre_edit,$id_user_edit,$coddepartamento_id_edit);
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			}else{
				if ($coddepartamento_edit == $coddepartamento_id_edit) {
					$response = $departamento->edit($coddepartamento_edit,$nombre_edit,$id_user_edit,$coddepartamento_id_edit);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
					break;
				}else{
					echo $response = 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! Codigo Departamento ya existe
									</div>";
					break;
				}
			}

		case 'disable':
			//$id_user = 1;
			$response = $departamento->disable($coddepartamento);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria desactivada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $departamento->enable($coddepartamento);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Categoria activada
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $departamento->mostrar($coddepartamento);
			echo json_encode($response);
	 		break;

		case 'detalle':
			$response = $departamento->detalle($coddepartamento);
			echo json_encode($response);
	 		break;

		case 'showAll':
			$response = $departamento->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(

					'0'=>$item->CodDepartamento,
					'1'=>$item->NombreDepartamento,
					//'1'=>$item->Detalle,
					'2'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'3'=>$item->updated_at,
					'4'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodDepartamento.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" 
							onclick="disable('.$item->CodDepartamento.')"><i class="fa fa-power-off"></i>
							</button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodDepartamento.')"><i class="fa fa-eye"></i>
							</button>
						</div>' : 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodDepartamento.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Activar" 
							onclick="enable('.$item->CodDepartamento.')"><i class="fa fa-power-off"></i>
							</button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodDepartamento.')"><i class="fa fa-eye"></i>
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