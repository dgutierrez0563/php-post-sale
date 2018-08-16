
<?php  
	
	require_once "../models/Puesto.php";

	$puesto = new Puesto();

	$id_puesto = isset($_POST["id_puesto"])? limpiarCadena($_POST["id_puesto"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$id_departamento = isset($_POST["id_departamento"])? limpiarCadena($_POST["id_departamento"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			
			if (empty($id_puesto)) {
				$response = $puesto->create($nombre,$id_departamento,$id_user);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
			}else{
				$response = $puesto->edit($id_puesto,$nombre,$id_departamento,$id_user);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
			}

			break;
		case 'disable':
			$response = $puesto->disable($id_puesto);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Puesto desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $puesto->enable($id_puesto);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Puesto activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $puesto->mostrar($id_puesto);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $puesto->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Nombre,
					'1'=>$item->NombreDepartamento,
					'2'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',
					'3'=>$item->updated_at,
					'4'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDPuesto.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDPuesto.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDPuesto.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDPuesto.')"><i class="fa fa-power-off"></i>
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

		case 'listarDepartamentos': //caso para listar las caategorias del select

			require_once "../models/Departamento.php";

			$departamento = new Departamento();
			$response = $departamento->listarDepartamentos();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->IDDepartamento . '>' . $item->Nombre . '</option>';				
			}
			
			break;

		default:			
			break;
	}
?>