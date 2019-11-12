
$("#formAccess").on('submit',function(event) {
	
	event.preventDefault();
	username = $("#username").val();
	passwd = $("#passwd").val();

	$.post("../ajax/useraccess.php?action=verify", {"username":username, "passwd":passwd}, function(data) {
		/*optional stuff to do after success */
		data = JSON.parse(data);
		if (data!=null) {
			$(location).attr("href", "../views/dashboard.php");
		} else{
			bootbox.alert("<div class='alert alert-warning alert-dismissable'>Please, verify username or password!</div>")
		}
	});
    limpiar();
})

function limpiar(){
    $("#username").val("");
    $("#passwd").val("");
}

// function logon(){
// 	$.post("../ajax/useraccess.php?action=destroysession", {}, function(data) { 
		
// 	});
// }
// function logon(){ //funcion para guardary editar los datos
// 	//e.preventDefault();  //no se activara la accion predeterminada del evento
// 	$("#btn_logon").prop("disabled",true); // evento que deshabilita el boton una vez que se presiona guardar
// 	//var formData = new FormData($("#form_create_update")[0]); //todos los datos del formulario se envian a formData

// 	$.ajax({
// 		url: "../ajax/useraccess.php?action=destroysession", //url donde voy a enviar los data
// 		type: "POST",
// 		//data: formData, //en data paso todos los datos mediante la variable formData (que captura todos los datos del formulario)
// 		contentType: false,
// 		processData: false,

// 		success: function(datos){ // en datos_alerta retorno desde categoria.php en ajax los mensajes de echo "", accion realizada
// 			//bootbox.alert(datos); //envio al alert que aparecera en el index categoria el msj de accion realizada
// 			//mostrarForm_article(false); //cada vez que se ejecuta la accion guardar o editar, de inmediato oculto el div modal con false
// 			//tabla.ajax.reload(); //luego de cerrar u ocultar el div modal recargo la tabla de informacion de categorias
// 			//esta variable u objeto tabla, hace referencia a la variable tabla en la funcion javascript de showAll() que captura
// 			//toda la informacion de categorias.
			
// 		}
// 	});

// 	limpiar(); //luego de los procesos de guardar o editar limpio todos los campos del formulario y sus id
// }