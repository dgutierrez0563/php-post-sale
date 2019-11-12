
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Proveedor.php";

	$proveedor = new Proveedor();

	$codproveedor = isset($_POST["codproveedor"])? limpiarCadena($_POST["codproveedor"]):"";
	$tipo_aux = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";

	switch ($_GET["action"]) {

		case 'save_edit':

			$found_codproveedor=$proveedor->search_cod($codproveedor);

			if ($found_codproveedor==0) {

				if (($tipo_aux == "Cedula Fisica") || ($tipo_aux == "Cedula Juridica") || ($tipo_aux == "Pasaporte")) {

					$tipo_documento = $tipo_aux;
					$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
					$numero_documento = isset($_POST["numero_documento"])? limpiarCadena($_POST["numero_documento"]):"";
					$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
					$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
					$correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
					$id_user = $_SESSION["coduser"];;

					$response = $proveedor->create($codproveedor,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
					break;

				}else{
					echo $response = "<div class='alert alert-danger alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Warning! Tipo de Documento Incorrecto
									</div>";
					break;
				}
				
			} else {
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Codigo Proveedor ya existe
								</div>";
				break;
			}
			
		case 'edit':
			$codproveedor_id_edit = isset($_POST["codproveedor_id_edit"])? limpiarCadena($_POST["codproveedor_id_edit"]):"";
			$codproveedor_edit = isset($_POST["codproveedor_edit"])? limpiarCadena($_POST["codproveedor_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$tipo_documento_edit = isset($_POST["tipo_documento_edit"])? limpiarCadena($_POST["tipo_documento_edit"]):"";
			$numero_documento_edit = isset($_POST["numero_documento_edit"])? limpiarCadena($_POST["numero_documento_edit"]):"";
			$direccion_edit = isset($_POST["direccion_edit"])? limpiarCadena($_POST["direccion_edit"]):"";
			$telefono_edit = isset($_POST["telefono_edit"])? limpiarCadena($_POST["telefono_edit"]):"";
			$correo_edit = isset($_POST["correo_edit"])? limpiarCadena($_POST["correo_edit"]):"";
			$id_user_edit = $_SESSION["coduser"];//isset($_POST["id_user_edit"])? limpiarCadena($_POST["id_user_edit"]):"";

			$found_codproveedor=$proveedor->search_cod($codproveedor_edit);

			if (($tipo_documento_edit == "Cedula Fisica") || ($tipo_documento_edit == "Cedula Juridica") || ($tipo_documento_edit == "Pasaporte")) {
				if ($found_codproveedor==0) {

					$response = $proveedor->edit($codproveedor_edit,$nombre_edit,$tipo_documento_edit,
					$numero_documento_edit,$direccion_edit,$telefono_edit,$correo_edit,$id_user_edit,$codproveedor_id_edit);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
					break;
				} else {
					if ($codproveedor_edit==$codproveedor_id_edit) {
						$response = $proveedor->edit($codproveedor_edit,$nombre_edit,$tipo_documento_edit,
						$numero_documento_edit,$direccion_edit,$telefono_edit,$correo_edit,$id_user_edit,$codproveedor_id_edit);
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
											<i class='icon fa fa-times-circle'></i>Error! Codigo Proveedor ya existe
										</div>";
						break;
					}
				}
			} else {
				echo $response = "<div class='alert alert-danger alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Warning! Tipo de Documento Incorrecto
								</div>";
				break;
			}
		case 'disable':
			$response = $proveedor->disable($codproveedor);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Proveedor desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'enable':
			$response = $proveedor->enable($codproveedor);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Proveedor activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'mostrar':
			$response = $proveedor->mostrar($codproveedor);
			echo json_encode($response);
	 		break;

		case 'detalle':
			$response = $proveedor->detalle($codproveedor);
			echo json_encode($response);
	 		break;

		case 'showAll':
			$response = $proveedor->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodProveedor,
					'1'=>$item->Nombre,
					'2'=>$item->Telefono,
					//'1'=>$item->Detalle,
					'3'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'4'=>$item->updated_at,
					'5'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodProveedor.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" 
							onclick="disable('.$item->CodProveedor.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodProveedor.')"><i class="fa fa-eye"></i>
							</button>
						</div>' :
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodProveedor.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Acivar" 
							onclick="enable('.$item->CodProveedor.')"><i class="fa fa-power-off"></i>
							</button>'
							. ' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodProveedor.')"><i class="fa fa-eye"></i>
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