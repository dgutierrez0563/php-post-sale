
<?php  
	
	require_once "../models/Cliente.php";

	$cliente = new Cliente();

	$id_cliente = isset($_POST["id_cliente"])? limpiarCadena($_POST["id_cliente"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$tipo_aux = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
	$numero_documento = isset($_POST["numero_documento"])? limpiarCadena($_POST["numero_documento"]):"";
	$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
	$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
	$correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {

		case 'save_edit':

			if (($tipo_aux == "Cedula Fisica") || ($tipo_aux == "Cedula Juridica") || ($tipo_aux == "Pasaporte")) {
				
				$tipo_documento = $tipo_aux;

				if (empty($id_cliente)) {

						$response = $cliente->create($nombre,$tipo_documento,$numero_documento,$telefono,$correo,$direccion,$id_user);
						echo $response ? "<div class='alert alert-info alert-dismissable'>
											<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
										</div>" : 
										"<div class='alert alert-warning alert-dismissable'>
											<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
										</div>";

				}else{

					$response = $cliente->edit($id_cliente,$nombre,$tipo_documento,$numero_documento,$telefono,$correo,$direccion,$id_user);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
				}

			}else{
				echo $response = "<div class='alert alert-danger alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Warning! Tipo de Documento Incorrecto
								</div>";
			}
			break;

		case 'disable':
			$response = $cliente->disable($id_cliente);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Cliente desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'enable':
			$response = $cliente->enable($id_cliente);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Cliente activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'mostrar':
			$response = $cliente->mostrar($id_cliente);
			echo json_encode($response);
	 		break;

		case 'showAll':
			$response = $cliente->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Nombre,
					'1'=>$item->NumeroDocumento,
					'2'=>$item->TipoDocumento,
					'3'=>$item->Telefono,
					'4'=>$item->Correo,
					'5'=>$item->Direccion,
					'6'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',
					'7'=>$item->updated_at,
					'8'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDCliente.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDCliente.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDCliente.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDCliente.')"><i class="fa fa-power-off"></i>
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