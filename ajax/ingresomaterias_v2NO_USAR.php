
<?php
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/IngresoMaterias.php";

	$ingresomaterias = new IngresoMaterias();
	$codingreso = isset($_POST["codingreso"])? limpiarCadena($_POST["codingreso"]):"";
	$numerocomprobante = isset($_POST["numerocomprobante"])? limpiarCadena($_POST["numerocomprobante"]):"";
	$tipo_aux = isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";

	switch ($_GET["action"]) {

		case 'save_edit':

			$found_numerocompro=$ingresomaterias->search_cod($numerocomprobante);

			if ($found_numerocompro==0) {

				if (($tipo_aux == "Boleta") || ($tipo_aux == "Factura") || ($tipo_aux == "Ticket")) {

					$tipo_comprobante = $tipo_aux;
					$codproveedor = isset($_POST["codproveedor"])? limpiarCadena($_POST["codproveedor"]):"";
					$seriecomprobante = isset($_POST["seriecomprobante"])? limpiarCadena($_POST["seriecomprobante"]):"";
					$fechahora = isset($_POST["fechahora"])? limpiarCadena($_POST["fechahora"]):"";
					$impuesto = isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
					$totalcompra = isset($_POST["totalcompra"])? limpiarCadena($_POST["totalcompra"]):"";
					$id_user = $_SESSION["coduser"];//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";
					//$id_user[]

					// $response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
					// 	$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user,var_dump($_POST['codarticulo']),
					// 	var_dump($_POST['cantidad']),var_dump($_POST['preciocomp']),var_dump($_POST['preciovent']));
					$response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
						$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user,$_POST['codarticulo'],
						$_POST['cantidad'],$_POST['preciocomp'],$_POST['preciovent']);
					echo $response ? "<div class='alert alert-info alert-dismissable'>
										<i class='icon fa fa-check-circle'></i>Success! Datos registrados satisfactoriamente
									</div>" : 
									"<div class='alert alert-warning alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Error! No se completo todos los registros
									</div>";
					break;

				}else{
					echo $response = "<div class='alert alert-danger alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Warning! Tipo de Documento Incorrecto
									</div>";
					break;
				}
				
			} else {
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Numero de Comprobante ya existe
								</div>";
				break;
			}
			
		case 'disable':
			//$codingreso = isset($_POST["codingreso"])? limpiarCadena($_POST["codingreso"]):"";
			
			$response = $ingresomaterias->disable($codingreso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Ingreso anulado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;

		case 'mostrar':
			$response = $ingresomaterias->mostrar($codingreso);
			echo json_encode($response);
	 		break;

		case 'listarDetalleIngresos':
			$id_aux = $_GET['id'];

			$response = $ingresomaterias->listarDetalleIngresos($id_aux);
			//echo json_encode($response);
			while ($item = $response->fetch_object()) {
				echo '<tr>
						<td></td>
						<td>'.$item->NombreArticulo.'</td>
						<td>'.$item->Cantidad.'</td>
						<td>'.$item->PrecioCompra.'</td>
						<td>'.$item->PrecioVenta.'</td>
						<td>'.($item->PrecioCompra*$item->Cantidad).'</td>
					</tr>';
			}

			break;
		// case 'detalle':
		// 	$response = $ingresomaterias->detalle($codingreso);
		// 	echo json_encode($response);
	 // 		break;

		case 'showAll':
			$response = $ingresomaterias->showAll();
			$data = Array();
			$no=1;
			while ($item=$response->fetch_object()) {
				$data[]=array(
					'0'=>$item->Fecha,
					'1'=>$item->NombreProveedor,
					'2'=>$item->TipoComprobante,
					'3'=>$item->SerieComprobante,
					'4'=>$item->NumeroComprobante,
					'5'=>$item->TotalCompra,
					'6'=>($item->Estado=="Activo") ? '<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-green">Activo</span> 
											</div>' : 
											'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
												<span class="label bg-orange">Anulado</span>
											</div>',
					//'4'=>$item->updated_at,
					'7'=>$item->NombreUsuario,
					'8'=>($item->Estado=="Activo") ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="left" title="Anular" 
							onclick="disable('.$item->CodIngreso.')"><i class="fa fa-power-off"></i>
							</button>' . 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="mostrar('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
							</button>
						</div>' :
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="mostrar('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
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

		case 'listarProveedor': //caso para listar los proveedores del select

			require_once "../models/Proveedor.php";

			$proveedor = new Proveedor();
			$response = $proveedor->listarProveedor();

			while ($item = $response->fetch_object()) {
				echo '<option value=' .$item->CodProveedor . '>' . $item->Nombre . '</option>';				
			}
		case 'listarArticulos': //caso para listar los articulos en el modal
			require_once "../models/Articulo_v2.php";

			$articulo = new Articulo_v2();
			$response = $articulo->listarArticulos();
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
						"<img src='../files/articulos/default.jpg"."' height='40px' width='40px'>",
					'5'=>'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
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

		case 'agregarAuxliares':
			/*$found_numerocompro=$ingresomaterias->search_cod($numerocomprobante);

			if ($found_numerocompro==0) {*/

				if (($tipo_aux == "Boleta") || ($tipo_aux == "Factura") || ($tipo_aux == "Ticket")) {

					$tipo_comprobante = $tipo_aux;
					$codarticulo = isset($_POST["codarticulo"])? limpiarCadena($_POST["codarticulo"]):"";
					$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
					$preciocomp = isset($_POST["preciocomp"])? limpiarCadena($_POST["preciocomp"]):"";
					$preciovent = isset($_POST["preciovent"])? limpiarCadena($_POST["preciovent"]):"";
					//$totalcompra = isset($_POST["totalcompra"])? limpiarCadena($_POST["totalcompra"]):"";
					$id_user = session_id();//isset($_POST["id_user"])? limpiarCadena($_POST["id_user"]):"";
					//$id_user[]

					// $response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
					// 	$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user,var_dump($_POST['codarticulo']),
					// 	var_dump($_POST['cantidad']),var_dump($_POST['preciocomp']),var_dump($_POST['preciovent']));
					// $response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
					// 	$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user,$_POST['codarticulo'],
					// 	$_POST['cantidad'],$_POST['preciocomp'],$_POST['preciovent']);
					$response = $ingresomaterias->create_detalleaux($codarticulo,
						$cantidad,$preciocomp,$preciovent,$session_id);
					echo $response ? "":"";
					break;

				}/*else{
					echo $response = "<div class='alert alert-danger alert-dismissable'>
										<i class='icon fa fa-times-circle'></i>Warning! Tipo de Documento Incorrecto
									</div>";
					break;
				}
				
			} else {
				echo $response = 
								"<div class='alert alert-warning alert-dismissable'>
									<i class='icon fa fa-times-circle'></i>Error! Numero de Comprobante ya existe
								</div>";
				break;
			}*/

		default:			
			break;
	}
?>