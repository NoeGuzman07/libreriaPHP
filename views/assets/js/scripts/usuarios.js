
/* FORMULARIO MODAL: REGISTRO DE USUARIOS */

$(document).on('submit', '#formularioRegistroUsuarios', function() {

    let nombre_completo = $("#registroNombreCompleto").val();
    let correo_electronico = $("#registroCorreoElectronico").val();
	let contrasena  = $("#registroContrasena").val();
    let confirmar_contrasena  = $("#registroConfirmarContrasena").val();
    let fecha_nacimiento  = $("#registroFechaNacimiento").val();
    let nivel = $("#registroNivel").val();
    let imagen  = $("#registroImagen").val();

    let datos = new FormData();

    datos.append("registroNombreCompleto", nombre_completo);
    datos.append("registroCorreoElectronico", correo_electronico);
    datos.append("registroContrasena", contrasena);
    datos.append("registroConfirmarContrasena", confirmar_contrasena);
    datos.append("registroFechaNacimiento", fecha_nacimiento);
    datos.append("registroNivel", nivel);
    datos.append("registroImagen", imagen);


	$.ajax({

		url: "ajax/ajax_usuarios.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
        
		success:function(respuesta){
        	
            console.log("respuesta", respuesta);

        	loading(false);

            if(respuesta === "usuarios"){

                window.location = url+"usuarios";

            } else {

                swal("¡Error!", "¡Error!", "error");

            }

        }

	});

});