
<?php  
	
	require_once "../models/Articulo.php";

	$articulo = new Articulo();

	$id_articulo = isset($_POST["id_articulo"])? limpiarCadena($_POST["id_articulo"]):"";
	$transaccion = isset($_POST["transaccion"])? limpiarCadena($_POST["transaccion"]):"";
	$qty = isset($_POST["qty"])? limpiarCadena($_POST["qty"]):"";
	$id_user = isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";

	switch ($_GET["action"]) {
		case 'save':
			if ($transaccion==1) { //validacion de entradas
				$aux = mysqli_fetch_assoc($articulo->obtenerStock($id_articulo));
				$anterior_stock = $aux['Stock'];
				//$num=$anterior_stock['Stock'];
				$nuevo_stock = ($anterior_stock + $qty );
				$response = $articulo->actualizarStock($id_articulo,$nuevo_stock,$id_user);
				//echo $response ? "Datos registrados correctamente" : "Error!\nNo se completo el registro";
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Stock actualizado satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";

			}elseif($transaccion==2){ //validacion de salidas

				$aux = mysqli_fetch_assoc($articulo->obtenerStock($id_articulo));
				$anterior_stock = $aux['Stock'];
				$nuevo_stock = ($anterior_stock - $qty );
				$response = $articulo->actualizarStock($id_articulo,$nuevo_stock,$id_user);
				//echo $response ? "<div class='clean-green' align='left'><i class='fa fa-check' style='text-align:left;'></i>  Datos actualizados correctamente</div>" : "<div class='clean-orange'>Error!\nNo se completo la actualizacion";
				echo $response ? "<div class='alert alert-info alert-dismissable'>
									<i class='icon fa fa-check-circle'></i>Success! Stock actualizado satisfactoriamente
								</div>" : 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se completo la actualizacion
								</div>";
			}else{
				echo $response="<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! No se realizo nada
								</div>";
			}
			
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
					'2'=>(($item->Stock) >= 25) ? '<div>'. $item->Stock  : '<span class="label bg-red">'. $item->Stock .'</span></div>',
					'3'=>($item->Estado) ? '<div class="center"><span class="label bg-green">Enabled</span>' : '<span class="label bg-orange">Disabled</span></div>',
					'4'=>($item->Estado) ? 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDArticulo.')"><i class="fa fa-pencil"></i></button>' : 
						'<button class="btn btn-primary btn-xs" onclick="mostrar('.$item->IDArticulo.')"><i class="fa fa-pencil"></i></button>'
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