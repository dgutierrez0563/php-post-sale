<?php  
	
	require_once "../models/Articulo.php";

	$articulo = new Articulo();

	$id_articulo = isset($_POST["id_articulo"])? limpiarCadena($_POST["id_articulo"]):"";
	$codigo = isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$id_categoria = isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
	$stock = isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
	$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
	$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit':
			/*
				Se realiza la validacion del archivo si ha sido seleccionado o si existe (en el if se consulta si no ha sido selected)
			*/
			if (!file_exists($_FILES['imagen']['temp_name']) || !is_uploaded_file($_FILES['imagen']['temp_name'])) { 

				$imagen = ""; //Si o se selecciono nada, la variable imagen se setea en blanco por ser una ruta

			}else{
				
				//Se guarda el tipo de extension del archivo, en este caso una imagen
				$ext = explode(".", $_FILES['imagen']['name']);
				/*
					Se realiza una validacion sobre que tipo de archivo a subir que tipo de imagen seria
				*/
				if (($_FILES['imagen']['type'] == "image/jpg") || ($_FILES['imagen']['type'] == "image/jpeg") || ($_FILES['imagen']['type'] == "image/png")) {
					
					$imagen = round(microtime(true)) . '.' . end($ext); //se renombra la imagen para no tener repetidas
					move_uploaded_file($_FILES['imagen']['temp_name'], "../files/articulos/" . $imagen); //se mueve el archivo a la ruta descrita aqui, lo que se carga la imagen a la ruta
				}
			}
				if (empty($id_articulo)) {
					$response = $articulo->create($codigo,$nombre,$id_categoria,$stock,$detalle,$imagen,$id_user);
					//echo $response ? "Datos registrados correctamente" : "Error!\nNo se completo el registro";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
									</div>";
				}else{
					$response = $articulo->edit($id_articulo,$codigo,$nombre,$id_categoria,$stock,$detalle,$imagen,$id_user);
					//echo $response ? "<div class='clean-green' align='left'><i class='fa fa-check' style='text-align:left;'></i>  Datos actualizados correctamente</div>" : "<div class='clean-orange'>Error!\nNo se completo la actualizacion";
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
									</div>";
				}
			/*}
			else{
				echo $response="Error!\nCampos requeridos en blanco";
			}*/
			break;
		case 'disable':
			$response = $articulo->disable($id_articulo);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Articulo desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable':
			$response = $articulo->enable($id_articulo);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Articulo activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $articulo->mostrar($id_articulo);
			echo json_encode($response);
	 		break;
		case 'showAll':
			$response = $articulo->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Codigo,
					'1'=>$item->Nombre,
					'2'=>$item->NombreCategoria,
					'3'=>$item->Stock,
					'4'=>$item->Detalle,
					'5'=>"<img src='../files/articulos/" . $item->Imagen ."' height='40px' width='40px'>",
					'6'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',//$item->Estado,
					'7'=>$item->updated_at,
					'8'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDArticulo.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-warning btn-xs" onclick="disable('.$item->IDArticulo.')"><i class="fa fa-power-off"></i>
						</button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDArticulo.')"><i class="fa fa-pencil"></i></button>' . ' <button class="btn btn-success btn-xs" onclick="enable('.$item->IDArticulo.')"><i class="fa fa-power-off"></i>
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