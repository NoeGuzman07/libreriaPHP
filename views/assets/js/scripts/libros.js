
/**
 * Listener para el boton de agregar libros
 * Limpia los campos del modal de registro de libros 
 * Y muestra el modal
 */

$(document).on("click","#agregar_libros",function() {

    $("#titulo_modal_libros").html("Registrar libro");
    $(".input_libros").val("");
    $("#imagen_previsualizar").attr("src","views/assets/img/usuario_default.png")
    $("#input_imagen,#archivo_cedula_libros").next().html("Seleccionar archivo");
    $("#modal_registrar_usuarios").modal("show");

});

/**
 * Listener para el submit del form de registro de libros.
 * Verifica los campos para enviar la infromacion mediante AJAX
*/

$(document).on("submit","#form_libros",function() {

    let id_libros = $("#id_libros_editar").val();
    
    let categoria = $("#categoria_libros").val();
    let codigo = $("#codigo_libros").val();
    let nombre_libro = $("#nombre_libros").val();
    let autor = $("#autor_libros").val();
    let editorial = $("#editorial_libros").val();
    let stock_actual = $("#stock_actual_libros").val();
    let descripcion = $("#descripcion_libros").val();
    let imagen_captura = $("#imagenCamara").val()=="si" ? $("#imagenCamara").attr("src") : false;
    let imagen_subir = $("#input_imagen")[0].files[0]&&!imagen_captura  ? $("#input_imagen")[0].files[0] : false;
        
    var datos = new FormData();
        
    if(id_libros) datos.append("id_libros",id_libros);

        datos.append("categoria", categoria);
        datos.append("codigo", codigo);
        datos.append("nombre_libro", nombre_libro);
        datos.append("autor", autor);
        datos.append("editorial", editorial);
        datos.append("stock_actual", stock_actual);
        datos.append("descripcion", descripcion);

        if(imagen_subir) datos.append("imagen_usuario_subir",imagen_subir);
        if(imagen_captura) datos.append("imagen_usuario_captura",imagen_captura);
        
        $.ajax({
            url:url+'views/ajax/ajax_libros.php',
            method:'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            //manda a llamar loading y desactiva inputs submit
            beforeSend:cargaSistema(true),
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
                cargaSistema(false);
                
            }

        });

});