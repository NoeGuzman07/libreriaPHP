
/* FORMULARIO MODAL: REGISTRO DE USUARIOS */

$(document).on('submit', '#formularioRegistroUsuarios', function() {

    let nombre_completo = $("#registroNombreCompleto").val();
    let correo_electronico = $("#registroCorreoElectronico").val();
	let contrasena  = $("#registroContrasena").val();
    let confirmar_contrasena  = $("#registroConfirmarContrasena").val();
    let fecha_nacimiento  = $("#registroFechaNacimiento").val();
    let nivel = $("#registroNivel").val();
    let imagen  = $("#registroImagen")[0].files[0];
    let estado  = $("#registroEstado").prop('checked') ? 0 : 1;
    let fecha_alta  = $("#registroFechaAlta").val();

    let datos = new FormData();

    datos.append("registroNombreCompleto", nombre_completo);
    datos.append("registroCorreoElectronico", correo_electronico);
    datos.append("registroContrasena", contrasena);
    datos.append("registroConfirmarContrasena", confirmar_contrasena);
    datos.append("registroFechaNacimiento", fecha_nacimiento);
    datos.append("registroNivel", nivel);
    datos.append("registroImagen", imagen);
    datos.append("registroEstado", estado);
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

/* EVENTO JAVASCRIPT: CORREO ELECTRONICO */

$("#registroCorreoElectronico").change(function() {

    //COMANDO QUE AYUDA A LIMPIAR EL MENSAJE QUE SE MUESTRA CUANDO UN CORREO ELECTRONICO YA EXISTE EN EL SISTEMA
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
            
            //CONDICION QUE VERIFICA QUE SI EL CORREO ELECTRONICO EXISTE
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

/* FORMULARIO MODAL: REGISTRO DE USUARIOS: CONFIRMAR CONTRASENA */

$("#registroConfirmarContrasena").change(function() {

    //COMANDO QUE AYUDA A LIMPIAR EL MENSAJE QUE SE MUESTRA CUANDO 
    //UN CORREO ELECTRONICO YA EXISTE EN EL SISTEMA
    $(".alert").remove();

    let contrasena  = $("#registroContrasena").val();
    let confirmar_contrasena  = $("#registroConfirmarContrasena").val();
    var datos = new FormData();
    datos.append("registroContrasena", contrasena);
    datos.append("registroConfirmarContrasena", confirmar_contrasena);

    //CONDICION QUE PERMITE VERIFICAR SI LA CONTRASENA Y SU CONFIRMACION NO COINCIDEN
    //DURANTE EL REGISTRO DE USUARIOS
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

/* ELIMINAR USUARIO DEL SISTEMA */
$(document).on('click', '.eliminarUsuarios', function() {

	let id_usuarios = $(this).attr('id_usuarios');

	swal({
		 title: '¡Cuidado!',
		 text: '¿Estás seguro que deseas eliminar al usuarios seleccionado?',
		 icon: 'warning',
		 buttons: true,
		 dangerMode: true,
	   })
	   .then((willDelete) => {
		 if (willDelete) {

			let datos = new FormData();

			datos.append("id_usuarios_eliminar", id_usuarios);

			$.ajax({
				url:url+"views/ajax/ajax_usuarios.php",
				method:"POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success:function(respuesta){

					if(respuesta === "session_expired"){

						sesionExpirada();
		
					}else{

						swal({
							title: '¡Bien!',
							text: '¡El registro se eliminó exitosamente!',
							icon: 'success',
							button: 'Aceptar',
						 }).then(function() {
	 
							 location.reload();
	 
						 });

					}

				}
			});
	
		 }else{
	
		 }
	});

});

/* FORMULARIO MODAL: CONSULTA PARTICULAR DE DATOS: USUARIOS */

$(document).on('click', '.consultaDatosUsuarios', function() {

    let id_usuarios = $(this).attr('id_usuarios');

    let datos = new FormData();

	datos.append("id_usuarios_consultar", id_usuarios);

    $.ajax({
        url:url+"views/ajax/ajax_usuarios.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType: "json",
        success:function(respuesta) {

            console.log(respuesta);

            if(respuesta) {

                let variable = JSON.parse(respuesta);
                //console.log(variable);
                
                $('#editarNombreCompleto').val(variable.nombre_completo);
                $('#editarCorreoElectronico').val(variable.correo_electronico);
                //$('#editarContrasena').val(variable.contrasena);
                //$('#editarConfirmarContrasena').val(variable.confirmar_contrasena);
                $('#editarFechaNacimiento').val(variable.fecha_nacimiento);
                $('#editarNivel').val(variable.nivel);
                //$('#editarImagen').val(variable.imagen);
                if(variable.estado==0) {
                    $("#editarEstado").prop('checked', true);
                } else {
                    $("#editarEstado").prop('checked', false);
                }
                //$('#editarFechaAlta').val(variable.fecha_alta);

            }

        }
        
    });

});

/* FORMULARIO MODAL: EDITAR USUARIOS */

$(document).on('submit', '#formularioEditarUsuarios', function() {

    let nombre_completo = $("#editarNombreCompleto").val();
    let correo_electronico = $("#editarCorreoElectronico").val();
	let contrasena  = $("#editarContrasena").val();
    let confirmar_contrasena  = $("#editarConfirmarContrasena").val();
    let fecha_nacimiento  = $("#editarFechaNacimiento").val();
    let nivel = $("#editarNivel").val();
    let imagen  = $("#editarImagen")[0].files[0];
    let estado  = $("#editarEstado").val();
    let fecha_alta  = $("#editarFechaAlta").val();

    let datos = new FormData();

    datos.append("editarNombreCompleto", nombre_completo);
    datos.append("editarCorreoElectronico", correo_electronico);
    datos.append("editarContrasena", contrasena);
    datos.append("editarConfirmarContrasena", confirmar_contrasena);
    datos.append("editarFechaNacimiento", fecha_nacimiento);
    datos.append("editarNivel", nivel);
    datos.append("editarImagen", imagen);
    datos.append("editarEstado", estado);
    datos.append("editarFechaAlta", fecha_alta);

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

                swal("¡Error!", "¡Error al actualiza los datos del usuario!", "error");

            }

        }

    });

});