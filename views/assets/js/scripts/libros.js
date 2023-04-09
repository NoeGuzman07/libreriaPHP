
/* Listener para el boton de Agregar libros, Limpia los campos del modal de registro de libros Y muestra el modal */

$(document).on("click", "#agregar_libros", function() {

    $("#titulo_modal_libros").html("Agregando libro");
    $(".input_libros").val("");
    $("#imagen_previsualizar").attr("src","views/assets/img/usuario_default.png")
    $("#input_imagen,#archivo_cedula_libros").next().html("Seleccionar archivo");
    $("#modal_registrar_libros").modal("show");

});

/* Listener para el submit del form de Agregar libros, Verifica los campos para enviar la infromacion mediante AJAX */

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
            success:function(respuesta) {
                if(respuesta=="session_expired") {
                    sesionExpirada();
                } else if(respuesta=="success") {
                    //el registro se realizo exitosamente.
                    (id_libros!="") ? alertaUpdate() : alertaInsert();
                } else {
                    swal("¡Error!", "Ha ocurrido un error.", "error");
                }
            }
        });

});

/* Validar Imagenes */

$(document).on('change', '.validarImagen', function(){
	if($(this)[0].files[0].type != "image/jpeg" && $(this)[0].files[0].type != "image/png"){
		$(this).val("");
		swal("¡Error!", "¡Solo se permiten archivos en formato JPG y PNG!", "error");
    }
});

/* Validar Imagen Previsualizar */

$(document).on('change', '.imagenPrevisualizar', function(){
	let imagen = this.files[0];
	let input = $(this);
	if((imagen.type == "image/jpeg" || imagen.type == "image/png")){
		let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event){
            let rutaImagen = event.target.result;
			$("#imagen_previsualizar").attr("src", rutaImagen);
        });
	}
});

/* Validar 0 en el campo de precios de libros */

$(document).on("change", ".validar0", function () {
	let valor = Number($(this).val());
	if(valor <= 0) {
      $("#precio_libros").val("");
	}
});

/* Validar 0 en el campo del Stock actual de libros */

$(document).on("change", ".validar00", function () {
	let valor = Number($(this).val());
	if(valor < 1) {
      $("#stock_actual_libros").val("");
	}
});

/* Funcion de JavaScript para validar los Codigos de libros, esta conectado con AJAX */

$("#codigo_libros").change(function() {
    $(".alert").remove();
    var codigo = $(this).val();
    var datos = new FormData();
    datos.append("validarCodigoLibros", codigo);
    $.ajax({
        url:url+"views/ajax/ajax_libros.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if(respuesta) {
                $("#codigo_libros").val("");
                $("#codigo_libros").parent().after(`
                    <div class="alert alert-warning">
                        <b>ERROR:</b>
                        El codigo del libro ya existe, por favor introduzca otro diferente
                    </div>`)
            }
        }
    });
});