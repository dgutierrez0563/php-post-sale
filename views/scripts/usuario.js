
var tabla;

function init(){
	mostrarForm(false);
	mostrarFormEdit(false);
	mostrarForm_detalle(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	$("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	$.post("../ajax/usuario.php?action=listarPuestos", function(r) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_puesto").html(r);
		$("#id_puesto").selectpicker('refresh');
	});
	$.post("../ajax/usuario.php?action=listarRoles", function(r2) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_role").html(r2);
		$("#id_role").selectpicker('refresh');
	});
	$.post("../ajax/usuario.php?action=listarPuestos", function(r3) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_puesto_edit").html(r3);
		$("#id_puesto_edit").selectpicker('refresh');
	});
	$.post("../ajax/usuario.php?action=listarRoles", function(r4) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_role_edit").html(r4);
		$("#id_role_edit").selectpicker('refresh');
	});
	// $.post("../ajax/usuario.php?action=topCod", function(r5) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
	// 	$("#codusuario").html(r5);
	// 	//$("#id_role_edit").selectpicker('refresh');
	// });
}

//Limpiar text fields
function limpiar(){
	$("#codusuario").val("");
	$("#codusuario_id").val("");
	$("#nombre").val("");
	$("#tipo_documento").val("");
	$("#numero_documento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#id_puesto").val("");
	$("#id_role").val("");
	$("#nombre_usuario").val("");
	$("#contrasenia").val("");

	$("#codusuario_edit").val("");
	$("#codusuario_id_edit").val("");
	$("#nombre_edit").val("");
	$("#tipo_documento_edit").val("");
	$("#numero_documento_edit").val("");
	$("#direccion_edit").val("");
	$("#telefono_edit").val("");
	$("#correo_edit").val("");
	$("#id_puesto_edit").val("");
	$("#id_role_edit").val("");
	$("#nombre_usuario_edit").val("");
	//$("#contrasenia").val("");
}
//mostrar componentes
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_registros_edit").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_registros_edit").hide();
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}

//mostrar componentes
function mostrarFormEdit(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").hide(); //muetra el formulario de registro
		$("#form_registros_edit").show();
		$("#btn_edit").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
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
			url: '../ajax/usuario.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 6, //pagination 
		"ORDER": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/usuario.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

function edit(i){ //funcion para guardary editar los datos
	i.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_edit").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_edit")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/usuario.php?action=edit", //url donde voy a enviar los data
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

function mostrar(codusuario){
	$.post("../ajax/usuario.php?action=mostrar",{codusuario : codusuario}, function(data,status){

		data = JSON.parse(data);
		mostrarFormEdit(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codusuario_edit").val(data.CodUsuario);
		$("#nombre_edit").val(data.NombreCompleto);
		$("#tipo_documento_edit").val(data.TipoDocumento);
		$("#numero_documento_edit").val(data.NumeroDocumento);
		$("#direccion_edit").val(data.Direccion);
		$("#telefono_edit").val(data.Telefono);
		$("#correo_edit").val(data.Correo);
		$("#id_puesto_edit").val(data.CodPuesto);
		$('#id_puesto_edit').selectpicker('refresh');
		$("#id_role_edit").val(data.CodRole);
		$('#id_role_edit').selectpicker('refresh');
		$("#nombre_usuario_edit").val(data.NombreUsuario);
		//$("#id_user").val(data.updated_by);
		$("#codusuario_id_edit").val(data.CodUsuario);
	}) 	
}
/*
function topCod(){
	$.post("../ajax/usuario.php?action=topCod", function(data) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		//$("#codusuario").html(e);
		//$("#id_role_edit").selectpicker('refresh');
		data = JSON.parse(data);
		$("#codusuario").val(data.TopCod);
	});
}
*/

function disable(codusuario){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el usuario?</div>", function(result){
		if (result) {
			$.post("../ajax/usuario.php?action=disable",{codusuario : codusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(codusuario){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el usuario?</div>", function(result){
		if (result) {
			$.post("../ajax/usuario.php?action=enable",{codusuario : codusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function mostrarForm_detalle(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#tb_listado").show();
		$("#form_detalle").show();
		$("#btn_agregar").hide();
	}else{
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}

function detalle(codusuario){
	$.post("../ajax/usuario.php?action=detalle",{codusuario : codusuario}, function(data,status){

		$("#listado_registros").hide();
		data = JSON.parse(data);
		mostrarForm_detalle(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codusuario_p").val(data.CodUsuario);
		$("#nombre_p").val(data.NombreCompleto);
		$("#tipo_documento_p").val(data.TipoDocumento);
		$("#numero_documento_p").val(data.NumeroDocumento);
		$("#telefono_p").val(data.Telefono);
		$("#correo_p").val(data.Correo);
		$("#puesto_p").val(data.NombrePuesto);
		$("#role_p").val(data.NombreRole);
		$("#user_name").val(data.NombreUsuario);
		$("#direccion_p").val(data.Direccion);
		$("#updated_by_p").val(data.NombreUsuario);
		$("#created_at_p").val(data.created_at);
		$("#updated_at_p").val(data.updated_at);
		
		aux = data.Estado;

		if (aux==1) {
			$("#estado_p").val("Activo");
		}else{
			$("#estado_p").val("Desactivo");
		}

		$("#codusuario_id_p").val(data.CodUsuario);
	}) 	
}
init();