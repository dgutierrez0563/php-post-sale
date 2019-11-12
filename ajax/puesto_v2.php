<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Puesto.php";

	$puesto = new Puesto();

	$codpuesto_id = isset($_POST["codpuesto_id"])? limpiarCadena($_POST["codpuesto_id"]):"";
	$codpuesto = isset($_POST["codpuesto"])? limpiarCadena($_POST["codpuesto"]):"";

	switch ($_GET["action"]) {

		case 'save_edit':
			
			$found_puesto=$puesto->search_cod($codpuesto);

			if ($found_puesto==0) {

				$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
				$coddepartamento = isset($_POST["coddepartamento"])? limpiarCadena($_POST["coddepartamento"]):"";
				$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $puesto->create($codpuesto,$nombre,$coddepartamento,$id_user);

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
									<i class='icon fa fa-times-circle'></i>Error! Codigo puesto ya existe
								</div>";
				break;
			}
		case 'edit':

			$codpuesto_id_edit = isset($_POST["codpuesto_id_edit"])? limpiarCadena($_POST["codpuesto_id_edit"]):"";
			$codpuesto_edit = isset($_POST["codpuesto_edit"])? limpiarCadena($_POST["codpuesto_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$coddepartamento_edit = isset($_POST["coddepartamento_edit"])? limpiarCadena($_POST["coddepartamento_edit"]):"";
			$id_user_edit = $_SESSION["coduser"];// isset($_POST["id_user_edit"])? limpiarCadena($_POST["id_user_edit"]):"";

			$found_puesto=$puesto->search_cod($codpuesto_edit);

			if ($found_puesto==0) {

				$response = $puesto->edit($codpuesto_edit,$nombre_edit,$coddepartamento_edit,$id_user_edit,$codpuesto_id_edit);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			} else {
				if ($codpuesto_edit==$codpuesto_id_edit) {
					$response = $puesto->edit($codpuesto_edit,$nombre_edit,$coddepartamento_edit,$id_user_edit,$codpuesto_id_edit);

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
										<i class='icon fa fa-times-circle'></i>Error! Codigo puesto ya existe
									</div>";
					break;
				}				
			}

		case 'disable': //caso para deshabilitar un articulo
			$response = $puesto->disable($codpuesto);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Puesto desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable': //caso para habilitar un articulo
			$response = $puesto->enable($codpuesto);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Puesto activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $puesto->mostrar($codpuesto);
			echo json_encode($response);
	 		break;
		case 'detalle':
			$response = $puesto->detalle($codpuesto);
			echo json_encode($response);
	 		break;
		case 'showAll': //caso para listar el index de todos los datos
			$response = $puesto->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodPuesto,
					'1'=>$item->NombrePuesto,
					'2'=>$item->NombreDepartamento,
					'3'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'4'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodPuesto.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" 
							onclick="disable('.$item->CodPuesto.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodPuesto.')"><i class="fa fa-eye"></i>
							</button>
							</div>' : 
							'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodPuesto.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Acivar" 
							onclick="enable('.$item->CodPuesto.')"><i class="fa fa-power-off"></i>
							</button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodPuesto.')"><i class="fa fa-eye"></i>
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

		case 'listarDepartamentos': //caso para listar las caategorias del select

			require_once "../models/Departamento.php";

			$departamento = new Departamento();
			$response = $departamento->listarDepartamentos();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodDepartamento . '>' . $item->NombreDepartamento . '</option>';				
			}			
			break;

		default:			
			break;
	}
?>