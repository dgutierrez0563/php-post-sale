var tabla;

function init(){
	mostrarForm_article(false);
	mostrarForm_detalle(false);
	mostrarFormEdit(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	$("#form_edit").on("submit", function(i){ //se activa al momento de ejecutarse el eveno submit
		edit(i); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});
	/*
		Se envia a cargar apenas se inicia el modal de registro, el listado de categorias para el select de forma manual
	*/
	$.post("../ajax/articulo.php?action=listarCategorias", function(r) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_categoria").html(r);
		$('#id_categoria').selectpicker('refresh'); //Esto es para obligar a refrescar el IDCategoria para que salga al inicio la lista de categorias
	});
	$.post("../ajax/articulo.php?action=listarCategorias", function(s) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_categoria_edit").html(s);
		$('#id_categoria_edit').selectpicker('refresh'); //Esto es para obligar a refrescar el IDCategoria para que salga al inicio la lista de categorias
	});

	$("#imagen_auxiliar").hide();
	$("#imagen_auxiliar_p").hide();
	$("#imagen_auxiliar_edit").hide();
	//$("#imagen_auxiliar_p").hide();
}


//Limpiar text fields
function limpiar(){
	$("#codarticulo").val("");
	$("#codigobarra").val("");
	$("#nombre").val("");
	$("#id_categoria").val("");
	$("#precio").val("");
	$("#detalle").val("");
	$("#imagen_actual").val("");
	$("#imagen_auxiliar").attr("src","");
	$("#id_print").hide();
	$("#id_user").val("");
	$("#codarticulo_edit").val("");
	$("#codigobarra_edit").val("");
	$("#nombre_edit").val("");
	$("#id_categoria_edit").val("");
	$("#precio_edit").val("");
	$("#detalle_edit").val("");
	$("#imagen_actual_edit").val("");
	$("#imagen_auxiliar_edit").attr("src","");
	$("#id_print_edit").hide();
	$("#id_user_edit").val("");
}

function mostrarForm_article(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_detalle").hide();
		$("#form_registros_edit").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#form_registros_edit").hide();
		$("#btn_agregar").show();
	}
}

// //mostrar componentes
// function mostrarFormEdit(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
// 	limpiar();
// 	if(flag){
// 		$("#listado_registros").hide(); //oculta la tabla del listado de datos
// 		$("#form_registros").hide(); //muetra el formulario de registro
// 		$("#form_registros_edit").show();
// 		$("#btn_edit").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
// 		$("#form_detalle").hide();
// 		$("#btn_agregar").hide();
// 	}else{
// 		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
// 		$("#form_registros").hide(); //oculta el formulario de registro de categorias
// 		$("#form_registros_edit").hide();
// 		$("#form_detalle").hide();
// 		$("#btn_agregar").show();
// 	}
// }

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm_article(false); //oculta el formulario de registro
	//mostrarFormEdit(false);
}

