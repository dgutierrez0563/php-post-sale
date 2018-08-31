
var tabla;
var tabla_acceso;

function init(){
	mostrarForm(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	$.post("../ajax/role.php?action=listarRoles", function(f) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_role_asignacion").html(f);
		$("#id_role_asignacion").selectpicker('refresh');
	});

	$.post("../ajax/permiso.php?action=listarPermisos", function(a) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_permiso").html(a);
		$("#id_permiso").selectpicker('refresh');
	})

}

//Limpiar text fields
function limpiar(){
	$("#id_role").val("");
	$("#nombre").val("");
	$("#id_user").val("");
}
//mostrar componentes del formulario de registro
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#listado_roles_permisos").hide();
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_asignacion_accesos").hide(); //muetra el formulario de registro
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado 
		$("#btn_agregar").hide();
		$("#btn_agregar_accesos").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#listado_roles_permisos").hide();
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_asignacion_accesos").hide(); //muetra el formulario de registro
		$("#btn_agregar").show();
		$("#btn_agregar_accesos").show();
	}
}

//devuelve la vista de los roles, cancela el formulario de registro de role
function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm(false); //oculta el formulario de registro
}

//funcion para mostrar los roles en la vista
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
		"iDisplayLength": 10, //pagination 
		"ORDER": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}

//funcion para crear y editar el role 
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
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

//Funcion para mostrar el role en el formulario de edicion
function mostrar(id_role){
	$.post("../ajax/role.php?action=mostrar",{id_role : id_role}, function(data,status){

		data = JSON.parse(data);
		mostrarForm(true); //se visualiza el formulario de regitro para ver os datos

		$("#nombre").val(data.Nombre);
		$("#id_user").val(data.updated_by);
		$("#id_role").val(data.IDRole);
	}) 	
}

//Funcion para deshabilitar el role
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

//funcion para habilitar el role
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

//Limpiar text fields del formulario de asgnacion de accesos a role
function limpiarAcceso(){
	$("#id_role").val("");
	$("#nombre").val("");
	$("#id_user").val("");
}

//mostrar form para asignar accesos al role
function mostrarFormAccesos(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiarAcceso();
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




//funcion para crear y editar el role 
function createAcceso(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save_accesos").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/role.php?action=createAcceso", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarFormAccesos(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla_acceso.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

//Funcion para mostrar los accesos que tienen los roles
function viewRoleAccesos(){ //funcion para mostrar el listado de datos
	tabla_acceso = $('#tb_listado_roles_permisos').dataTable({
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
			url: '../ajax/role.php?action=viewRoleAccesos',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 10, //pagination 
		"ORDER": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}


//funcion para habilitar el role
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


function addAtributo(){
	aux = document.getElementById("id_permiso").value;
	$("#atributo").tagsinput({
		itemValue: aux,
		maxTags:5
	});
	//setAcceso(aux);
}

/*function setAcceso(aux){
	$("#atributo").val(aux).tagsinput({
		confirmKeys: [1, 2],
		//allowDuplicates: false,
		maxTags: 3
	});
}

function addTag2(id){
 	$('.atributo').tagsinput({
    	allowDuplicates: false,
        itemValue: id,  // this will be used to set id of tag
        itemText: 'atributo' // this will be used to set text of tag
    });
}

function listaJson(){

	$.post("../ajax/role.php?action=listaJson", function(data){

		data = JSON.parse(data);
		//mostrarForm(true); //se visualiza el formulario de regitro para ver os datos

		var arrayTags = [
			{data: val.Nombre }
		];

	    $( "#atributo" ).autocomplete({
	      source: arrayTags
	    });
	}) 	

}*/



init();