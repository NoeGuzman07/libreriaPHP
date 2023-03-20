
/* FORMULARIO MODAL: REGISTRO DE USUARIOS */

$(document).on('submit', '#formularioRegistroUsuarios', function() {

    let nombre_completo = $("#registroNombreCompleto").val();
    let correo_electronico = $("#registroCorreoElectronico").val();
	let contrasena  = $("#registroContrasena").val();
    let confirmar_contrasena  = $("#registroConfirmarContrasena").val();
    let fecha_nacimiento  = $("#registroFechaNacimiento").val();
    let nivel = $("#registroNivel").val();
    let imagen  = $("#registroImagen").val();
    let fecha_alta  = $("#registroFechaAlta").val();

    let datos = new FormData();

    datos.append("registroNombreCompleto", nombre_completo);
    datos.append("registroCorreoElectronico", correo_electronico);
    datos.append("registroContrasena", contrasena);
    datos.append("registroConfirmarContrasena", confirmar_contrasena);
    datos.append("registroFechaNacimiento", fecha_nacimiento);
    datos.append("registroNivel", nivel);
    datos.append("registroImagen", imagen);
    datos.append("registroFechaAlta", fecha_alta);

	$.ajax({

		url:url+"views/ajax/ajax_usuarios.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
        beforeSend: function() {

        	loading(true);

        },
        
        success:function(respuesta) {
        	
            console.log("respuesta", respuesta);

        	loading(false);

            if(respuesta === "usuarios"){

                window.location = url+"usuarios";

            } else {

                swal("¡Error!", "¡Error de dar de alta al usuario!", "error");

            }

        }

    });

});

/* FORMULARIO MODAL: REGISTRO DE USUARIOS */

$("#registroCorreoElectronico").change(function() {

    //Comando que ayuda a limpiar el mensaje de email repetido cuando se introduce un email nuevo
    $(".alert").remove();

    var correo_electronico = $(this).val();
    var datos = new FormData();
    datos.append("validarCorreoElectronico", correo_electronico);

    $.ajax({

        url:url+"views/ajax/ajax_usuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            
            //Condicion para verificar que si el correo existe o no
            if(respuesta) {

                $("#registroCorreoElectronico").val("");

                $("#registroCorreoElectronico").parent().after(`
                    <div class="alert alert-warning">
                        <b>ERROR:</b>
                        El correo electronico ya existe, por favor introduzca otro diferente
                    
                    </div>
                `)

            }

        }

    });

});

/* FORMULARIO MODAL: REGISTRO DE USUARIOS */

$("#registroConfirmarContrasena").change(function() {

    //Comando que ayuda a limpiar el mensaje de email repetido cuando se introduce un email nuevo
    $(".alert").remove();

    let contrasena  = $("#registroContrasena").val();
    let confirmar_contrasena  = $("#registroConfirmarContrasena").val();
    var datos = new FormData();
    datos.append("registroContrasena", contrasena);
    datos.append("registroConfirmarContrasena", confirmar_contrasena);

    //Condicion para verificar que si el correo existe o no
    if(confirmar_contrasena!=contrasena) {

        $("#registroContrasena").val("");
        $("#registroConfirmarContrasena").val("");

        $("#registroConfirmarContrasena").parent().after(`
            <div class="alert alert-warning">
                <b>ERROR:</b>
                Las contrasenas no coinciden, intente de nuevo
            
            </div>
        `)

    }

});