function showAll(){ //funcion para mostrar el listado de datos
	//$("#form_detalle").hide();
	//$("#form_detalle").hide();
	tabla = $('#tb_listado_article').dataTable({
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
			url: '../ajax/articulo.php?action=showAll',
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
		url: "../ajax/articulo.php?action=save_edit", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm_article(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
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
		url: "../ajax/articulo.php?action=edit", //url donde voy a enviar los data
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

// function mostrar(codproducto){
// 	$.post("../ajax/articulo.php?action=mostrar",{codproducto : codproducto}, function(data,status){

// 		data = JSON.parse(data);
// 		mostrarFormEdit(true); //se visualiza el formulario de regitro para ver os datos
		
// 		$("#codproducto_edit").val(data.CodArticulo);
// 		$("#id_categoria_edit").val(data.CodCategoria);
// 		$('#id_categoria_edit').selectpicker('refresh'); //Esto es para luego de seleeccionar el IDCategoria refresco para que salga seleccionada
// 		$("#codigobarra_edit").val(data.Codigo);
// 		$("#nombre_edit").val(data.Nombre);
// 		$("#precio_edit").val(data.Precio);
// 		$("#detalle_edit").val(data.Detalle);
// 		$("#imagen_auxiliar_edit").show(); //Imagen auxiliar
// 		$("#imagen_auxiliar_edit").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
// 		$("#imagen_actual_edit").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
// 											//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
// 											//sin ser tocada o modificada en la DB
// 		$("#id_user_edit").val(data.updated_by);
// 		$("#codproducto_id_edit").val(data.CodArticulo);
// 		getBarCodeEdit();
// 	}) 	
// }

function mostrarForm_detalle(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		//$("#form_registros").hide(); //muetra el formulario de registro
		$("tb_listado_article").hide();
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

function detalle(codproducto){
	$.post("../ajax/articulo.php?action=detalle",{codproducto : codproducto}, function(data,status){

		$("#listado_registros").hide();
		data = JSON.parse(data);
		mostrarForm_detalle(true); //se visualiza el formulario de regitro para ver os datos

		$("#categoria_p").val(data.NombreCategoria);
		//$('#categoria_p').selectpicker('refresh'); //Esto es para luego de seleeccionar el IDCategoria refresco para que salga seleccionada
		$("#codigo_p").val(data.Codigo);
		$("#nombre_p").val(data.NombreProducto);
		$("#updated_by_p").val(data.NombreUsuario);
		$("#created_at_p").val(data.created_at);
		$("#updated_at_p").val(data.updated_at);
		
		aux = data.Estado;

		if (aux==1) {
			$("#estado_p").val("Activo");
		}else{
			$("#estado_p").val("Desactivo");
		}

		$("#detalle_p").val(data.DetalleP);
		$("#imagen_auxiliar_p").show(); //Imagen auxiliar
		$("#imagen_auxiliar_p").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
		$("#imagen_actual_p").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
											//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
											//sin ser tocada o modificada en la DB
		//$("#id_user").val(data.updated_by);
		$("#id_articulo_p").val(data.CodArticulo);
		getBarCodeDetalle();
	}) 	
}

function disable(id_articulo){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el articulo?</div>", function(result){
		if (result) {
			$.post("../ajax/articulo.php?action=disable",{id_articulo : id_articulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(id_articulo){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el articulo?</div>", function(result){
		if (result) {
			$.post("../ajax/articulo.php?action=enable",{id_articulo : id_articulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

/*
	Solucion para validar el input de stock al recibir un valor
*/
const campoNumerico = document.getElementById('stock');

campoNumerico.addEventListener('keydown', function(evento) {
  const teclaPresionada = evento.key;
  const teclaPresionadaEsUnNumero =
    Number.isInteger(parseInt(teclaPresionada));

  const sePresionoUnaTeclaNoAdmitida = 
    teclaPresionada != 'ArrowDown' &&
    teclaPresionada != 'ArrowUp' &&
    teclaPresionada != 'ArrowLeft' &&
    teclaPresionada != 'ArrowRight' &&
    teclaPresionada != 'Backspace' &&
    teclaPresionada != 'Delete' &&
    teclaPresionada != 'Enter' &&
    !teclaPresionadaEsUnNumero;
  const comienzaPorCero = 
    campoNumerico.value.length === 0 &&
    teclaPresionada == 0;

  if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
    evento.preventDefault(); 
  }

});

//Funciona para generar el codigo de barras para los productos
function getBarCode(){
	
	codigo = $("#codigo").val();
	JsBarcode("#bar_code", codigo);
	$("#id_print").show();
}

function getBarCodeDetalle(){
	
	codigo = $("#codigo_p").val();
	JsBarcode("#bar_code_p", codigo);
	$("#id_print_p").show();
}
//Funcion para imprimir con la libreria js printArea
function printCode(){
	$("#id_print").printArea();
}

//Funciona para generar el codigo de barras para los productos
function getBarCodeEdit(){
	
	codigo = $("#codigobarra_edit").val();
	JsBarcode("#bar_code_edit", codigo);
	$("#id_print_edit").show();
}

//Funcion para imprimir con la libreria js printArea
function printCodeEdit(){
	$("#id_print_edit").printArea();
}
init();