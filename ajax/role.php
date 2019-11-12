
<?php 
	//validacion de sesion
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Role.php"; //inclusion del modelo de datos

	$role = new Role(); //instanciacion
	/*
	* obtencion de id con datos del fomrulario
	*/
	$id_role = isset($_POST["id_role"])? limpiarCadena($_POST["id_role"]):"";
	$codrole = isset($_POST["codrole"])? limpiarCadena($_POST["codrole"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$id_acceso = isset($_POST['id_acceso']);
	$id_user = $_SESSION["coduser"];
	/*
		sentencias CASE o casos de sentencias
	*/
	switch ($_GET["action"]) {

		case 'save_edit'://caso guardar informacion y editar
			
			if (empty($id_role)) {//si id_role esta nulo entra

				$found_codrole=$role->search_cod($codrole); //busqueda del codigo entrante

				if ($found_codrole==0) { //si codgio no esta se guarda

					$response = $role->create($codrole,$nombre,$id_user);
					
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
					break;
				} else {//si codigo ya esta se alerta existente
					echo $response = 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! Codigo Role ya existe
									</div>";
					break;
				}

			} else {//si id_role existe entra a editar

				$found_codrole=$role->search_cod($codrole); //busqueda del codigo y comparar existencia

				if ($found_codrole==0) { //si codgio no esta se entra a editar con nuevo codigo no existente

					$response = $role->edit($codrole,$nombre,$id_user,$id_role);

					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
					break;

				} else {//si codigo buscado existe se entra a editar con el mismo codigo
					if ($codrole==$id_role) {//si codigo es igual al id_role se edita

						$response = $role->edit($codrole,$nombre,$id_user,$id_role);

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
											<i class='icon fa fa-times-circle'></i>Error! Codigo role ya existe
										</div>";
						break;
					}
				}
			}
		case 'disable': //configuracion deshabilitar role
			$response = $role->disable($id_role);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Rol desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable': //configuracion habilitar role
			$response = $role->enable($id_role);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Rol activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar': //configuracion de mostrar datos en el fomrulario de edicion role
			$response = $role->mostrar($id_role);
			echo json_encode($response);
	 		break;

		case 'detalle': //configuracion de mostrar detalles en formulario de detalles role
			$response = $role->detalle($id_role);
			echo json_encode($response);
	 		break;

		case 'showAll': //configuracion listar datos en vista datatable role
			$response = $role->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodRole,
					'1'=>$item->Nombre,
					'2'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'3'=>$item->NombreUsuario,
					'4'=>$item->updated_at,
					'5'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="Editar"  onclick="mostrar('.$item->CodRole.')"><i class="fa fa-pencil"></i>
							 </button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="Bloquear" onclick="disable('.$item->CodRole.')">
									<i class="fa fa-power-off"></i>
							 </button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right" title="Detalles" onclick="detalle('.$item->CodRole.')">
									<i class="fa fa-eye"></i>
							 </button>
						 </div>' : 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="Editar" onclick="mostrar('.$item->CodRole.')"><i class="fa fa-pencil"></i>
							 </button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Activar" onclick="enable('.$item->CodRole.')"> 
									<i class="fa fa-power-off"></i>
							 </button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right" title="Detalles" onclick="detalle('.$item->CodRole.')">
									<i class="fa fa-eye"></i>
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

		case 'viewRoleAccesos': //configuracion listar en selectpicker los accesos o permisos en el formulario de asignar permisos al role
			$response = $role->viewRoleAccesos();
			$data2 = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data2[]=array(
					'0'=>$item->$no,
					'1'=>$item->CodPermiso,
					'2'=>$item->NombrePermiso,
					'3'=>$item->updated_at,
					'4'=>
						' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="Eliminar" onclick="deleteAcceso('.$item->CodRolePermiso.')">
								<i class="fa fa-power-off"></i>
						 </button>'
				);
				$no++;
			}

			$resultss = array(
				'sEcho'=>1, //information for dataTables
				'iTotalRecords'=>count($data2), //total items for dataTables
				'iTotalDisplayRecords'=>count($data2),//total items for view
				'aaData'=>$data2
			);
			echo json_encode($resultss);
			break;

		case 'listarRoles': //caso para listar los role del selectpicker del formulario asiganar permisos

			$response = $role->listarRoles();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodRole . '>' . $item->Nombre . '</option>';				
			}
			
			break;

		case 'deleteAcceso': //caso para eliminar los accesos de la vista de permisos asignados al role en dataTable

			$response = $role->deleteAcceso($id_acceso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Acceso Borrado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			//echo json_encode($response);
	 		break;

		default:			
			break;
	}
?>