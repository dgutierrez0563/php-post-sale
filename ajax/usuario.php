
<?php  
	
	require_once "../models/Usuario.php";

	$usuario = new Usuario();

	$id_usuario = isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$tipo_aux = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";

	$numero_documento = isset($_POST["numero_documento"])? limpiarCadena($_POST["numero_documento"]):"";
	$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
	$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
	$correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
	$id_puesto = isset($_POST["id_puesto"])? limpiarCadena($_POST["id_puesto"]):"";
	$id_role = isset($_POST["id_role"])? limpiarCadena($_POST["id_role"]):"";
	$nombre_usuario = isset($_POST["nombre_usuario"])? limpiarCadena($_POST["nombre_usuario"]):"";
	$contrasenia = isset($_POST["contrasenia"])? limpiarCadena($_POST["contrasenia"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':

			if (($tipo_aux == "1") || ($tipo_aux == "2") || ($tipo_aux == "3")) {
				
				if($tipo_aux=="1"){ 
					$tipo_documento="Cedula Fisica"; 
				} elseif($tipo_aux=="2"){ 
					$tipo_documento="Cedula Juridica"; 
				} elseif($tipo_aux=="3"){ 
					$tipo_documento="Pasaporte"; 
				}

			//if (empty($id_categoria) && !empty($nombre) && !empty($detalle) && !empty($id_user)) {
				if (empty($id_proveedor)) {

					// if($tipo_aux="1"){ 
					// 	$tipo_documento="Cedula Fisica"; 
					// } elseif($tipo_aux="2"){ 
					// 	$tipo_documento="Cedula Juridica"; 
					// } elseif($tipo_aux="3"){ 
					// 	$tipo_documento="Pasaporte"; 
					// }
						$response = $usuario->create($nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user);
						echo $response ? "<div class='alert alert-info alert-dismissable'>
											<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
										</div>" : 
										"<div class='alert alert-warning alert-dismissable'>
											<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
										</div>";

				}else{

/*					if($tipo_aux="1"){ 
						$tipo_documento="Cedula Fisica"; 
					} elseif($tipo_aux="2"){ 
						$tipo_documento="Cedula Juridica"; 
					} elseif($tipo_aux="3"){ 
						$tipo_documento="Pasaporte"; 
					}*/

					$response = $usuario->edit($id_usuario,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user);
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
			//}else{
			//	echo $response="Error!\nCampos requeridos en blanco";
			//}
			break;
		case 'disable':
			$response = $usuario->disable($id_usuario);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Usuario desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $usuario->enable($id_usuario);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Usuario activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $usuario->mostrar($id_usuario);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $usuario->showAll();
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
					'6'=>$item->NombrePuesto,
					'7'=>$item->NombreRole,
					'8'=>$item->NombreUsuario,
					//'1'=>$item->Detalle,
					'9'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',//$item->Estado,
					'10'=>$item->updated_at,
					'11'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDUsuario.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDUsuario.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDUsuario.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDUsuario.')"><i class="fa fa-power-off"></i>
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

		case 'listarPuestos': //caso para listar las caategorias del select

			require_once "../models/Puesto.php";

			$puesto = new Puesto();
			$response = $puesto->listarPuestos();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->IDPuesto . '>' . $item->Nombre . '</option>';				
			}
			
			break;

		case 'listarRoles': //caso para listar las caategorias del select

			require_once "../models/Role.php";

			$role = new Role();
			$response = $role->listarRoles();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->IDRole . '>' . $item->Nombre . '</option>';				
			}
			
			break;

		default:			
			break;
	}
?>