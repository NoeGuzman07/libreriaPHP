<?php
	$librosAutor = LibrosController::buscarAutorLibrosController(null, null);
    $librosEditorial = LibrosController::buscarEditorialLibrosController(null, null);
    $categoria = LibrosController::buscarCategoriaController(null, null);
?>

<!-- Título del módulo -->
<div class="titulo-boton">
    <h1 class="titulo-modulo">Libros</h1>
    <button class="btn btn-agregar con-icono" id="agregar_libros">Agregar</button>
</div>
<!-- Título del módulo -->

<!-- Tabla de libros -->
<h6 class="subtitulo">Tabla de libros</h6>
<div class="caja">
    <div class="row">
        <div class="col-md-12">
            <table id="tabla_libros" class="table w-100" style="text-align: center;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Botones</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Fecha de alta</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Tabla de libros -->

<!-- Modal para registrar libros -->
<div class="modal fade" id="modal_registrar_libros" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form onsubmit="return false;" id="form_libros">
				<div class="modal-header">
					<h5 class="modal-title" id="titulo_modal_libros"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="id_libros">
                    
					<div class="row">

                        <div class="col-md-4">
                        	<div class="form-group">
                            	<label for="">Categoría:</label>
                                <select class="form-control input_libros" id="id_categoria" columna="id_categoria" required>
                                    <option value="" selected disabled>Selecciona una opción</option>
                                    <?php foreach ($categoria as $key => $value) : ?>
                                        <option value="<?php echo $value["id_categoria"]; ?>"><?php echo ($key + 1); ?>. <?php echo $value["nombre"]; ?></option>
                                        <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Código:</label>
                                <input type="text" class="form-control input_libros validarCampo" id="codigo_libros" tabla="libros" columna="codigo" mensaje="El codigo del libro ya se encuentra registrado" required>
                                <div class="invalid-feedback" style="display: none;"></div>
                            </div>
                        </div>

						<div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre del libro:</label>
                                <input type="text" class="form-control input_libros validarCampoNombre" id="nombre_libros" tabla="libros" columna="nombre" mensaje="El nombre ya se encuentra registrado en la categoria seleccionada" required>
                                <div class="invalid-feedback" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        	<div class="form-group">
                            	<label for="">Autor:</label>
                                <select class="form-control input_libros" id="autor_libros" required>
                                <option value="" disabled>Seleccione/Ingrese una opción</option>
                                    <?php foreach ($librosAutor as $key => $value) : ?>
                                        <option><?php echo $value["autor"]; ?></option>
                                        <?php endforeach ?>
                                </select>
                            </div>
                        </div>

						<div class="col-md-6">
                        	<div class="form-group">
                            	<label for="">Editorial:</label>
                                <select class="form-control input_libros" id="editorial_libros" required>
                                    <option value="" disabled>Seleccione/Ingrese una opción</option>
                                    <?php foreach ($librosEditorial as $key => $value) : ?>
                                        <option><?php echo $value["editorial"]; ?></option>
                                        <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Precio:</label>
                                <input type="number" class="form-control input_libros validar0" id="precio_libros" required>
                                <div class="invalid-feedback" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stock Actual (opcional):</label>
                                <input type="number" class="form-control input_libros validar00" id="stock_libros">
                            </div>                            
                        </div>
                        
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Descripción:</label>
                                <textarea class="form-control input_libros" id="descripcion_libros"  rows="4" cols="100" style="min-width: 100%; resize: none;" required>Write something here</textarea>
                            </div>                            
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-12">

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label for="">Imagen: (Opcional)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input input_libros imagenPrevisualizar validarImagen" id="input_imagen" lang="esp">
                                        <label class="custom-file-label" for="">Seleccionar archivo</label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center mt-3">
                                    <img src="<?= $url; ?>views/assets/img/usuario_default.png" style="width:120px;heigth:120px;" id="imagen_previsualizar">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-aceptar submit-carga">Agregar</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Modal para registrar libros -->