var tabla;

function init(){
	mostrarForm_article(false);
	mostrarForm_detalle(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	});

	/*
		Se envia a cargar apenas se inicia el modal de registro, el listado de categorias para el select de forma manual
	*/
	$.post("../ajax/articulo_v2.php?action=listarCategorias", function(r) { //el parametro 'r' son las opcioes que nos esta devolviendo la funcion ajax de articulo.php
		$("#id_categoria").html(r);
		$('#id_categoria').selectpicker('refresh'); //Esto es para obligar a refrescar el IDCategoria para que salga al inicio la lista de categorias
	});

	$("#imagen_auxiliar").hide();
	$("#imagen_auxiliar_p").hide();
}

//Limpiar text fields
function limpiar(){
	/* Ingreso */
	$("#cod_id_articulo").val("");
	$("#codarticulo").val("");
	$("#codigo").val("");
	$("#nombre").val("");
	$("#id_categoria").val("");
	$('#id_categoria').selectpicker('refresh');
	$("#precio").val("");
	$("#detalle").val("");
	$("#imagen").val("");
	$("#imagen_actual").val("");
	$("#imagen_auxiliar").val("");
	$("#imagen_auxiliar").attr("src","");
	/* Detalles */
	$("#cod_id_articulo_p").val("");
	$("#codarticulo_p").val("");
	$("#codigo_p").val("");
	$("#nombre_p").val("");
	$("#categoria_p").val("");
	$("#precio_p").val("");
	$("#detalle_p").val("");
	$("#estado_p").val("");
	$("#updated_by_p").val("");
	$("#created_at_p").val("");
	$("#updated_at_p").val("");
	//$("#imagen_actual_p").val("");
	$("#imagen_auxiliar_p").val("");
	$("#imagen_auxiliar_p").attr("src","");
	$("#id_print").hide();
	$("#id_user").val("");
}

function mostrarForm_article(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#form_detalle").hide();
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
		$("#btn_agregar").hide();
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
		$("#form_detalle").hide();
		$("#btn_agregar").show();
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm_article(false); //oculta el formulario de registro
}

function showAll(){ //funcion para mostrar el listado de datos
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
			url: '../ajax/articulo_v2.php?action=showAll',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 6, //pagination 
		"aaSorting": [[ 0, "ASC"]] //order item by... 
	}).DataTable();
}

