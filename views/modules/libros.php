<!-- TITULO DEL MODULO: LIBROS -->
<div class="titulo-boton">
	<h1 class="titulo-modulo">Libros</h1>
</div>
<!-- TITULO DEL MODULO: LIBROS -->

<!-- BOTON MODAL: REGISTRO DE USUARIOS -->
<button class="btn btn-agregar con-icono float-right" id="agregar_libros">Agregar</button><br>
<!-- BOTON MODAL: REGISTRO DE USUARIOS -->

<p>Lista de libros</p>

<!-- FORMULARIO MODAL: REGISTROS DE LIBROS -->
<div class="modal fade" id="modal_registrar_usuarios" data-backdrop="static" tabindex="-1">
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

                    <input type="hidden" id="id_libros_editar">
                    
					<div class="row">

						<div class="col-md-4">
                        	<div class="form-group">
                            	<label for="">Categoría:</label>
                                <select class="form-control input_libros" id="categoria_libros" required>
                                    <option value="" selected>Selecciona una opción</option>
                                    <option value="Administrador">Comic</option>
									<option value="Administrador">Novelas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Código:</label>
                                <input type="text" class="form-control input_libros" id="codigo_libros" required>
                            </div>
                        </div>

						<div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre del libro:</label>
                                <input type="text" class="form-control input_libros" id="nombre_libros" required>
                            </div>
                        </div>

						<div class="col-md-6">
                        	<div class="form-group">
                            	<label for="">Autor:</label>
                                <select class="form-control input_libros" id="autor_libros" required>
                                    <option value="" selected>Seleccione/Ingrese una opción</option>
                                    <option value="Administrador">Stan Lee</option>
									<option value="Administrador">Gabriel Garcia Marquez</option>
                                </select>
                            </div>
                        </div>

						<div class="col-md-6">
                        	<div class="form-group">
                            	<label for="">Editorial:</label>
                                <select class="form-control input_libros" id="editorial_libros" required>
                                    <option value="" selected>Seleccione/Ingrese una opción</option>
                                    <option value="Administrador">Marvel Comic</option>
									<option value="Administrador">Editorial Montenegro</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Precio:</label>
                                <input type="number" class="form-control input_libros" id="precio_libros" required>
                                <div class="invalid-feedback" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stock Actual (opcional):</label>
                                <input type="number" class="form-control input_libros" id="stock_actual_libros" required>
                            </div>                            
                        </div>
                        
                    </div>

                    <div class="row">

                        <!-- Colocar Espacio de texto para la descripcion-->

                    </div>


                    <div class="row">

                        <div class="col-12">

                            <div class="accordion" id="accordion">

                                <div class="card">
                                    
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

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-aceptar submit-carga">Registrar</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- FORMULARIO MODAL: REGISTROS DE LIBROS -->