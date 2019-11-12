var tabla;

function init(){
	//mostrarForm_detalle(false);
	allDisable(); // listar todos los items
}

//Limpiar text fields
function limpiar(){
	// $("#codproveedor").val("");
	// $('#codproveedor').selectpicker('refresh');
	// $("#tipo_comprobante").val("");
	// $('#tipo_comprobante').selectpicker('refresh');
	// $("#nombreproveedor").val("");
	// $("#tipo_comprobante").val("");
	// $("#seriecomprobante").val("");
	// $("#numerocomprobante").val("");
	// $("#fechahora").val("");
	// $("#impuesto").val("");


	// $("#totalcompra").val("");
	// $(".filas").remove();
	// $("#total").html("0.00");

}


//mostrar componentes
// function mostrarForm(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
// 	limpiar();
// 	if(flag){
// 		$("#listado_registros").hide(); //oculta la tabla del listado de datos
// 		$("#form_registros").show(); //muetra el formulario de registro
// 		//$("#form_registros_edit").hide();
// 		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
// 		//$("#form_detalle").hide();
// 		$("#btn_agregar").hide();
// 		listarArticulos(); //llamo la funcion de listar los articulos para cuando llamo al form se ejecute esta funcion
// 		//y asi me cargue de una vez la lista antes de mostrar el modal de seleccionar los articulos para los detalles
// 	}else{
// 		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
// 		$("#form_registros").hide(); //oculta el formulario de registro de categorias
// 		$("#btn_agregar").show();
// 	}
// }

// function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
// 	limpiar(); //limpiar todos los id y campos
// 	mostrarForm(false); //oculta el formulario de registro
// 	//mostrarFormEdit(false);
// }

function allDisable(){ //funcion para mostrar el listado de datos
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
			url: '../ajax/ingresosanulaciones.php?action=allDisable',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		//"bFilter": true,
		"iDisplayLength": 6, //pagination 
		"aaSorting": [[ 0, "DESC"]] //order item by... 
	}).DataTable();
}

init();