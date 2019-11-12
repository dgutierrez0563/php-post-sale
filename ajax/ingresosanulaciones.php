
<?php
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/IngresoMaterias.php";

	$ingresomaterias = new IngresoMaterias();
	
	$codingreso = isset($_POST["codingreso"])? limpiarCadena($_POST["codingreso"]):"";

	switch ($_GET["action"]) {

		case 'mostrar':
			$response = $ingresomaterias->mostrar($codingreso);
			echo json_encode($response);
	 		break;

		case 'allDisable':
			$response = $ingresomaterias->allDisable();
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
					'8'=>($item->Estado=="Anulado") ? 
						'<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" 
								title="Detalles"><i class="fa fa-eye"></i>
							</button>
							</div>'
							/*<div style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Detalles" 
							onclick="details('.$item->CodIngreso.')"><i class="fa fa-eye"></i>
							</button>
							</div>*/
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

		default:			
			break;
	}
?>