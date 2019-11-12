
<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/SubSubMenu.php";

	$subsubmenu = new SubSubMenu();
	$idsubsubmenu = isset($_POST["idsubsubmenu"])? limpiarCadena($_POST["idsubsubmenu"]):"";
	switch ($_GET["action"]) {
		case 'save_edit':

			//$found_codsubmenu=$submenu->search_cod($codsubmenu);

			//if ($found_codsubmenu==0) {
				$codarticulo = isset($_POST["codarticulo"])? limpiarCadena($_POST["codarticulo"]):"";
				$codsubmenu = isset($_POST["codsubmenu"])? limpiarCadena($_POST["codsubmenu"]):"";
				$detalle1 = isset($_POST["detalle1"])? limpiarCadena($_POST["detalle1"]):"";
				$detalle2 = isset($_POST["detalle2"])? limpiarCadena($_POST["detalle2"]):"";
				//$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $subsubmenu->create($codsubmenu,$codarticulo,$detalle1,$detalle2);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
				break;

		case 'save_editAux':

			//$found_codsubmenu=$submenu->search_cod($codsubmenu);

			//if ($found_codsubmenu==0) {
				$codarticulo = isset($_POST["codarticulo"])? limpiarCadena($_POST["codarticulo"]):"";
				$codsubmenu = isset($_POST["codsubmenu"])? limpiarCadena($_POST["codsubmenu"]):"";
				$detalle1 = isset($_POST["detalle1"])? limpiarCadena($_POST["detalle1"]):"";
				$detalle2 = isset($_POST["detalle2"])? limpiarCadena($_POST["detalle2"]):"";
				//$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

				$response = $subsubmenu->create($codsubmenu,$codarticulo,$detalle1,$detalle2);
				
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo el registro
								</div>";
				break;

			//} else {
				// echo $response = 
				// 				"<div class='alert alert-warning alert-dismissable'>
				// 					<i class='icon fa fa-times-circle'></i>Error! Codigo SubMenu ya existe
				// 				</div>";
				// break;
			//}
		case 'edit':

				$codarticulo_edit = isset($_POST["codarticulo_edit"])? limpiarCadena($_POST["codarticulo_edit"]):"";
				$codsubmenu_edit = isset($_POST["codsubmenu_edit"])? limpiarCadena($_POST["codsubmenu_edit"]):"";
				$detalle1_edit = isset($_POST["detalle1_edit"])? limpiarCadena($_POST["detalle1_edit"]):"";
				$detalle2_edit = isset($_POST["detalle2_edit"])? limpiarCadena($_POST["detalle2_edit"]):"";
				$idsubsubmenu_edit_id = isset($_POST["idsubsubmenu_edit_id"])? limpiarCadena($_POST["idsubsubmenu_edit_id"]):"";
			//$id_user_edit = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";	
			
			//$found_codsubmenu=$submenu->search_cod($codsubmenu_edit);

			//if ($found_codsubmenu==0) {

				$response = $subsubmenu->edit($codsubmenu_edit,$codarticulo_edit,$detalle1_edit,$detalle2_edit,$idsubsubmenu_edit_id);

				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
				break;
			//} else {
				//if ($codsubmenu_edit==$codsubmenu_id_edit) {
					// $response = $subsubmenu->edit($codsubmenu_edit,$nombre_edit,$codsubmenu_id_edit);

					// echo $response ? "<div class='alert alert-info alert-dismissable'>
					// 					<i class='icon fa fa-check-circle'></i>Success! Los datos han sido actualizados
					// 				</div>" : 
					// 				"<div class='alert alert-warning alert-dismissable'>
					// 					<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
					// 				</div>";
					// break;
				// } else {
				// 	echo $response = 
				// 					"<div class='alert alert-warning alert-dismissable'>
				// 						<i class='icon fa fa-times-circle'></i>Error! Codigo SubMenu ya existe
				// 					</div>";
				// 	break;
				// }
			//}
		case 'delete':
			$idsubsubmenu = isset($_POST["idsubsubmenu"])? limpiarCadena($_POST["idsubsubmenu"]):"";
			$response = $subsubmenu->delete($idsubsubmenu);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! SubSubMenu eliminado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		// case 'enable':
		// 	$response = $subsubmenu->enable($idsubsubmenu);
		// 	echo $response ? "<div class='alert alert-info alert-dismissable'>
		// 						<i class='icon fa fa-check-circle'></i>Success! SubMenu activado
		// 					</div>" : 
		// 					"<div class='alert alert-warning alert-dismissable'>
		// 						<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
		// 					</div>";
		// 	break;
		case 'mostrar':
			$response = $subsubmenu->mostrar($idsubsubmenu);
			echo json_encode($response);
	 		break;
		case 'showAll':
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
					//'5'=>$item->updated_at,
					'5'=>($no > 0) ? 
						'<div class="-form-group" style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDSubSubMenu.')"><i class="fa fa-pencil"></i></button>' 
							. ' <button class="btn btn-danger btn-xs" onclick="delete('.$item->IDSubSubMenu.')"><i class="fa fa-trash"></i>
							</button>
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


		case 'listarArticulosAux': //caso para listar las caategorias del select

			require_once "../models/Articulo_v2.php";

			$articulo = new Articulo_v2();
			$response = $articulo->listarArticulosAux();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodArticulo . '>' . $item->NombreArticulo . '</option>';				
			}			
			break;

		case 'listarSubMenu': //caso para listar las caategorias del select

			require_once "../models/SubMenu.php";

			$submenu = new SubMenu();
			$response = $submenu->listarSubMenu();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->IDSubMenu . '>' .$item->NumSubMenu." | ". $item->NombreSubMenu . '</option>';				
			}			
			break;
		default:
			break;
	}
?>