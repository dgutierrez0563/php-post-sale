var tabla;

function init(){
	mostrarForm(false);
	//mostrarFormEdit(false);
	//mostrarForm_detalle(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	// $.post("../ajax/ventasdetalles.php?action=listarClientes", function(r) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
	// 	$("#codproveedor").html(r);
	// 	$('#codproveedor').selectpicker('refresh'); //Esto es para obligar a refrescar el IDCategoria para que salga al inicio la lista de categorias
	// });
	// $("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
	// 	edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	// });
}

//Limpiar text fields
function limpiar(){
	//$("#codproveedor").val("");
	//$('#codproveedor').selectpicker('refresh');
	$("#tipo_comprobante").val("");
	$('#tipo_comprobante').selectpicker('refresh');
	$("#nombreproveedor").val("");
	$("#tipo_comprobante").val("");
	$("#seriecomprobante").val("");
	$("#numerocomprobante").val("");
	$("#fechahora").val("");
	$("#impuesto").val("0");


	$("#totalventa").val("");
	$(".filas").remove();
	$("#total").html("₡. 0.00");

	/**
	 *  Funciones para obtener la fecha actual en el datePicker
	 *  Asi por default se ve la fecha actual
	 */
	var now = new Date(); //Se crea instancia para fecha del sistema
	var day = ("0" + now.getDate()).slice(-2); //Se obtiene la fecha del dia del sistema
	var month = ("0" + (now.getMonth() + 1)).slice(-2); //se obtiene el mes en el sistema
	var today = now.getFullYear() +"-"+(month)+"-"+(day); //Se concatenan los tres datos, year, month, day
	$("#fechahora").val(today);
	

	//count = 0;
	evaluarBotones();
	$("#btn_save").hide();
	//$("#id_user").val("");
	// $("#codproveedor_id_edit").val("");
	// $("#codproveedor_edit").val("");
	// $("#nombre_edit").val("");
	// $("#tipo_documento_edit").val("");
	// $("#numero_documento_edit").val("");
	// $("#direccion_edit").val("");
	// $("#telefono_edit").val("");
	// $("#correo_edit").val("");
	// $("#id_user_edit").val("");
}


//mostrar componentes
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		//$("#div_btnguardar").show();
		$("#btn_save").hide();
		$("#btn_cancelar").show();
		$("#btn_add_atributos").show();
		detalleingresos=0;

		/**
		 * Objetos para mostrar detalles de la vista en ver ingreso
		 */
		$("#proveedor_aux").hide();
		$("#fechahora_aux").hide();
		$("#tipo_comprobante_aux").hide();
		$("#seriecomprobante_aux").hide();
		$("#numerocomprobante_aux").hide();
		$("#impuesto_aux").hide();
		//Se ejecutan estas ordenes si se llama al mostrarForm de agregar nuevo
		//$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
		listarArticulos(); //llamo la funcion de listar los articulos para cuando llamo al form se ejecute esta funcion
		//y asi me cargue de una vez la lista antes de mostrar el modal de seleccionar los articulos para los detalles
	}else{
		/**
		 * Objetos para mostrar detalles de la vista en ver ingreso
		 */
		$("#proveedor_aux").hide();
		$("#fechahora_aux").hide();
		$("#tipo_comprobante_aux").hide();
		$("#seriecomprobante_aux").hide();
		$("#numerocomprobante_aux").hide();
		$("#impuesto_aux").hide();
		//se ejecuta estos si no se llama al mostrarForm de nuevo
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#btn_agregar").show();
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm(false); //oculta el formulario de registro
	//mostrarFormEdit(false);
}

