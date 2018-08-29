
var tabla;

function init(){
	mostrarForm(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	})
}

//Limpiar text fields
function limpiar(){
	$("#id_cliente").val("");
	$("#nombre").val("");
	$("#tipo_documento").val("");
	$("#numero_documento").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#direccion").val("");
	$("#id_user").val("");
}
//mostrar componentes
function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#btn_agregar").show();
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm(false); //oculta el formulario de registro
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
			url: '../ajax/cliente.php?action=showAll',
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

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/cliente.php?action=save_edit", //url donde voy a enviar los data
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

function mostrar(id_cliente){
	$.post("../ajax/cliente.php?action=mostrar",{id_cliente : id_cliente}, function(data,status){

		data = JSON.parse(data);
		mostrarForm(true); //se visualiza el formulario de regitro para ver os datos

		$("#nombre").val(data.Nombre);
		$("#tipo_documento").val(data.TipoDocumento);
		$("#tipo_documento").selectpicker('refresh');
		$("#numero_documento").val(data.NumeroDocumento);
		$("#telefono").val(data.Telefono);
		$("#correo").val(data.Correo);
		$("#direccion").val(data.Direccion);
		$("#id_user").val(data.updated_by);
		$("#id_cliente").val(data.IDProveedor);
	}) 	
}

function disable(id_cliente){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el cliente?</div>", function(result){
		if (result) {
			$.post("../ajax/cliente.php?action=disable",{id_cliente : id_cliente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(id_cliente){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el cliente?</div>", function(result){
		if (result) {
			$.post("../ajax/cliente.php?action=enable",{id_cliente : id_cliente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

init();