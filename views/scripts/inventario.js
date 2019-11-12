
var tabla;

function init(){
	mostrarForm_inventario(false);
	showAll(); // listar todos los items

	$("#form_create_update").on("submit", function(e){ //se activa al momento de ejecutarse el eveno submit
		save_edit(e); //se envia la informacion que esta en variable 'e' a la funcion save_edit para almacenar los datos
	})
}


//Limpiar text fields
function limpiar(){
	$("#id_articulo").val("");
	$("#codigo").val("");
	$("#nombre").val("");
	$("#transaccion").val("");
	$("#stock").val("");
	$("#qty").val("");
	$("#id_user").val("");
}
function mostrarForm_inventario(flag){ //funcion del boton para llamar el modal para registrar categorias nuevas
	limpiar();
	if(flag){
		$("#listado_registros").hide(); //oculta la tabla del listado de datos
		$("#form_registros").show(); //muetra el formulario de registro
		$("#btn_save").prop("disabled",false); //oculta o deshabilita el boton de agregar que aparece en el listado tabla
	}else{
		$("#listado_registros").show(); //sino muestra la tabla de listado de categorias
		$("#form_registros").hide(); //oculta el formulario de registro de categorias
	}
}

function cancelarForm(){ //funcion de boton para llamar o regresar del modal de registro al modal de listado de registros
	limpiar(); //limpiar todos los id y campos
	mostrarForm_inventario(false); //oculta el formulario de registro
}

function showAll(){ //funcion para mostrar el listado de datos
	tabla = $('#tb_listado_inventario').dataTable({
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
			url: '../ajax/inventario.php?action=showAll',
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
		url: "../ajax/inventario.php?action=save", //url donde voy a enviar los data
		type: "POST",
		data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
		contentType: false,
		processData: false,

		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
			bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
			mostrarForm_inventario(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
			tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
			//toda la informacion de categorias.
		}
	});

	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
}

function mostrar(id_articulo){
	$.post("../ajax/inventario.php?action=mostrar",{id_articulo : id_articulo}, function(data,status){

		data = JSON.parse(data);
		mostrarForm_inventario(true); //se visualiza el formulario de regitro para ver os datos
		
		$("#codigo").val(data.Codigo);
		$("#nombre").val(data.Nombre);
		$("#stock").val(data.Stock);
		$("#id_user").val(data.updated_by);
		$("#id_articulo").val(data.IDArticulo);
	}) 	
}

/*
	Solucion para validar el input de stock al recibir un valor
*/
const campoNumerico = document.getElementById('qty');

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
/*
function product_data(input){
    var quantity = input.value;

    $.post("../ajax/articulo.php", {
    dataproduct: quantity,
    }, function(response) {
      $('#stok').html(response)
      document.getElementById('qty_aux').focus();
    });
  }
  function data_empty(input) {

    aux = document.formRequest.qty_aux.value;
    var data = eval(aux);

    if(data < 1){
      alert('Please insert quantity in the required field');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }
  function data_stock() {

    stock_aux = document.formRequest.stok.value;
    qty = document.formRequest.qty_aux.value;
    option_aux = document.formRequest.option.value;
      
    if (qty == "") {
      var entry = "";
      var output = "";
    }
    else {
      var output = eval(stock_aux) - eval(qty);
      var entry = eval(stock_aux) + eval(qty);
    }
    if (option_aux == "output"){
      if(stock_aux == "" || stock_aux == 0){
        document.formRequest.total_stok.value = "";
      }else{
        document.formRequest.total_stok.value = (output);
      }
    }
    else {
      if(stock_aux == ""){
        document.formRequest.total_stok.value = "";
      }else{
        document.formRequest.total_stok.value = (entry);
      }
    }
  }
*/
init();