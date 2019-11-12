<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Articulo
	*/
	class Articulo_v2
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codarticulo,$nombre,$codcategoria,$precio,$codbarra,$detalle,$imagen,$id_user){
			$sql = "INSERT INTO articulo (CodArticulo,NombreArticulo,CodCategoria,Precio,CodBarra,Detalle,Imagen,created_by,updated_by) VALUES('$codarticulo','$nombre','$codcategoria','$precio','$codbarra','$detalle','$imagen','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codarticulo,$nombre,$codcategoria,$precio,$codbarra,$detalle,$imagen,$id_user,$codarticulo_id_edit){
			$sql = "UPDATE articulo SET CodArticulo='$codarticulo',NombreArticulo='$nombre',CodCategoria='$codcategoria',
			Precio='$precio',CodBarra='$codbarra',Detalle='$detalle',Imagen='$imagen',updated_by='$id_user' 
			WHERE CodArticulo='$codarticulo_id_edit'";
			return ejecutarConsulta($sql);
		}

		public function disable($codarticulo){
			$sql = "UPDATE articulo SET Estado='0' WHERE CodArticulo='$codarticulo'";
			return ejecutarConsulta($sql);
		}

		public function enable($codarticulo){
			$sql = "UPDATE articulo SET Estado='1' WHERE CodArticulo='$codarticulo'";
			return ejecutarConsulta($sql);
		}
		//Funciono para mostrar en el formulario de EDIT del articulo seleccionado
		public function mostrar($codarticulo){
			//$sql = "SELECT * FROM articulo WHERE CodArticulo='$codarticulo'";

			$sql = "SELECT a.CodArticulo,a.NombreArticulo,a.Precio,a.Detalle,
			a.CodBarra,a.Imagen,c.CodCategoria,c.NombreCategoria FROM articulo a 
			INNER JOIN categoria c
			ON a.CodCategoria = c.CodCategoria
			WHERE a.CodArticulo='$codarticulo'";
			return ejecutarConsultaPorFila($sql);
		}
		//muestra los detalles del articulo selecciondo
		public function detalle($codarticulo){
			$sql = "SELECT a.CodArticulo,a.CodCategoria,a.CodBarra,a.Precio,
			a.NombreArticulo,a.Detalle,
			a.Imagen,a.Estado,a.updated_by,a.created_at,a.updated_at,
			c.CodCategoria,c.NombreCategoria,
			u.CodUsuario,u.NombreUsuario FROM articulo a INNER JOIN categoria c 
			ON a.CodCategoria=c.CodCategoria INNER JOIN usuario u 
			ON a.updated_by=u.CodUsuario
			WHERE CodArticulo='$codarticulo'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT a.CodArticulo,a.CodBarra,a.CodCategoria,a.NombreArticulo,a.Precio,
			a.Detalle,a.Imagen,a.Estado,a.updated_at,c.CodCategoria,c.NombreCategoria 
			FROM articulo a INNER JOIN categoria c ON a.CodCategoria=c.CodCategoria";
			return ejecutarConsulta($sql);
		}

		public function actualizarStock($id_articulo,$qty,$id_user){
			//$aux_qty = obtenerStock($id_articulo);

			$sql = "UPDATE articulo SET Stock='$qty',updated_by='$id_user' WHERE CodArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}
		//obtiene el stock del articulo seleccionado
		public function obtenerStock($id_articulo){
			$sql = "SELECT Stock FROM articulo WHERE CodArticulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}
		//Busca el codigo del producto para ver si ya esta registrado
		public function search_cod($codarticulo){
			$sql = "SELECT CodArticulo FROM articulo WHERE CodArticulo='$codarticulo'";
			return ejecutarConsultaPorFila($sql);
		}
		//Listar la lista de articulos ACTIVOS para el formulario MODAL de los ingresos y detalles
		public function listarArticulos(){
			$sql = "SELECT a.CodArticulo,a.CodBarra,a.CodCategoria,a.NombreArticulo,a.Precio,
			a.Detalle,a.Imagen,a.Estado,a.updated_at,c.CodCategoria,c.NombreCategoria 
			FROM articulo a INNER JOIN categoria c ON a.CodCategoria=c.CodCategoria
			WHERE a.Estado='1'";
			return ejecutarConsulta($sql);
		}

		//Listar la lista de articulos ACTIVOS para el formulario MODAL de los ingresos al Nivel 2 Sub-Sub-Menu
		public function listaArticulosSubSubMenu(){
			$sql = "SELECT CodArticulo,NombreArticulo,Precio
			FROM articulo
			WHERE Estado='1'";
			return ejecutarConsulta($sql);
		}

		public function listarArticulosAux(){
			$sql = "SELECT CodArticulo,NombreArticulo
				FROM articulo
				WHERE Estado='1'";
			return ejecutarConsulta($sql);
		}

		//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
		public function listarActivosVenta() {
			$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,
				(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo 
				order by iddetalle_ingreso desc limit 0,1) as precio_venta,
				a.descripcion,a.imagen,a.condicion FROM articulo a 
				INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
			return ejecutarConsulta($sql);		
		}

	}
?>