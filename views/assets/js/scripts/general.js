$(document).ready(function(){

	/* VARIABLE GLOBAL URL */
	
	url = $(".url").val();
	
	/* End of VARIABLE GLOBAL URL */

	/* VARIABLE GLOBAL MODULO ACTUAL */
	
	moduloActual = $(".moduloActual").val();
	
	/* End of VARIABLE GLOBAL MODULO ACTUAL */

	/* ACTIVAR INPUTS AL CARGAR DOM */
	
	$('.input-carga').prop("disabled",false);
	
	/* End of ACTIVAR INPUTS AL CARGAR DOM */

	/* INICIALIZAR DATA TABLE */
	
	$('.dataTable').DataTable({
	    dom: 'Bfrtip',
	    buttons: [
	      {
	        extend: "copyHtml5",
	        text: '<img src="views/assets/css/img/iconos/datatable/icono-copiar.svg" width="20" height="20">',
	        titleAttr: "Copy",
	      },
	      {
	        extend: "excelHtml5",
	        text: '<img src="views/assets/css/img/iconos/datatable/icono-excel.svg" width="20" height="20">',
	        titleAttr: "Excel",
	      },
	      {
	        extend: "csvHtml5",
	        text: '<img src="views/assets/css/img/iconos/datatable/icono-csv.svg" width="20" height="20">',
	        titleAttr: "CSV",
	      },
	    ],
	    language: { url: url + "views/assets/plugins/DataTables/Spanish.json" },
	    responsive: true,
	    ordering: true,
	});
	
	/* End of INICIALIZAR DATA TABLE */

	/* SELECT EDITABLE */
	
	$('.selectEditable').editableSelect();
	
	/* End of SELECT EDITABLE */

	/* SELECT 2 */
	
	$('.select2').select2();
	
	/* End of SELECT 2 */

	/* APLICAR CLASES AL ENLACE DEL MODULO ACTUAL */
	
	$('.nav-link[href="' + url + moduloActual + '"]').css('background-color','#FEDD64');
	$('.nav-link[href="' + url + moduloActual + '"]').css('color','#000000');
    
    if ($('.nav-link[href="' + url + moduloActual + '"]').parent().hasClass("parentNav")) {
        $('.nav-link[href="' + url + moduloActual + '"]').parent().addClass("show");
        $('.nav-link[href="' + url + moduloActual + '"]').parent().parent().children().first().css('background-color','rgba(214, 219, 234, 0.38)');
    }
	
	/* End of APLICAR CLASES AL ENLACE DEL MODULO ACTUAL */
	
});

/* LOADING */

function loading(estado){

	if(estado){

		$("#body").LoadingOverlay("show", {

            image: url+"views/assets/img/loading.gif",

            imageAnimation: ""

        });

	}else{

		$("#body").LoadingOverlay("hide");
	}

}

/* End of LOADING */

/* DESACTIVAR INPUT */

function desactivarInput(estado) {
    $('.submit-carga').prop("disabled", estado);
}

/* End of DESACTIVAR INPUT */

/* CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

$(document).on('change', '.cambioEstado', function(){

	let estado = $(this).is(":checked") ? 0 : 1; 
    let tabla = $(this).attr('tabla');  
    let idRegistro = $(this).attr('idRegistro');

    let datos = new FormData();

    datos.append("estadoSwitch", estado);
    datos.append("tablaSwitch", tabla);
    datos.append("idSwitch", idRegistro);

    $.ajax({
        url:url+"views/ajax/ajax_general.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

			if(respuesta === "session_expired"){

				sesionExpirada();

			}
        	
        }
    });
});

/* End of CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

/* ELIMINAR REGISTRO */

