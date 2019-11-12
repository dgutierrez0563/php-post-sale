
var tabla;
var tabla_acceso;

function init(){
	mostrarForm(false);
	mostrarForm_detalle(false);
	showAll(); // listar todos los items

	/*
	* Funciones o acciones para cargar ciertos valores al iniciar la funcion init para que
	* esten listos al momento de la carga de la vista
	*/
	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	$("#form_create_update_accesos").on("submit", function(q){ //se activa al momento de ejecutarse el eveno submit
		createAcceso(q); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	$("#form_view_listado_role_acceso").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		listadoAcceso(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	$.post("../ajax/role.php?action=listarRoles", function(f) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_role_asignacion").html(f);
		$('#id_role_asignacion').selectpicker('refresh');
	});

	$.post("../ajax/permiso.php?action=listarPermisos", function(a) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_permiso").html(a);
		$("#id_permiso").selectpicker('refresh');
	});

	$.post("../ajax/role_permiso.php?action=listarRoles", function(b) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_role_seleccionado").html(b);
		$("#id_role_seleccionado").selectpicker('refresh');
	});

	$.post("../ajax/role_permiso.php?action=listarPermisos", function(c) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#permisos").html(c);
		$('#permisos').selectpicker('refresh');
	});
}

//Limpiar text fields en formularios 
function limpiar(){
	$("#id_role").val("");
	$("#codrole").val("");
	$("#nombre").val("");
	$("#id_user").val("");
	$("#id_role_asignacion").val("");
	$('#id_role_asignacion').selectpicker('refresh');
	$("#id_permiso").val("");
	$('#id_permiso').selectpicker('refresh');
	$("#id_role_seleccionado").val("");
	$('#id_role_seleccionado').selectpicker('refresh');
	$("#codrole_p").val("");
	$("#codrole_id_p").val("");
	$("#nombre_p").val("");
	$("#estado_p").val("");
	$("#updated_by_p").val("");
	$("#created_at_p").val("");
	$("#updated_at_p").val("");

	$("#id_role_asignacion").val("");
	$("#id_permiso").val("");

}
//mostrar componentes del formulario de registro
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_roles_permisos").hide();
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_asignacion_accesos").hide(); //muetra el formulario de registro
		$("#form_detalle").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado 
		$("#btn_agregar").hide();
		$("#btn_agregar_accesos").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_roles_permisos").hide();
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_asignacion_accesos").hide(); //muetra el formulario de registro
		$("#form_detalle").hide();
		$("#btn_agregar").show();
		$("#btn_agregar_accesos").show();
	}
}

//devuelve la vista de los roles, cancela el formulario de registro de role
function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm(false); //oculta el formulario de registro
	mostrarForm_detalle(false);
}

//funcion para mostrar los roles en la vista dataTable
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
			url: '../ajax/role.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 6, //pagination 
		"aaSorting": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}

//funcion para crear y editar el role ingresado o seleccionado del formulario
function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/role.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id form_create_update_accesos
}

//Funcion para mostrar el role seleccionado en el formulario de edicion
function mostrar(id_role){
	$.post("../ajax/role.php?action=mostrar",{id_role : id_role}, function(data,status){

		data = JSON.parse(data);
		mostrarForm(true); //se visualiza el formulario de regitro para ver os datos

		$("#codrole").val(data.CodRole);
		$("#nombre").val(data.Nombre);
		$("#id_role").val(data.CodRole);
	}) 	
}

//Funcion para deshabilitar el role seleccionado
function disable(id_role){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el rol?</div>", function(result){
		if (result) {
			$.post("../ajax/role.php?action=disable",{id_role : id_role}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

//funcion para habilitar el role seleccionado
function enable(id_role){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el rol?</div>", function(result){
		if (result) {
			$.post("../ajax/role.php?action=enable",{id_role : id_role}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}
//Funcion de llamado al formulario de vista detalles del role seleccionado
function mostrarForm_detalle(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		//$("#form_registros").hide(); //muetra el formulario de registro
		$("#tb_listado").show();
		$("#form_detalle").show();
		//$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
		$("#btn_agregar_accesos").hide();
	}else{
		//$("#listado_registros").hide(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}
//funcion donde setea los id de la informacion proveniente del ajax
function detalle(id_role){
	$.post("../ajax/role.php?action=detalle",{id_role : id_role}, function(data,status){

		$("#listado_registros").hide();
		data = JSON.parse(data);
		mostrarForm_detalle(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codrole_p").val(data.CodRole);
		$("#nombre_p").val(data.Nombre);
		$("#updated_by_p").val(data.NombreUsuario);
		$("#created_at_p").val(data.created_at);
		$("#updated_at_p").val(data.updated_at);
		
		aux = data.Estado;

		if (aux==1) {
			$("#estado_p").val("Activo");
		}else{
			$("#estado_p").val("Desactivo");
		}

		$("#codrole_id_p").val(data.CodRole);
	}) 	
}
/*
*
*
* Esta parte es la operacion de reglas para la asignacion de los accesos a los roles
*
* 
*/

//Limpiar text fields del formulario de asgnacion de accesos a role
// function limpiarAcceso(){
// 	$("#id_role_asignacion").val("");
// 	$("#id_permiso").val("");
// 	$("#id_user_2").val("");
// }

//mostrar el formulario para asignar accesos al role uno a uno
function mostrarFormAccesos(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_roles_permisos").hide();
		$("#form_asignacion_accesos").show(); //muetra el formulario de registro
		$("#btn_save_accesos").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado 
		$("#btn_agregar_accesos").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_roles_permisos").hide();
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#btn_agregar_accesos").show();
		$("#btn_agregar").show();
	}
}

//funcion para crear los accesos o mas bien asignar los accesos al role que se selecciona
function createAcceso(q){ //funcion para guardary editar los datos
	q.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save_accesos").prop("disabled",false); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update_accesos")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/role_permiso.php?action=createAcceso", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarFormAccesos(true); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

//funcion para eliminar el acceso seleccionado en la lista de los permisos asignados
function deleteAcceso(id_acceso){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea eliminar el acceso?</div>", function(result){
		if (result) {
			$.post("../ajax/role.php?action=deleteAcceso",{id_acceso : id_acceso}, function(e){
				bootbox.alert(e);
				tabla_acceso.ajax.reload();
			})
		}
	})
}

// function addAtributo(){
// 	aux = document.getElementById("id_permiso").value;
// 	$("#atributo").tagsinput({
// 		itemValue: aux,
// 		maxTags:5
// 	});
// 	//setAcceso(aux);
// }

init();