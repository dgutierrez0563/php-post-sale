
<?php  
	
	require_once "../models/Proveedor.php";

	$proveedor = new Proveedor();

	$id_proveedor = isset($_POST["id_proveedor"])? limpiarCadena($_POST["id_proveedor"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$tipo_documento = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
	$numero_documento = isset($_POST["numero_documento"])? limpiarCadena($_POST["numero_documento"]):"";
	$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
	$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
	$correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			//if (empty($id_categoria) && !empty($nombre) && !empty($detalle) && !empty($id_user)) {
				if (empty($id_proveedor)) {
					$response = $proveedor->create($nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user);
					//echo $response ? "Datos registrados correctamente" : "Error!\nNo se completo el registro";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
				}else{
					$response = $proveedor->edit($id_proveedor,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user);
					//echo $response ? "<div class='clean-green' align='left'><i class='fa fa-check' style='text-align:left;'></i>  Datos actualizados correctamente</div>" : "<div class='clean-orange'>Error!\nNo se completo la actualizacion";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
				}
			//}else{
			//	echo $response="Error!\nCampos requeridos en blanco";
			//}
			break;
		case 'disable':
			$response = $proveedor->disable($id_proveedor);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Proveedor desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $proveedor->enable($id_proveedor);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Proveedor activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $proveedor->mostrar($id_proveedor);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $proveedor->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Nombre,
					'1'=>$item->TipoDocumento,
					'2'=>$item->NumeroDocumento,
					'3'=>$item->Direccion,
					'4'=>$item->Telefono,
					'5'=>$item->Correo,
					//'1'=>$item->Detalle,
					'6'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',//$item->Estado,
					'7'=>$item->updated_at,
					'8'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDProveedor.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDProveedor.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDProveedor.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDProveedor.')"><i class="fa fa-power-off"></i>
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