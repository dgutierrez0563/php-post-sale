<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for IngresoMaterias
	*/
	class IngresoMaterias
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}
		//Funcion fr crear datos de ingresos y detalles de compras e ingresos
		public function create($codproveedor,$tipo_comprobante,$seriecomprobante,$numerocomprobante,$fechahora,$impuesto,$totalcompra,$codarticulo,$cantidad,$preciocomp,$preciovent,$id_user) {
			//se guarda primero los datos de la factura
			$sql = "INSERT INTO ingresomaterias (CodProveedor,TipoComprobante,SerieComprobante,
			NumeroComprobante,FechaComprobante,Impuesto,TotalCompra,created_by,updated_by) 
			VALUES('$codproveedor','$tipo_comprobante','$seriecomprobante','$numerocomprobante','$fechahora',
			'$impuesto','$totalcompra','$id_user','$id_user')";/*,'$id_user','$id_user'*/

			$id_ingresomat_new = ejecutarConsultaRetornaID($sql); //se guarda y se consulta de una vez el id que se acaba de ingresar, este retorna en la variable id_ingresomat_new
			$item = 0;
			$var_response = true;
			//se recorreo para guardar los datos de los array recibidos en la tabla con el id del ingreso
			while ($item < count($codarticulo)) {
				$sql_detalle = "INSERT INTO detalleingreso (CodIngreso, CodArticulo,Cantidad,PrecioCompra,PrecioVenta,created_by,updated_by) 
				VALUES ('$id_ingresomat_new', '$codarticulo[$item]','$cantidad[$item]','$preciocomp[$item]','$preciovent[$item]','$id_user','$id_user')";
				
				ejecutarConsulta($sql_detalle) or $var_response = false; //se ejecutar la sentencia sql y valida si se hizo correctamente o no
				$item=$item + 1;
			}
			return $var_response;
		}
		//Funcion para la anulacion de las facturas de ingresos y detalles
		public function disable($codingreso/*,$id_user*/){
			$sql = "UPDATE ingresomaterias SET Estado='Anulado' WHERE CodIngreso='$codingreso'";
			return ejecutarConsulta($sql);
		}
		//Funcion no utilizada aun 
		public function mostrar($codingreso){
			$sql = "SELECT i.CodIngreso,DATE(i.FechaComprobante) AS Fecha,i.CodProveedor,p.Nombre AS 
			NombreProveedor,u.CodUsuario,u.NombreUsuario,i.TipoComprobante,i.SerieComprobante,
			i.NumeroComprobante,CAST(i.TotalCompra AS DECIMAL(8,2)) AS TotalCompra,i.Impuesto,i.Estado
			FROM ingresomaterias i INNER JOIN proveedor p ON i.CodProveedor=p.CodProveedor
			INNER JOIN usuario u ON i.updated_by=u.CodUsuario
			WHERE i.CodIngreso='$codingreso'";
			return ejecutarConsultaPorFila($sql);
		}
		//Funcion no utilizada aun
		public function listarDetalleIngresos($codingreso) {
			$sql = "SELECT di.CodIngreso,di.CodArticulo,a.NombreArticulo,di.Cantidad,
			CAST(di.PrecioCompra AS DECIMAL(8,2)) AS PrecioCompra,CAST(di.PrecioVenta AS DECIMAL(8,2)) AS PrecioVenta,di.Estado
			FROM detalleingreso di INNER JOIN articulo a ON di.CodArticulo=a.CodArticulo
			WHERE di.CodIngreso='$codingreso'";
			return ejecutarConsulta($sql);
		}
		//Funcion para mostrar en la vista HTML la lista de ingresos y detalles ACTIVOS sin anulacion
		public function showAll(){
			$sql = "SELECT i.CodIngreso,DATE(i.FechaComprobante) AS Fecha,i.CodProveedor,p.Nombre AS 
			NombreProveedor,u.CodUsuario,u.NombreUsuario,i.TipoComprobante,i.SerieComprobante,
			i.NumeroComprobante,CAST(i.TotalCompra AS DECIMAL(8,2)) AS TotalCompra,i.Impuesto,i.Estado
			FROM ingresomaterias i INNER JOIN proveedor p ON i.CodProveedor=p.CodProveedor
			INNER JOIN usuario u ON i.updated_by=u.CodUsuario
			WHERE i.Estado='Activo'";
			return ejecutarConsulta($sql);
		}
		//Funcion para mostrar en la vista HTML la lista de ingresos y detalles ANULADOS
		public function allDisable(){
			$sql = "SELECT i.CodIngreso,DATE(i.FechaComprobante) AS Fecha,i.CodProveedor,p.Nombre AS 
			NombreProveedor,u.CodUsuario,u.NombreUsuario,i.TipoComprobante,i.SerieComprobante,
			i.NumeroComprobante,i.TotalCompra,i.Impuesto,i.Estado
			FROM ingresomaterias i INNER JOIN proveedor p ON i.CodProveedor=p.CodProveedor
			INNER JOIN usuario u ON i.updated_by=u.CodUsuario
			WHERE i.Estado='Anulado'";
			return ejecutarConsulta($sql);
		}
		//Funcion para buscar el numero de comprobante o factura recibido por si ya existe
		public function search_cod($numcompro){
			$sql = "SELECT CodIngreso FROM ingresomaterias WHERE NumeroComprobante='$numcompro'";
			return ejecutarConsultaPorFila($sql);
		}
	}
?>