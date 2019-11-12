
var tabla;

function init(){
	mostrarForm(false);
	mostrarFormEdit(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	$("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	// permiso = new Permiso();
	// topCode = permiso.topCodPermiso();
	// $("#codpermiso").val(topCode);

}

//Limpiar text fields
function limpiar(){
	$("#codsubmenu").val("");
	$("#codsubmenu_id").val("");
	$("#nombre").val("");
	$("#codsubmenu_edit").val("");
	$("#codsubmenu_id_edit").val("");
	$("#nombre_edit").val("");
	//$("#id_user").val("");
}
//mostrar componentes
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_registros_edit").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
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
		$("#form_registros").hide(); //muetra el formulario de registro
		$("#form_registros_edit").show();
		$("#btn_edit").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		//$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
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
			url: '../ajax/submenu.php?action=showAll',
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

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/submenu.php?action=save_edit", //url donde voy a enviar los data
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
		url: "../ajax/submenu.php?action=edit", //url donde voy a enviar los data
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

function mostrar(codsubmenu){
	$.post("../ajax/submenu.php?action=mostrar",{codsubmenu : codsubmenu}, function(data,status){

		data = JSON.parse(data);
		mostrarFormEdit(true); //se visualiza el formulario de regitro para ver os datos

		$("#codsubmenu_edit").val(data.NumSubMenu);
		$("#nombre_edit").val(data.NombreSubMenu);
		//$("#id_user").val(data.updated_by);
		$("#codsubmenu_id_edit").val(data.NumSubMenu);
	}) 	
}

function disable(codsubmenu){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el Sub Menu?</div>", function(result){
		if (result) {
			$.post("../ajax/submenu.php?action=disable",{codsubmenu : codsubmenu}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(codsubmenu){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el Sub Menu?</div>", function(result){
		if (result) {
			$.post("../ajax/submenu.php?action=enable",{codsubmenu : codsubmenu}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

init();