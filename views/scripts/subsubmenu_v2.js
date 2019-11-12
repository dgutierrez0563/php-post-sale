
var tabla;
var tabla2;

function init(){
	mostrarForm(false);
	mostrarFormEdit(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	// $("#form_create_update").on("submit", function(z){ //se activa al momento de ejecutarse el eveno submit
	// 	save_editAux(z); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	// });
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
	// permiso = new Permiso();
	// topCode = permiso.topCodPermiso();
	// $("#codpermiso").val(topCode);

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
}
//mostrar componentes
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_registrosaux").show(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_registros_edit").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_registrosaux").hide(); //oculta la tabla del listado de datos
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_registros_edit").hide();
		$("#btn_agregar").show();
	}
}

//mostrar componentes
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

function showAll(){ //funcion para mostrar el listado de datos
	tabla = $('#tb_listado').dataTable({
		"aProcessing": true, //se activa el prossesing data de datatables
		"aServerSide": true, //paginacion y filtrado realizado por el servidor
		//"bFilter": true,
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
		//"bFilter": true,
		"iDisplayLength": 6//, //pagination 
		//"ORDER": [[ 2, "ASC"]] //order item by... 
	}).DataTable();
}

// function showAllAux(){ //funcion para mostrar el listado de datos
// 	tabla2 = $('#tb_listadoaux').dataTable({
// 		"aProcessing": true, //se activa el prossesing data de datatables
// 		"aServerSide": true, //paginacion y filtrado realizado por el servidor
// 		//"bFilter": true,
// 		dom: 'Bfrtip', //Definimos los elementos del control de tabla
// 		buttons: [
// 			'copyHtml5',
// 			'excelHtml5',
// 			'csvHtml5',
// 			'pdf'
// 		],
		
// 		"ajax": {
// 			url: '../ajax/subsubmenu.php?action=showAll',
// 			type: "get",
// 			dataType: "json",
// 			error: function(e){
// 				console.log(e.responseText);
// 			}
// 		},
// 		"bDestroy": true,
// 		//"bFilter": true,
// 		"iDisplayLength": 6//, //pagination 
// 		//"ORDER": [[ 2, "ASC"]] //order item by... 
// 	}).DataTable();
// }

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/subsubmenu.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm(true); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload();
			tabla2.ajax.reload();
			 //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});
	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

// function save_editAux(u){ //funcion para guardary editar los datos
// 	u.preventDefault();  //no se activara la accion predeterminada del evento
// 	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
// 	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

// 	$.ajax({
// 		url: "../ajax/subsubmenu.php?action=save_editAux", //url donde voy a enviar los data
// 		type: "POST",
// 		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
// 		contentType: false,
// 		processData: false,

// 		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
// 			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
// 			mostrarForm(true); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
// 			tabla2.ajax.reload();
// 			tabla.ajax.reload();
// 			 //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
// 			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
// 			//toda la informacion de categorias.
// 		}
// 	});
// 	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
// }

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

// function delete(idsubsubmenu){
// 	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el Sub Menu?</div>", function(result){
// 		if (result) {
// 			$.post("../ajax/subsubmenu.php?action=delete",{idsubsubmenu : idsubsubmenu}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			})
// 		}
// 	})
// }
// function delete(idsubsubmenu){
// 	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea eliminar el SubSub Menu?</div>", function(result){
// 		if (result) {
// 			$.post("../ajax/subsubmenu.php?action=delete",{idsubsubmenu : idsubsubmenu}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			})
// 		}
// 	})
// }

// function enable(codsubmenu){
// 	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el Sub Menu?</div>", function(result){
// 		if (result) {
// 			$.post("../ajax/submenu.php?action=enable",{codsubmenu : codsubmenu}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			})
// 		}
// 	})
// }

init();