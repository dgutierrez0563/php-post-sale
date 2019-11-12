
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Usuario.php";

	$usuario = new Usuario();

	$codusuario = isset($_POST["codusuario"])? limpiarCadena($_POST["codusuario"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':

			$found_codusuario=$usuario->search_cod($codusuario);

			if ($found_codusuario==0) {

				$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
				$tipo_aux = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";

				$numero_documento = isset($_POST["numero_documento"])? limpiarCadena($_POST["numero_documento"]):"";
				$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
				$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
				$correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
				$id_puesto = isset($_POST["id_puesto"])? limpiarCadena($_POST["id_puesto"]):"";
				$id_role = isset($_POST["id_role"])? limpiarCadena($_POST["id_role"]):"";
				$nombre_usuario = isset($_POST["nombre_usuario"])? limpiarCadena($_POST["nombre_usuario"]):"";
				$clave_hash = isset($_POST["contrasenia"])? limpiarCadena($_POST["contrasenia"]):"";
				$contrasenia = hash("SHA256",$clave_hash);
				$id_user = $_SESSION["coduser"];

				if (($tipo_aux == "Cedula Fisica") || ($tipo_aux == "Cedula Juridica") || ($tipo_aux == "Pasaporte")) {

					$tipo_documento = $tipo_aux;

					$response = $usuario->create($codusuario,$nombre,$tipo_documento,$numero_documento,$direccion,
						$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
					break;

					// if (empty($codusuario)) {

					// 	$response = $usuario->create($codusuario,$nombre,$tipo_documento,$numero_documento,$direccion,
					// 		$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user);
					// 	echo $response ? "<div class='alert alert-info alert-dismissable'>
					// 						<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
					// 					</div>" : 
					// 					"<div class='alert alert-warning alert-dismissable'>
					// 						<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
					// 					</div>";

					// }else{

					// 	$response = $usuario->edit($codusuario,$nombre,$tipo_documento,$numero_documento,$direccion,
					// 		$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user,$codusuario_id);
					// 	echo $response ? "<div class='alert alert-info alert-dismissable'>
					// 						<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
					// 					</div>" : 
					// 					"<div class='alert alert-warning alert-dismissable'>
					// 						<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
					// 					</div>";
					// }

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
			$codusuario_edit = isset($_POST["codusuario_edit"])? limpiarCadena($_POST["codusuario_edit"]):"";
			$codusuario_id_edit = isset($_POST["codusuario_id_edit"])? limpiarCadena($_POST["codusuario_id_edit"]):"";
			$nombre_edit = isset($_POST["nombre_edit"])? limpiarCadena($_POST["nombre_edit"]):"";
			$tipo_documento_edit = isset($_POST["tipo_documento_edit"])? limpiarCadena($_POST["tipo_documento_edit"]):"";

			$numero_documento_edit = isset($_POST["numero_documento_edit"])? limpiarCadena($_POST["numero_documento_edit"]):"";
			$direccion_edit = isset($_POST["direccion_edit"])? limpiarCadena($_POST["direccion_edit"]):"";
			$telefono_edit = isset($_POST["telefono_edit"])? limpiarCadena($_POST["telefono_edit"]):"";
			$correo_edit = isset($_POST["correo_edit"])? limpiarCadena($_POST["correo_edit"]):"";
			$id_puesto_edit = isset($_POST["id_puesto_edit"])? limpiarCadena($_POST["id_puesto_edit"]):"";
			$id_role_edit = isset($_POST["id_role_edit"])? limpiarCadena($_POST["id_role_edit"]):"";
			$nombre_usuario_edit = isset($_POST["nombre_usuario_edit"])? limpiarCadena($_POST["nombre_usuario_edit"]):"";
			$id_user_edit = $_SESSION["coduser"];

			$found_codusuario=$usuario->search_cod($codusuario_edit);

			if (($tipo_documento_edit == "Cedula Fisica") || ($tipo_documento_edit == "Cedula Juridica") || ($tipo_documento_edit == "Pasaporte")) {

				if ($found_codusuario==0) {

					$response = $usuario->edit($codusuario_edit,$nombre_edit,$tipo_documento_edit,$numero_documento_edit,$direccion_edit,
					 		$telefono_edit,$correo_edit,$id_puesto_edit,$id_role_edit,$nombre_usuario_edit,$id_user_edit,$codusuario_id_edit);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
					break;
				} else {
					if ($codusuario_edit==$codusuario_id_edit) {
						$response = $usuario->edit($codusuario_edit,$nombre_edit,$tipo_documento_edit,$numero_documento_edit,$direccion_edit,
					 		$telefono_edit,$correo_edit,$id_puesto_edit,$id_role_edit,$nombre_usuario_edit,$id_user_edit,$codusuario_id_edit);
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
											<i class='icon fa fa-times-circle'></i>Error! Codigo Usuario ya existe
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
			$response = $usuario->disable($codusuario);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Usuario desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $usuario->enable($codusuario);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Usuario activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $usuario->mostrar($codusuario);
			echo json_encode($response);
	 		break;

		case 'detalle':
			$response = $usuario->detalle($codusuario);
			echo json_encode($response);
	 		break;

		case 'showAll':
			$response = $usuario->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodUsuario,
					'1'=>$item->NombreUsuario,
					'2'=>$item->Correo,
					'3'=>$item->TipoDocumento,
					'4'=>$item->NumeroDocumento,
					'5'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'6'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodUsuario.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" 
							onclick="disable('.$item->CodUsuario.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodUsuario.')"><i class="fa fa-eye"></i></button>
							</div>' : 
							'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodUsuario.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Activar" 
							onclick="enable('.$item->CodUsuario.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodUsuario.')"><i class="fa fa-eye"></i>
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

		case 'listarPuestos': //caso para listar las caategorias del select

			require_once "../models/Puesto.php";

			$puesto = new Puesto();
			$response = $puesto->listarPuestos();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodPuesto . '>' . $item->NombrePuesto . '</option>';				
			}
			
			break;

		case 'listarRoles': //caso para listar las caategorias del select

			require_once "../models/Role.php";

			$role = new Role();
			$response = $role->listarRoles();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodRole . '>' . $item->Nombre . '</option>';				
			}
			
			break;
		//Caso no usado
		case 'topCod': //caso para obtener el TopCod del ultimo usuario registrado, asi 
						//saber cual es el siguiente codigo de usuario
			$response = $usuario->topCod();
			
			echo json_encode($response);
	 		break;
			// while ($item = $response->fetch_object()) {
			// 	echo '<option value=' .$item->CodUsuario . '>' . $item->CodUsuario . '</option>';				
			// }			
			//break;
	 	/*
	 	//Caso que verifica el login NO USADO
		case 'verificar':

		    $logina = isset($_POST["logina"])? limpiarCadena($_POST["logina"]):"";
		    $clavea = isset($_POST["clavea"])? limpiarCadena($_POST["clavea"]):"";

		    if ($logina=="" || $clavea=="") {
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Los campos deben ser llenados
								</div>";
		    } else {
		    	$clavehash=hash("SHA256",$clavea);
		    	$response = $usuario->verificar($logina,$clavehash);


		    	$fetch=$response->fetch_object();

		    	if ($fetch) {
			        echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Correcto
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";

			        header("Location: ../views/dashboard.php");
		    	}else{
		    		header("Location: ../index.php");
		    	}
		    }
		break;
		*/

		case 'salir':
			//Limpiamos las variables de sesión   
	        session_unset();
	        //Destruìmos la sesión
	        session_destroy();
	        //Redireccionamos al login
	        header("Location: ../index.php");

		default:			
			break;
	}
?>