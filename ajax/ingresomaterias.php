
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

					$codproveedor = isset($_POST["codproveedor"])? limpiarCadena($_POST["codproveedor"]):"";
					$tipo_comprobante = $tipo_aux; //recibe el selectpicker
					$seriecomprobante = isset($_POST["seriecomprobante"])? limpiarCadena($_POST["seriecomprobante"]):"";
					//El numero comprobante se recibe antes de los casos para comprobar que no haya repetidos
					$fechahora = isset($_POST["fechahora"])? limpiarCadena($_POST["fechahora"]):"";
					$impuesto = isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
					$totalcompra = isset($_POST["totalcompra"])? limpiarCadena($_POST["totalcompra"]):"";
					$id_user = $_SESSION["coduser"];

					/*$response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
						$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user,var_dump($_POST['codarticulo']),
						var_dump($_POST['cantidad']),var_dump($_POST['preciocomp']),var_dump($_POST['preciovent']));*/

					//Este test para insertar solo en la tabla detalles
					// $response = $ingresomaterias->create($_POST["codarticulo"],
					// 	$_POST["cantidad"],$_POST["preciocomp"],$_POST["preciovent"],$id_user);
					
					//Este test para insertar solo en la tabla ingresomaterias
					// $response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
					// 			$numerocomprobante,$fechahora,$impuesto,$totalcompra,$id_user);					
					
					//Test para ingresar ingreos y detalles
					$response = $ingresomaterias->create($codproveedor,$tipo_comprobante,$seriecomprobante,
								$numerocomprobante,$fechahora,$impuesto,$totalcompra,$_POST["codarticulo"],$_POST["cantidad"],$_POST["preciocomp"],$_POST["preciovent"],$id_user);

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
			
			$response = $ingresomaterias->disable($codingreso);
			echo $response ? "<div class='alert alert-info alert-dismissable'>
								<i class='icon fa fa-check-circle'></i>Success! Ingreso anulado
							</div>" : 
							"<div class='alert alert-warning alert-dismissable'>
								<i class='icon fa fa-times-circle'></i>Error! No se completo el cambio
							</div>";
			break;
		//caso para mostrar los detalles del ingresomateria encabezado
		case 'mostrar':
			$response = $ingresomaterias->mostrar($codingreso);
			echo json_encode($response);
	 		break;
	 	//caso para mostrar los detalles de detalleingresos pertenecientes al codingreso
		case 'listarDetalleIngresos':
			//se recibe el CodIngreso
			$codingreso = $_GET['id'];
			//se envia al modelo la consulta con parametro
			$response = $ingresomaterias->listarDetalleIngresos($codingreso);
			//variable para calcular el total
			$tota_auxiliar = 0;

			/**
			 * A partir de aqui, se incluira el head de la tabla y tambien el footer de la tabla
			 * para que se vea bonito y no tener que utilizar todo el de la vista html principal.
			 * Luego del head, se cargan los datos desde el WHILE
			 */
			echo '
				 <thead style="background-color: #bce8f1;">
				    <th>Accion</th>
				    <th>Articulo</th>
				    <th>Cantidad</th>
				    <th>Precio Compra</th>
				    <th>Precio Venta</th>
				    <th>Subtotal</th>
				</thead>';

			//se llena una cantidad exacta a la tabla de ingresar detalles para solo mostrar la info sin poder modificar
			//ya que solo se requiere ver los detalles ingresados por ingreso
			while ($item = $response->fetch_object()) {
				echo '<tr class="filas">
						<td></td>
						<td style="read-only: true;">'.$item->NombreArticulo.'</td>
						<td>'.$item->Cantidad.'</td>
						<td>'.number_format($item->PrecioCompra,2).'</td>
						<td>'.number_format($item->PrecioVenta,2).'</td>
						<td>'.number_format(($item->PrecioCompra*$item->Cantidad),2).'</td>
					</tr>';
					$tota_auxiliar = $tota_auxiliar+(($item->PrecioCompra)*($item->Cantidad));
			}
			/**
			 * Aqui se carga el footer de la tabla, luego de haber cargado
			 * el contenido del tbody
			 */
			echo '
	            <tfoot>
	                <th colspan="5">TOTAL</th>
	                <th style="border-bottom: double;">
	                  <strong><h4 id="total">₡. '.number_format($tota_auxiliar,2).'</h4></strong>
	                </th>
	            </tfoot>
			';

			//echo json_encode($response);
	 		break;

		// case 'listarDetalleIngresos':
		// 	$id_aux = $_GET['id'];

		// 	$response = $ingresomaterias->listarDetalleIngresos($id_aux);
		// 	//echo json_encode($response);
		// 	while ($item = $response->fetch_object()) {
		// 		echo '<tr>
		// 				<td></td>
		// 				<td>'.$item->NombreArticulo.'</td>
		// 				<td>'.$item->Cantidad.'</td>
		// 				<td>'.$item->PrecioCompra.'</td>
		// 				<td>'.$item->PrecioVenta.'</td>
		// 				<td>'.($item->PrecioCompra*$item->Cantidad).'</td>
		// 			</tr>';
		// 	}

		// 	break;

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
					'5'=>number_format($item->TotalCompra,2),
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
							'<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" 
								title="Detalles" onclick="mostrar('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
							</button>
							</div>'
							:
							''
							 /*. 
							' <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="mostrar('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
							</button>*/
						//</div>' :
						/*'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="mostrar('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
							</button>
						</div>' 
						*/
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
			break;
			
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

		default:			
			break;
	}
?>