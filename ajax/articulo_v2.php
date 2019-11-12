<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/Articulo_v2.php";

	$articulo = new Articulo_v2();

	$cod_id_articulo = isset($_POST["cod_id_articulo"])? limpiarCadena($_POST["cod_id_articulo"]):"";
	$codarticulo = isset($_POST["codarticulo"])? limpiarCadena($_POST["codarticulo"]):"";
	$codigo = isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
	$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
	$id_categoria = isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
	$precio = isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
	$detalle = isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
	$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
	$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save_edit': //caso para guardar o modificar un articulo
			/*
				Se realiza la validacion del archivo si ha sido seleccionado o si existe (en el if se consulta si no ha sido selected)
			*/
		
/*			$found_coddepartamento = $articulo->search_cod($codarticulo);

			if (found_coddepartamento==0) {*/

				if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) { 

					//$imagen = ""; //Si o se selecciono nada, la variable imagen se setea en blanco por ser una ruta
					$imagen = $_POST["imagen_actual"];
				}else{
					
					//Se guarda el tipo de extension del archivo, en este caso una imagen
					$ext = explode(".", $_FILES['imagen']['name']);
					/*
						Se realiza una validacion sobre que tipo de archivo a subir que tipo de imagen seria
					*/
					if (($_FILES['imagen']['type'] == "image/jpg") || ($_FILES['imagen']['type'] == "image/jpeg") || ($_FILES['imagen']['type'] == "image/png")) {
						
						$imagen = round(microtime(true)) . '.' . end($ext); //se renombra la imagen para no tener repetidas
						move_uploaded_file($_FILES['imagen']['tmp_name'], "../files/articulos/" . $imagen); //se mueve el archivo a la ruta descrita aqui, lo que se carga la imagen a la ruta
					}
				}
				if (empty($cod_id_articulo)) {
					
					$found_codarticulo = $articulo->search_cod($codarticulo);

					if ($found_codarticulo==0) {

						$response = $articulo->create($codarticulo,$nombre,$id_categoria,$precio,$codigo,$detalle,$imagen,$id_user);

						echo $response ? "<div class='alert alert-info alert-dismissable'>
											<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
										</div>" : 
										"<div class='alert alert-warning alert-dismissable'>
											<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
										</div>";
						break;
					}
					else{
						echo $response = 
										"<div class='alert alert-warning alert-dismissable'>
											<i class='icon fa fa-times-circle'></i>Error! Codigo Articulo ya existe
										</div>";
						break;
					}

					// $response = $articulo->create($codarticulo,$nombre,$id_categoria,$precio,$codigo,$detalle,$imagen,$id_user);

					// echo $response ? "<div class='alert alert-info alert-dismissable'>
					// 					<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
					// 				</div>" : 
					// 				"<div class='alert alert-warning alert-dismissable'>
					// 					<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
					// 				</div>";
				}else{

					$found_codarticulo = $articulo->search_cod($codarticulo);

					if ($found_codarticulo==0) {

						$response = $articulo->edit($codarticulo,$nombre,$id_categoria,$precio,$codigo,$detalle,$imagen,$id_user,$cod_id_articulo);

						echo $response ? "<div class='alert alert-info alert-dismissable'>
											<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
										</div>" : 
										"<div class='alert alert-warning alert-dismissable'>
											<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
										</div>";
						break;
					}
					else{

						if ($codarticulo==$cod_id_articulo) {

							$response = $articulo->edit($codarticulo,$nombre,$id_categoria,$precio,$codigo,$detalle,$imagen,$id_user,$cod_id_articulo);

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
												<i class='icon fa fa-times-circle'></i>Error! Codigo Articulo ya existe
											</div>";
							break;
						}
					}
				}
				//break;

			// } else {
			// 	# code...
			// }

		case 'disable': //caso para deshabilitar un articulo
			$response = $articulo->disable($cod_id_articulo);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Articulo desactivado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'enable': //caso para habilitar un articulo
			$response = $articulo->enable($cod_id_articulo);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Articulo activado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		case 'mostrar':
			$response = $articulo->mostrar($cod_id_articulo);
			echo json_encode($response);
	 		break;
		case 'detalle':
			$response = $articulo->detalle($cod_id_articulo);
			echo json_encode($response);
	 		break;
		case 'showAll': //caso para listar el index de todos los datos
			$response = $articulo->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodArticulo,
					'1'=>$item->NombreArticulo,
					'2'=>$item->NombreCategoria,
					'3'=>$item->Precio,
					//'4'=>$item->Detalle,
					'4'=>($item->Imagen) ? "<img src='../files/articulos/" . $item->Imagen ."' height='40px' width='40px'>" :
						"<img src='../files/articulos/default.jpg"."' height='40px' width='40px'>", //"<img src='../files/articulos/" . $item->Imagen ."' height='40px' width='40px'>",
					'5'=>($item->Estado) ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Enabled</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Disabled</span>
											</div>',
					'6'=>($item->Estado) ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodArticulo.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Desactivar" 
							onclick="disable('.$item->CodArticulo.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodArticulo.')"><i class="fa fa-eye"></i>
							</button>
						</div>' : 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Editar" 
							onclick="mostrar('.$item->CodArticulo.')"><i class="fa fa-pencil"></i></button>' . 
							' <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="Acivar" 
							onclick="enable('.$item->CodArticulo.')"><i class="fa fa-power-off"></i>
							</button>' .
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="detalle('.$item->CodArticulo.')"><i class="fa fa-eye"></i>
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

		case 'listarCategorias': //caso para listar las caategorias del select

			require_once "../models/Categoria.php";

			$categoria = new Categoria();
			$response = $categoria->listarCategorias();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodCategoria . '>' . $item->NombreCategoria . '</option>';				
			}
			
			break;

		default:			
			break;
	}
?>