function save_edit(e){ //funcion para guardary editar los datos
	e.preventDefault();  //no se activara la accion predeterminada del evento
	$("#btn_save").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
	var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

	$.ajax({
		url: "../ajax/articulo_v2.php?action=save_edit", //url donde voy a enviar los data
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

function mostrar(cod_id_articulo){
	$.post("../ajax/articulo_v2.php?action=mostrar",{cod_id_articulo : cod_id_articulo}, function(data,status){

		data = JSON.parse(data);
		mostrarForm_article(true); //se visualiza el formulario de regitro para ver os datos

		$("#id_categoria").val(data.CodCategoria);
		$('#id_categoria').selectpicker('refresh'); //Esto es para luego de seleeccionar el IDCategoria refresco para que salga seleccionada
		$("#codigo").val(data.CodBarra);
		$("#codarticulo").val(data.CodArticulo);
		$("#nombre").val(data.NombreArticulo);
		$("#precio").val(data.Precio);
		$("#detalle").val(data.Detalle);

		 aux_img = data.Imagen;

		if(aux_img==""){
			//$("#imagen_auxiliar").show(); //Imagen auxiliar
			$("#imagen_auxiliar").val("");//.attr("src","../files/articulos/default.jpg"); //Se muestra la iagen auxiliar en el formulario
			$("#imagen_actual").val("");//.val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
									//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
									//sin ser tocada o modificada en la DB
		}
		else{
			$("#imagen_auxiliar").show(); //Imagen auxiliar
			$("#imagen_auxiliar").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
			$("#imagen_actual").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
												//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
												//sin ser tocada o modificada en la DB
		}
		// $("#imagen_auxiliar").show(); //Imagen auxiliar
		// $("#imagen_auxiliar").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
		// $("#imagen_actual").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
		// 									//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
		// 									//sin ser tocada o modificada en la DB
		//$("#id_user").val(data.updated_by);
		$("#cod_id_articulo").val(data.CodArticulo);
		//getBarCode();
	}) 	
}

function mostrarForm_detalle(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		//$("#form_registros").hide(); //muetra el formulario de registro
		//$("#tb_listado_article").hide();  //si se pone este asi, no se muestra la tabla luego de regresar del detalle al listado
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

function detalle(cod_id_articulo){
	$.post("../ajax/articulo_v2.php?action=detalle",{cod_id_articulo : cod_id_articulo}, function(data,status){

		//$("#listado_registros").hide();
		data = JSON.parse(data);
		mostrarForm_detalle(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codigoarticulo_p").val(data.CodArticulo);
		$("#nombre_p").val(data.NombreArticulo);
		$("#precio_p").val(data.Precio);
		$("#categoria_p").val(data.NombreCategoria);
		//$('#categoria_p').selectpicker('refresh'); //Esto es para luego de seleeccionar el IDCategoria refresco para que salga seleccionada

		$("#codigo_p").val(data.CodBarra);
		$("#updated_by_p").val(data.NombreUsuario);
		$("#created_at_p").val(data.created_at);
		$("#updated_at_p").val(data.updated_at);
		
		aux = data.Estado;

		if (aux==1) {
			$("#estado_p").val("Activo");
		}else{
			$("#estado_p").val("Desactivo");
		}

		aux_img = data.Imagen;

		if(aux_img == ""){
			//$("#imagen_auxiliar").show(); //Imagen auxiliar
			$("#imagen_auxiliar_p").val("");//.attr("src","../files/articulos/default.jpg"); //Se muestra la iagen auxiliar en el formulario
			//$("#imagen_actual").val("");//.val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
									//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
									//sin ser tocada o modificada en la DB
		}
		else{
			$("#imagen_auxiliar_p").show(); //Imagen auxiliar
			$("#imagen_auxiliar_p").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
			//$("#imagen_actual").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
												//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
												//sin ser tocada o modificada en la DB
		}
		// aux_img = data.Imagen;
		// if (aux_img=="") {
		// 	$("#imagen_auxiliar_p").show(); //Imagen auxiliar
		// 	$("#imagen_auxiliar_p").attr("src","../files/articulos/default.jpg");
		// }else{
			// $("#imagen_auxiliar_p").show(); //Imagen auxiliar

			// $("#imagen_auxiliar_p").attr("src","../files/articulos/"+data.Imagen); //Se muestra la iagen auxiliar en el formulario
			// $("#imagen_actual_p").val(data.Imagen); //Llamamos a la ruta de la imagen actual, esto para tenerlo en el fichero y el ID, asi que
			// 									//cuando guardemos o modifiquemos y no cambiamos la imagen, se mantiene la ruta de la imagen
			// 									//sin ser tocada o modificada en la DB
		//}
		$("#detalle_p").val(data.Detalle);
		//$("#id_user").val(data.updated_by);
		$("#cod_id_articulo_p").val(data.CodArticulo);
		//getBarCodeDetalle();
	}) 	
}

function disable(cod_id_articulo){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea desactivar el articulo?</div>", function(result){
		if (result) {
			$.post("../ajax/articulo_v2.php?action=disable",{cod_id_articulo : cod_id_articulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

function enable(cod_id_articulo){
	bootbox.confirm("<div class='alert alert-warning alert-dismissable'>¿Desea activar el articulo?</div>", function(result){
		if (result) {
			$.post("../ajax/articulo_v2.php?action=enable",{cod_id_articulo : cod_id_articulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			})
		}
	})
}

//Funciona para generar el codigo de barras para los productos
// function getBarCode(){
	
// 	codigo = $("#codigo").val();
// 	JsBarcode("#bar_code", codigo);
// 	$("#id_print").show();
// }

// function getBarCodeDetalle(){
	
// 	codigo = $("#codigo_p").val();
// 	JsBarcode("#bar_code_p", codigo);
// 	$("#id_print_p").show();
// }
//Funcion para imprimir con la libreria js printArea
// function printCode(){
// 	$("#id_print").printArea();
// }

init();

/*
	Solucion para validar el input de stock al recibir un valor
*/
// const campoNumerico = document.getElementById('stock');

// campoNumerico.addEventListener('keydown', function(evento) {
//   const teclaPresionada = evento.key;
//   const teclaPresionadaEsUnNumero =
//     Number.isInteger(parseInt(teclaPresionada));

//   const sePresionoUnaTeclaNoAdmitida = 
//     teclaPresionada != 'ArrowDown' &&
//     teclaPresionada != 'ArrowUp' &&
//     teclaPresionada != 'ArrowLeft' &&
//     teclaPresionada != 'ArrowRight' &&
//     teclaPresionada != 'Backspace' &&
//     teclaPresionada != 'Delete' &&
//     teclaPresionada != 'Enter' &&
//     !teclaPresionadaEsUnNumero;
//   const comienzaPorCero = 
//     campoNumerico.value.length === 0 &&
//     teclaPresionada == 0;

//   if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
//     evento.preventDefault(); 
//   }

// });