$(document).on('click', '.eliminarRegistro', function(){

	let idRegistro = $(this).attr('idRegistro');
	let tabla = $(this).attr('tabla');

	swal({
		 title: '¡Cuidado!',
		 text: '¿Estás seguro que deseas eliminar el registro seleccionado?',
		 icon: 'warning',
		 buttons: true,
		 dangerMode: true,
	   })
	   .then((willDelete) => {
		 if (willDelete) {

			let datos = new FormData();

			datos.append("tablaEliminar", tabla);
			datos.append("idEliminar", idRegistro);

			$.ajax({
				url:url+"views/ajax/ajax_general.php",
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

/* End of ELIMINAR REGISTRO */

/* ALERTA DE SESION EXPIRADA */

function sesionExpirada() {

	swal({
	   title: '¡La sesión ha expirado!',
	   text: '¡Inicia sesión nuevamente!',
	   icon: 'warning',
	   button: 'Aceptar',
	}).then(function() {
	   location.reload();
	});
	
}

/* End of ALERTA DE SESION EXPIRADA */

/* ALERTA PARA INSERT */

function alertaInsert() {

	swal({
	   title: '¡Bien!',
	   text: '¡Se realizó el registro exitosamente!',
	   icon: 'success',
	   button: 'Aceptar',
	}).then(function() {
	   location.reload();
	});
	
}

/* End of ALERTA PARA INSERT */

/* ALERTA PARA UPDATE */

function alertaUpdate() {

	swal({
	   title: '¡Bien!',
	   text: '¡Se modificó el registro exitosamente!',
	   icon: 'success',
	   button: 'Aceptar',
	}).then(function() {
	   location.reload();
	});
	
}

/* End of ALERTA PARA UPDATE */

/* VALIDAR PDF E IMAGEN */

$(document).on('change', '.validarPdfImagen', function(){

	if($(this)[0].files[0].type != "application/pdf" && $(this)[0].files[0].type != "image/jpeg" && $(this)[0].files[0].type != "image/png"){

		$(this).val("");

		swal("¡Error!", "¡Solo se permiten archivos en formato PDF, JPG y PNG!", "error");

    }

});

/* End of VALIDAR PDF E IMAGEN */

/* VALIDAR IMAGENES */

$(document).on('change', '.validarImagen', function(){

	if($(this)[0].files[0].type != "image/jpeg" && $(this)[0].files[0].type != "image/png"){

		$(this).val("");

		swal("¡Error!", "¡Solo se permiten archivos en formato JPG y PNG!", "error");

    }

});

/* End of VALIDAR IMAGENES */

/* VALIDAR PDF */

$(document).on('change', '.validarPdf', function(){

	if($(this)[0].files[0].type != "application/pdf"){

		$(this).val("");

		swal("¡Error!", "¡Solo se permiten archivos en formato PDF!", "error");

    }

});

/* End of VALIDAR PDF */

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

/* FUNCION OBTENER FECHA ACTUAL */

function obtenerFechaActual(){
    let fecha = new Date();
    let dd = fecha.getDate();
    let mm = fecha.getMonth()+1;
    let yyyy = fecha.getFullYear();
    
    dd = agregarCero(dd);
    mm = agregarCero(mm);

    return yyyy+'-'+mm+'-'+dd;

}

function agregarCero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

/* End of FUNCION OBTENER FECHA ACTUAL */

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

/* FORMATO DINERO */

const FORMATTER = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2
});

/* End of FORMATO DINERO */

/*=====================================
=            VALIDAR CAMPO            =
=====================================*/

$(document).on("change", ".validarCampo", function () {

	let input = $(this);
    let nombre = $(this).val();
    let columna = $(this).attr("columna");
    let tabla = $(this).attr("tabla");
    let mensaje = $(this).attr("mensaje");

	let datos = new FormData();

    datos.append("valorCampo", nombre);
    datos.append("columnaCampo", columna);
    datos.append("tablaCampo", tabla);

    $.ajax({
        url:url+"views/ajax/ajax_general.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            if(respuesta === "session_expired"){

                sesionExpirada();

            }else{

                if(respuesta == 0){
                
                    $(input).addClass("is-invalid");
                    $(input).next().html(mensaje);
                    $(input).next().show();
    
                }else{
                    
                    $(input).removeClass("is-invalid");
                    $(input).next().hide();

                }

            }

        }
    });

});

/*=====  End of VALIDAR CAMPO  ======*/

/*============================================
=            VALIDAR CAMPO EDITAR            =
============================================*/

$(document).on("change", ".validarCampoEditar", function () {

	let input = $(this);
	let nombre = $(this).val();
	let columna = $(this).attr("columna");
	let tabla = $(this).attr("tabla");
	let mensaje = $(this).attr("mensaje");
    let idRegistro = $(this).attr("idRegistro");

    let datos = new FormData();

    datos.append("valorCampoEditar", nombre);
    datos.append("columnaCampoEditar", columna);
    datos.append("tablaCampoEditar", tabla);
    datos.append("idRegistro", idRegistro);

    $.ajax({
        url:url+"views/ajax/ajax_general.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            if(respuesta === "session_expired"){

                sesionExpirada();

            }else{

                if(respuesta == 0){
                
                    $(input).addClass("is-invalid");
                    $(input).next().html(mensaje);
                    $(input).next().show();
    
                }else{
                    
                    $(input).removeClass("is-invalid");
                    $(input).next().hide();
                }

            }

        }
    });

});

/*=====  End of VALIDAR CAMPO EDITAR  ======*/



