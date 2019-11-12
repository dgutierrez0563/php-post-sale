/*
	Variables para ambas tablas del dataTable, Modal y vista principal
*/
var tabla;
var tabla2;
//Funcion init de toda la vista
function init(){
	mostrarForm(false);
	mostrarFormEdit(false);
	showAll(); // listar todos los items
	/*
	*
	* Configuraciones necesarias a cargar al incio del arichivo vistar, ajax, para que los datos esten
	* listos a ser usados en los formularios edicion y guardar nuevo.
	* 
	*/
	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		//save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
		save(e);
	});

	$("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	$.post("../ajax/subsubmenu.php?action=listarArticulosAux", function(r) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#codarticulo").html(r);
		$("#codarticulo").selectpicker('refresh');
	});
	$.post("../ajax/subsubmenu.php?action=listarArticulosAux", function(s) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#codarticulo_edit").html(s);
		$("#codarticulo_edit").selectpicker('refresh');
	});
	$.post("../ajax/subsubmenu.php?action=listarSubMenu", function(t) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#codsubmenu").html(t);
		$("#codsubmenu").selectpicker('refresh');
	});
	$.post("../ajax/subsubmenu.php?action=listarSubMenu", function(u) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#codsubmenu_edit").html(u);
		$("#codsubmenu_edit").selectpicker('refresh');
	});
}

//Limpiar text fields
function limpiar(){
	$("#idsubsubmenu").val("");
	$("#codsubmenu").val("");
	$('#codsubmenu').selectpicker('refresh');
	$("#codarticulo_edit").val("");
	$('#codarticulo_edit').selectpicker('refresh');
	$("#detalle1").val("");
	$("#detalle2").val("");

	$("#codsubmenu_edit").val("");
	$('#codsubmenu_edit').selectpicker('refresh');
	$("#codarticulo_edit").val("");
	$('#codarticulo_edit').selectpicker('refresh');
	$("#detalle1_edit").val("");
	$("#detalle2_edit").val("");
	$("#idsubsubmenu_edit_id").val("");
	//$("#id_user").val("");
	$(".filas").remove();
}
//mostrar componentes del form crear
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_registrosaux").show(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_registros_edit").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
		listaArticulosModalSubMenu();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_registrosaux").hide(); //oculta la tabla del listado de datos
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_registros_edit").hide();
		$("#btn_agregar").show();
	}
}

//mostrar componentes del form editar
function mostrarFormEdit(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_registrosaux").hide(); //oculta la tabla del listado de datos
		$("#form_registros").hide(); //muetra el formulario de registro
		$("#form_registros_edit").show();
		$("#btn_edit").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		//$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_registrosaux").hide(); //oculta la tabla del listado de datos
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		//$("#form_detalle").hide();
		$("#form_registros_edit").hide();
		$("#btn_agregar").show();
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm(false); //oculta el formulario de registro
	mostrarFormEdit(false);
}
/*
* funcion listar todos los datos en la vista dataTable principal
*/
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
			url: '../ajax/subsubmenu.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 6, //pagination 
		"aaSorting": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}
/*
* funcion listar todos los articulos en la vista dataTable del modal en el form crear
*/
function listaArticulosModalSubMenu(){ //funcion para mostrar el listado de datos
	tabla2 = $('#tb_listadoarticulosmodal').dataTable({
		"aProcessing": true, //se activa el prossesing data de datatables
		"aServerSide": true, //paginacion y filtrado realizado por el servidor
		//"bFilter": true,
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [	],
		
		"ajax": {
			url: '../ajax/subsubmenu.php?action=listaArticulosModalSubMenu',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 8, //pagination 
		"order": [[ 1, "ASC" ]] //order item by... 
	}).DataTable();
}

/*
* funcion guardar todos los datos del formulario nuevo o crear
*/
function save(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/subsubmenu.php?action=save", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload();
			tabla2.ajax.reload();
			 //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
			showAll();
		}
	});
	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

/*
* funcion editar todos los datos en el formulario editar uno a uno
*/
function edit(i){ //funcion para guardary editar los datos
	i.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_edit").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_edit")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/subsubmenu.php?action=edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarFormEdit(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});
	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}
/*
* funcion mostrar los datos seleccionados en la vista del formulario editar
*/
function mostrar(idsubsubmenu){
	$.post("../ajax/subsubmenu.php?action=mostrar",{idsubsubmenu : idsubsubmenu}, function(data,status){

		data = JSON.parse(data);
		mostrarFormEdit(true); //se visualiza el formulario de regitro para ver os datos

		$("#codsubmenu_edit").val(data.IDSubMenu);
		$('#codsubmenu_edit').selectpicker('refresh');
		$("#codarticulo_edit").val(data.CodArticulo);
		$('#codarticulo_edit').selectpicker('refresh');
		$("#nombre_edit").val(data.NombreSubMenu);
		$("#detalle1_edit").val(data.Detalle1);
		$("#detalle2_edit").val(data.Detalle2);
		//$("#id_user").val(data.updated_by);
		$("#idsubsubmenu_edit_id").val(data.IDSubSubMenu);
	}) 	
}

/*
* Funcion para borrar filas en la tabla de registros dataTable
*/
// function delete(idsubsubmenu){
// 	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea eliminar el boton del Nivel 2 Sub-SubMenu?</div>", function(result){
// 		if (result) {
// 			$.post("../ajax/subsubmenu.php?action=delete",{idsubsubmenu : idsubsubmenu}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			})
// 		}
// 	})
// }


/*
*
* Desde aqui se realizan los cambios para el modal
* y envio de datos ajax mediante arrays
* 
*/
//Declaraciond e variables para conteo de filas.
var count = 0;
var detalleingresos = 0;
$("#btn_save").hide();

//Funcion que ingresa a la lista dataTable de crear datos de los articulos seleccionados en el modal
function agregardetallesingreso(codarticulo,articulo){
	//var cantidad = 1;
	var detalle1 = "";
	var detalle2 = "";

	if (codarticulo!="") {
		//var subtotal = cantidad*preciocomp;
		var fila = '<tr class="filas" id="fila'+count+'">'+
			'<td><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="Eliminar" onclick="eliminarDetalle('+count+')"><i class="fa fa-trash"></i></button></td>'+
			'<td><input type="hidden" name="codarticulo[]" value="'+codarticulo+'">'+articulo+'</td>'+
			'<td><input type="text" name="detalle1[]" id="detalle1[]" maxlength="12" placeholder="Detalle 1" value="'+detalle1+'"></td>'+
			'<td><input type="text" name="detalle2[]" id="detalle2[]" maxlength="12" placeholder="Detalle 2" value="'+detalle2+'"></td>'+
		'</tr>';

		count++;
		detalleingresos=detalleingresos+1;

		$("#tdetalleingresos").append(fila);
		//modificarSubTotales();
		evaluarBotones();

	} else {
		alert("Error al ingresar el detalle");
		evaluarBotones();
	}
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
	//calcularTotales();
	detalleingresos = detalleingresos - 1;
	evaluarBotones();
}

init();