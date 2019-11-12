var tabla;

function init(){
	mostrarFormCategoriaRegistro(false);
	mostrarFormCategoriaEdit(false);
	mostrarForm_detalle(false);
	showAll(); // listar todos los items

	$("#form_create_categoria").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	$("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
}
//Limpiar text fields
function limpiar(){
	$("#codcategoria").val("");
	$("#codcategoria_id").val("");
	$("#nombre").val("");
	$("#detalle").val("");
	$("#id_user").val("");
	$("#codcategoria_id_edit").val("");
	$("#codcategoria_edit").val("");
	$("#nombre_edit").val("");
	$("#detalle_edit").val("");
	$("#id_user_edit").val("");
}
//mostrar componentes
function mostrarFormCategoriaRegistro(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros_categoria").hide(); //oculta la tabla del listado de datos
		$("#form_registros_categoria").show(); //muetra el formulario de registro
		$("#form_registros_edit").hide();
		$("#btn_save_categoria").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros_categoria").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros_categoria").hide(); //oculta el formulario de registro de categorias
		$("#form_registros_edit").hide();
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}

//mostrar componentes
function mostrarFormCategoriaEdit(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros_categoria").hide(); //oculta la tabla del listado de datos
		$("#form_registros_categoria").hide(); //muetra el formulario de registro
		$("#form_registros_edit").show();
		$("#btn_edit").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#form_detalle").hide();
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros_categoria").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros_categoria").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#form_registros_edit").hide();
		$("#btn_agregar").show();
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarFormCategoriaRegistro(false); //oculta el formulario de registro
	mostrarFormCategoriaEdit(false);
}

function showAll(){ //funcion para mostrar el listado de datos
	tabla = $('#tb_listado_categoria').dataTable({
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
			url: '../ajax/categoria.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 6, //pagination 
		"ORDER": [[ 1, "ASC"]] //order item by... 
	}).DataTable();
}

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save_categoria").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_categoria")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/categoria.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarFormCategoriaRegistro(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
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
		url: "../ajax/categoria.php?action=edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarFormCategoriaEdit(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

function mostrar(codcategoria){
	$.post("../ajax/categoria.php?action=mostrar",{codcategoria : codcategoria}, function(data,status){

		data = JSON.parse(data);
		mostrarFormCategoriaEdit(true); //se visualiza el formulario de regitro para ver os datos
		$("#codcategoria_edit").val(data.CodCategoria);
		$("#nombre_edit").val(data.NombreCategoria);
		$("#detalle_edit").val(data.Detalle);
		$("#id_user_edit").val(data.updated_by);
		$("#codcategoria_id_edit").val(data.CodCategoria);
	}) 	
}

function disable(codcategoria){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar la categoria?</div>", function(result){
		if (result) {
			$.post("../ajax/categoria.php?action=disable",{codcategoria : codcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(codcategoria){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar la categoria?</div>", function(result){
		if (result) {
			$.post("../ajax/categoria.php?action=enable",{codcategoria : codcategoria}, function(e){
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
		//$("#form_registros").hide(); //muetra el formulario de registro
		$("#tb_listado").show();
		$("#form_detalle").show();
		//$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		//$("#listado_registros").hide(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}

function detalle(codcategoria){
	$.post("../ajax/categoria.php?action=detalle",{codcategoria : codcategoria}, function(data,status){

		$("#listado_registros_categoria").hide();

		data = JSON.parse(data);
		mostrarForm_detalle(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codcategoria_p").val(data.CodCategoria);
		$("#nombre_p").val(data.NombreCategoria);
		$("#detalle_p").val(data.DetalleC);
		$("#updated_by_p").val(data.NombreUsuario);
		$("#created_at_p").val(data.created_at);
		$("#updated_at_p").val(data.updated_at);
		
		aux = data.Estado;

		if (aux==1) {
			$("#estado_p").val("Activo");
		}else{
			$("#estado_p").val("Desactivo");
		}

		$("#detalle_p").val(data.DetalleC);

		$("#codcategoria_id_p").val(data.CodCategoria);
	}) 	
}

init();