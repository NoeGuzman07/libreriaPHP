
/* Listener para el boton de Agregar libros, limpia los campos del modal de registro de libros y muestra el modal */

$(document).on("click", "#agregar_libros", function() {

    $("#titulo_modal_libros").html("Agregando libro");
    $(".input_libros").val("");
    $("#codigo_libros").removeClass("validarCampoEditar").addClass("validarCampo").attr("id_libros","").change();
    $("#nombre_libros").removeClass("validarCampoNombreEditar").addClass("validarCampoNombre").attr("id_libros","").change();
    $("#imagen_previsualizar").attr("src","views/assets/img/usuario_default.png")
    $("#input_imagen,#archivo_cedula_libros").next().html("Seleccionar archivo");
    $("#modal_registrar_libros").modal("show");

});

/* Listener para el submit del form de Agregar libros, verifica los campos para enviar la infromacion mediante AJAX */

$('#autor_libros').editableSelect();
$('#editorial_libros').editableSelect();

$(document).on("submit","#form_libros",function() {

    let id_libros = $("#id_libros").val();
    let id_categoria = $("#id_categoria").val();

    let codigo = $("#codigo_libros").val();
    let nombre = $("#nombre_libros").val();
    let autor = $("#autor_libros").val();
    let editorial = $("#editorial_libros").val();
    let precio = $("#precio_libros").val();
    let stock = $("#stock_libros").val();
    let descripcion = $("#descripcion_libros").val();
    let imagen = $("#input_imagen")[0].files[0];

    var datos = new FormData();
        
    if(id_libros) datos.append("id_libros",id_libros);

        datos.append("id_categoria", id_categoria);
        
        datos.append("codigo_libros", codigo);
        datos.append("nombre", nombre);
        datos.append("autor_libros", autor);
        datos.append("editorial_libros", editorial);
        datos.append("precio_libros", precio);
        datos.append("stock_libros", stock);
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

/* Validar imagenes */

$(document).on('change', '.validarImagen', function() {
	if($(this)[0].files[0].type != "image/jpeg" && $(this)[0].files[0].type != "image/png"){
		$(this).val("");
		swal("¡Error!", "¡Solo se permiten archivos en formato JPG y PNG!", "error");
    }
});

/* Validar previsualizar imagenes */

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
      $("#stock_libros").val("");
	}
});

/**
 * Listener para mostrar la informacion al editar un libro
 * Se manda a llamar un ajax para obtener la información, 
 * Una vez recibida se muestra en los campos del modal para registrar libros
 * Y al terminar se muestra el modal.
 */

$(document).on("click",".editar_libros",function(){
    
    var datos = new FormData();
    
    datos.append("id_libros_buscar",$(this).attr("id_libros"));
    
    $.ajax({
        url:url+'views/ajax/ajax_libros.php',
        method:'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:loading(true),
        success:function(respuesta){
            // console.log(respuesta);
            if(respuesta=="session_expired"){
                sesionExpirada();
            }else{
                respuesta = JSON.parse(respuesta);
                $("#titulo_modal_libros").html("Editando libro");
                $("#id_libros_editar").val(respuesta.id_libros);
                //$("#codigo_libros").val(respuesta.codigo);
                $("#codigo_libros").val(respuesta.codigo).removeClass("validarCampo").addClass("validarCampoEditar").attr("id_libros", respuesta.id_libros).change();
                $("#nombre_libros").val(respuesta.nombre);
                $("#autor_libros").val(respuesta.autor);
                $("#editorial_libros").val(respuesta.editorial);
                $("#precio_libros").val(respuesta.precio);
                $("#stock_libros").val(respuesta.stock);
                $("#descripcion_libros").val(respuesta.descripcion);
                // $("#imagen_previsualizar,#imagenCamaraPaciente").attr("src",url+respuesta.imagen);
                $("#modal_registrar_usuarios").modal("show");
            }
            loading(false);
        }
    });
});

/* Listener para valiidar el campo de nombre de libros
 * El nombre del libro no puede repetirse dentro de la misma categoria
 */

$(document).on("change", ".validarCampoNombre", function () {

    let valorPrimario = $("#id_categoria").val();
    let columnaPrimario = $("#id_categoria").attr("columna");
    
    let input = $(this);
    let valorSecundario = $(this).val();
    let columnaSecundario = $(this).attr("columna");

    let tabla = $(this).attr("tabla");
    let mensaje = $(this).attr("mensaje");

    let datos = new FormData();

    datos.append("valorCampoPrimario", valorPrimario);
    datos.append("columnaCampoPrimario", columnaPrimario);

    datos.append("valorCampoSecundario", valorSecundario);
    datos.append("columnaCampoSecundario", columnaSecundario);

    datos.append("tablaCampo", tabla);

    $.ajax({
        url:url+"views/ajax/ajax_general.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta) {
            if(respuesta === "session_expired") {
                sesionExpirada();
            } else {
                if(respuesta == 0) {
                    $(input).addClass("is-invalid");
                    $(input).next().html(mensaje);
                    $(input).next().show();
                } else {
                    $(input).removeClass("is-invalid");
                    $(input).next().hide();
                }
            }
        }
    });
});

//Script para mostrar tabla de libros, esta debe cargarse desde JSON
//mediante una respuesta desde AJAX

$(document).ready(function() {
    cargarTablaLibros();
});

function cargarTablaLibros() {

    const tabla = $('#tabla_libros');

    if(tabla.length) {

        let filtros = "";
        if($.fn.DataTable.isDataTable('#tabla_libros')) tabla.DataTable().destroy();
    
        tabla.DataTable({
            "ajax": {
                "url" : url+'views/ajax/dataTables/ajax-datatable_libros.php' + filtros,
                "dataSrc" : function(response) {
                    loading(false);
                    return response.data;
                },
                "BeforeSend":loading(true)
            },
            "deferRender": true,
            "retrieve": true,
            "processing": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text:'<img src="'+url+'views/assets/css/img/iconos/datatable/icono-copiar.svg" width="20" height="20">',
                    titleAttr: 'Copy',
                },
                {
                    extend: 'excelHtml5',
                    text: '<img src="'+url+'views/assets/css/img/iconos/datatable/icono-excel.svg" width="20" height="20">',
                    titleAttr: 'Excel',
                },
                {
                    extend: 'csvHtml5',
                    text: '<img src="'+url+'views/assets/css/img/iconos/datatable/icono-csv.svg" width="20" height="20">',
                    titleAttr: 'CSV',
                },
            ],
            responsive: true,
            ordering: true,
            "language":{"url": url+"views/assets/plugins/DataTables/Spanish.json"}
        });
    
    }
}