function showAll(){ //funcion para mostrar el listado de datos
	tabla = $('#tb_listado').dataTable({
		"aProcessing": true, //se activa el prossesing data de datatables
		"aServerSide": true, //paginacion y filtrado realizado por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		
		"ajax": {
			url: '../ajax/ventasdetalles.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 6, //pagination 
		"aaSorting": [[ 0, "DESC"]] //order item by... 
	}).DataTable();
}

function listarArticulos(){ //funcion para mostrar el listado de datos
	tabla = $('#tb_listadoarticulosmodal').dataTable({
		"aProcessing": true, //se activa el prossesing data de datatables
		"aServerSide": true, //paginacion y filtrado realizado por el servidor
		//"bFilter": true,
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [	],
		
		"ajax": {
			url: '../ajax/ventasdetalles.php?action=listarArticulos',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 8, //pagination 
		"order": [[ 0, "desc" ]] //order item by... 
	}).DataTable();
}

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	//$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/ventasdetalles.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			//tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
			showAll();
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}
/**
 * [mostrar description]
 * @param  {[type]} codingreso [description]
 * @return {[type]}            [description]
 * Funcion para mostrar los datos del ingreso seleccionado en la vista principal
 */
function mostrar(codingreso){
	$.post("../ajax/ventasdetalles.php?action=mostrar",{codingreso : codingreso}, function(data,status){

		data = JSON.parse(data);
		mostrarForm(true); //se visualiza el formulario de regitro para ver os datos

		$("#codproveedor").show();
		$("#codproveedor").val(data.CodProveedor);
		$('#codproveedor').selectpicker('refresh');
		$("#fechahora").val(data.Fecha);
		$("#tipo_comprobante").val(data.TipoComprobante);
		$('#tipo_comprobante').selectpicker('refresh');
		$("#seriecomprobante").val(data.SerieComprobante);
		$("#numerocomprobante").val(data.NumeroComprobante);
		$("#impuesto").val(data.Impuesto);
		$("#codingreso").val(data.CodIngreso);

		//Ocultar algunos botones
		//$("#div_btnguardar").show();
		$("#btn_save").hide();
		$("#btn_cancelar").show();
		$("#btn_add_atributos").hide();

		//$("#codproveedor_id").val(data.CodIngreso);
	});
	//Se envia a la configuracion ajax la varia id al caso listarDetalleIngreso y retorna en el objeto table tdetalleingresos
	$.post("../ajax/ventasdetalles.php?action=listarDetalleIngresos&id="+codingreso, function(e){
		$("#tdetalleingresos").html(e);
	});
}

/*
* Esta funcion envia al ajax la desactivacion (ANULACION) del ingreso con todos sus detalles
*/
// function disable(codingreso){
// 	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea anular el ingreso?</div>", function(result){
// 		if (result) {
// 			$.post("../ajax/ingresomaterias.php?action=disable",{codingreso : codingreso}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			})
// 		}
// 	})
// }
function disable(codingreso){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea anular el ingreso y sus detalles?</div>", function(result){
		if (result) {
			$.post("../ajax/ventasdetalles.php?action=disable",{codingreso : codingreso}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}
/*
* Declarar variables para calculos
*/
var impuesto = 13;
var count = 0;
var detalleingresos = 0;

//$("#div_btnguardar").hide(); //btn ocultado si tengo lista vacia
$("#btn_save").hide(); //btn ocultado si tengo lista vacia
$("#tipo_comprobante").change(marcarImpuesto); //funcion que me cambia el impuesto dependiendo mi seleccion

//Funcion que me cambia en la caja de text del impuesto
//el valor del impuesto dependiendo mi seleccion de tipo_comprobante
function marcarImpuesto(){
	var tipo_comprobante = $("#tipo_comprobante option:selected").text();
	if (tipo_comprobante=='Factura') {
		$("#impuesto").val(impuesto);
	} else {
		$("#impuesto").val("0");
	}
}
//Funcion que ingresa a la lista los articulos seleccionados en el modal
function agregardetallesingreso(codarticulo,articulo,precio){
	var cantidad = 1;
	var preciocomp = 1;
	var preciovent =1;

	if (codarticulo!="") {
		var subtotal = cantidad*preciovent;
		var fila = '<tr class="filas" id="fila'+count+'">'+
			'<td><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="Eliminar" onclick="eliminarDetalle('+count+')"><i class="fa fa-trash"></i></button></td>'+
			'<td><input type="hidden" name="codarticulo[]" value="'+codarticulo+'">'+articulo+'</td>'+
			'<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
			'<td><input type="hidden" name="preciovent[]" value="'+precio+'">'+precio+'</td>'+
			'<td><span name="subtotal" id="subtotal'+count+'">'+subtotal+'</span></td>'+
			'<td><button type="button" class="btn btn-info" onclick="modificarSubTotales()"><i class="fa fa-refresh"></i></button></td>'+
		'</tr>';

		count++;
		detalleingresos=detalleingresos+1;

		$("#tdetalleingresos").append(fila);
		modificarSubTotales();
		//evaluarBotones();

	} else {
		alert("Error al ingresar el detalle");
		//evaluarBotones();
	}
}

function modificarSubTotales(){
	var cantidadArray = document.getElementsByName("cantidad[]");
	//var preciocompraArray =document.getElementsByName("preciocomp[]");
	var precioventaArray = document.getElementsByName("preciovent[]");
	var subtot = document.getElementsByName("subtotal");

	for (var i = 0; i < cantidadArray.length; i++) {
		var varCantidad = cantidadArray[i];
		var varPrecioVenta = precioventaArray[i];
		var varSubtotal = subtot[i];

		varSubtotal.value=(varCantidad.value * varPrecioVenta.value);
		//se obtiene el valor del subtotal por medio del elemento javascript
		document.getElementsByName("subtotal")[i].innerHTML = varSubtotal.value;
	}
	//calcula todos los totales en base a la lista agregada
	calcularTotales();
}
//Funcion que calcula los subtotales y totales cuando se va llenando las filas
function calcularTotales(){
	var subtotal2 = document.getElementsByName("subtotal"); //declaro el valor
	var total2 = 0.0; //declaro var para uso de calculo
	//calculo los totales mediante for sumandole a cada que vez pasa
	for (var i = 0; i < subtotal2.length; i++) {
		total2 += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("₡. "+total2);//cargo el la tabla de detalles el total
	$("#totalcompra").val(total2); //cargo el total de las lineas ingresdas hasta el momento

	evaluarBotones();
}
//Evalua si hay algo en la lista, muestro los botones en las filas, sino los oculto
function evaluarBotones(){
	if (detalleingresos > 0) {
		$("#btn_save").show();
	} else {		
		$("#btn_save").hide();
		count = 0;
	}
}
//Funcion que elimina el numero de la fila ingresada en los detalles de ingreso
function eliminarDetalle(indice){
	$("#fila" + indice).remove();
	calcularTotales();
	detalleingresos = detalleingresos - 1;
	evaluarBotones();
}

init();