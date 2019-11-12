
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/SubSubMenu.php";  //inclusion del modelo

	$subsubmenu = new SubSubMenu(); //instancia del modelo
	$idsubsubmenu = isset($_POST["idsubsubmenu"])? limpiarCadena($_POST["idsubsubmenu"]):"";

	switch ($_GET["action"]) { //casos de sentencias

		case 'save': //caso guardar
			
			$codsubmenu = isset($_POST['codsubmenu']) ? limpiarCadena($_POST['codsubmenu']):"";//recibe el parametro select del formulario

			$response = $subsubmenu->create($codsubmenu,$_POST["codarticulo"],$_POST["detalle1"],$_POST["detalle2"]); //objetos  array desde el archivo js

			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo todos los registros
							</div>";
			break;
		case 'edit': //caso guardar informacion editada de los niveles 2 del subsubmenu, es decir BOTONES que seran visualzados en la vista facturas

				$codarticulo_edit = isset($_POST["codarticulo_edit"])? limpiarCadena($_POST["codarticulo_edit"]):"";
				$codsubmenu_edit = isset($_POST["codsubmenu_edit"])? limpiarCadena($_POST["codsubmenu_edit"]):"";
				$detalle1_edit = isset($_POST["detalle1_edit"])? limpiarCadena($_POST["detalle1_edit"]):"";
				$detalle2_edit = isset($_POST["detalle2_edit"])? limpiarCadena($_POST["detalle2_edit"]):"";
				$idsubsubmenu_edit_id = isset($_POST["idsubsubmenu_edit_id"])? limpiarCadena($_POST["idsubsubmenu_edit_id"]):"";

				$response = $subsubmenu->edit($codsubmenu_edit,$codarticulo_edit,$detalle1_edit,$detalle2_edit,$idsubsubmenu_edit_id);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
		case 'delete': //caso de eliinar los botones, AUN NO SE USA
			$response = $subsubmenu->delete($idsubsubmenu);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Boton del Nivel 2 Sub-SubMenu eliminado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo la accion
							</div>";
			break;
		case 'mostrar'://caso para mostrar los datos en el formulario de edision
			$response = $subsubmenu->mostrar($idsubsubmenu);
			echo json_encode($response);
	 		break;
		case 'showAll': //listado de los niveles 2 del subsubmenu osea BOTONES en dataTable
			$response = $subsubmenu->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$no,
					'1'=>$item->NombreSubMenu,
					'2'=>$item->NombreArticulo,
					'3'=>$item->Detalle1,
					'4'=>$item->Detalle2,
					'5'=>($no>0) ? 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDSubSubMenu.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-danger btn-xs" onclick="delete('.$item->IDSubSubMenu.')"><i class="fa fa-trash"></i></button>
						</div>' :
						''
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

		case 'listarSubMenu': //caso para listar los  SubMenu nivel 1 del selectpicker en el nivel 2

			require_once "../models/SubMenu.php";
			$submenu = new SubMenu();
			$response = $submenu->listarSubMenu();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->IDSubMenu . '>' .$item->NumSubMenu." | ". $item->NombreSubMenu . '</option>';				
			}			
			break;

		case 'listarArticulosAux': //caso para listar los articulos del selectpciker en el nivel 2 formulario editar datos

			require_once "../models/Articulo_v2.php";
			$articulo = new Articulo_v2();
			$response = $articulo->listarArticulosAux();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodArticulo . '>' . $item->NombreArticulo . '</option>';				
			}			
			break;

		case 'listaArticulosModalSubMenu': //caso para listar los articulos en el modal a escoger los botones a ingresar nuevos
			require_once "../models/Articulo_v2.php";

			$articulo = new Articulo_v2();
			$response = $articulo->listaArticulosSubSubMenu();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->CodArticulo,
					'1'=>$item->NombreArticulo,
					'2'=>$item->Precio,
					'3'=>'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" 
							title="Agregar" onclick="agregardetallesingreso('.$item->CodArticulo.',\''.$item->NombreArticulo.'\')"><i class="fa fa-plus"></i>
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