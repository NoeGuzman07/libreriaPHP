
/**
 * Listener para el boton de agregar libros
 * Limpia los campos del modal de registro de libros 
 * Y muestra el modal
 */

$(document).on("click", "#agregar_libros", function() {

    $("#titulo_modal_libros").html("Agregando libro");
    $(".input_libros").val("");
    $("#imagen_previsualizar").attr("src","views/assets/img/usuario_default.png")
    $("#input_imagen,#archivo_cedula_libros").next().html("Seleccionar archivo");
    $("#modal_registrar_libros").modal("show");

});

/**
 * Listener para el submit del form de registro de libros.
 * Verifica los campos para enviar la infromacion mediante AJAX
*/

$(document).on("submit","#form_libros",function() {

    let id_libros = $("#id_libros_editar").val();
    
    let categoria = $("#categoria_libros").val();
    let codigo = $("#codigo_libros").val();
    let nombre_libros = $("#nombre_libros").val();
    let autor = $("#autor_libros").val();
    let editorial = $("#editorial_libros").val();
    let precio = $("#precio_libros").val();
    let stock_actual = $("#stock_actual_libros").val();
    let descripcion = $("#descripcion_libros").val();
    let imagen = $("#input_imagen")[0].files[0];

    var datos = new FormData();
        
    if(id_libros) datos.append("id_libros",id_libros);

        datos.append("categoria_libros", categoria);
        datos.append("codigo_libros", codigo);
        datos.append("nombre_libros", nombre_libros);
        datos.append("autor_libros", autor);
        datos.append("editorial_libros", editorial);
        datos.append("precio_libros", precio);
        datos.append("stock_actual_libros", stock_actual);
        datos.append("descripcion_libros", descripcion);

        if(imagen) datos.append("imagen_libros",imagen);
        
        $.ajax({
            url:url+'views/ajax/ajax_libros.php',
            method:'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            //manda a llamar loading y desactiva inputs submit
            //beforeSend:cargaSistema(true),
            success:function(respuesta) {
                // console.log(respuesta);
                if(respuesta=="session_expired") {
                    //si la session con el servidor expiró, recarga el sitio
                    sesionExpirada();
                } else if(respuesta=="success") {
                    //el registro se realizo exitosamente.
                    (id_libros!="") ? alertaUpdate() : alertaInsert();
                } else {
                    //se recibio un mensaje diferente a success
                    swal("¡Error!", "Ha ocurrido un error.", "error");
                }
                //desactivamos el loading y habilitamos los inputs submit
            //cargaSistema(false);
                
            }

        });

});

/*====================================================
=            VALIDAR IMAGEN PREVISUALIZAR            =
====================================================*/

$(document).on('change', '.imagenPrevisualizar', function(){

	let imagen = this.files[0];
    let input = $(this);

	if((imagen.type == "image/jpeg" || imagen.type == "image/png")){

		let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            let rutaImagen = event.target.result;

            input.parent().prev().attr("src", rutaImagen);

        });

	}

});

/*=====  End of VALIDAR IMAGEN PREVISUALIZAR  ======*/

/* VALIDAR IMAGENES */

$(document).on('change', '.validarImagen', function(){

	if($(this)[0].files[0].type != "image/jpeg" && $(this)[0].files[0].type != "image/png"){

		$(this).val("");

		swal("¡Error!", "¡Solo se permiten archivos en formato JPG y PNG!", "error");

    }

});

/* End of VALIDAR IMAGENES */

/* VALIDAR 0 */

$(document).on("change", ".validar0", function () {

	let valor = Number($(this).val());
  
	if(valor <= 0){
	  $(this).addClass("is-invalid");
	  $(this).next().show();
	}else{
	  $(this).removeClass("is-invalid");
	  $(this).next().hide();
	}
  
});

/* End of VALIDAR 0 */