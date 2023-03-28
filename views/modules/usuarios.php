<?php

	//METODO CONTROLLER: CONSULTA DE DATOS DE USUARIOS
	//$usuarios = UsuariosController::ControllerConsultaUsuarios(null, null);
	$usuarios = UsuariosController::ControllerConsultaGeneralUsuarios(null, null);

?>

<!-- TITULO DEL MODULO: USUARIOS -->
<div class="titulo-boton">
	<h1 class="titulo-modulo">Gestion de Usuarios</h1>
</div>

<!-- BOTON MODAL: REGISTRO DE USUARIOS -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registroUsuariosModal" data-whatever="@mdo">+ Registrar usuario</button><br>

<!-- FORMULARIO MODAL: REGISTROS DE USUARIOS -->
<br><div class="modal fade" id="registroUsuariosModal" tabindex="-1" role="dialog" aria-labelledby="registroUsuariosModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">		
			<div class="modal-content">
				<div class="modal-header">
					<!-- TITULO DEL MODAL -->
					<H5 class="modal-title" id="registroUsuariosModalLabel">Registrar usuario</H5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<!-- CUERPO DEL MODAL -->
				<div class="modal-body">
				<!-- INICIO DEL FORMULARIO: REGISTRO DE USUARIOS -->
					<form id="formularioRegistroUsuarios" onsubmit="return false;">
						<div class="form-row row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="nombre_completo" class="col-form-label">Nombre completo:</label>
									<input type="text" class="form-control" id="registroNombreCompleto" name="" required>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="correo_electronico" class="col-form-label">Correo Electronico:</label>
									<input type="email" class="form-control" id="registroCorreoElectronico" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="contrasena" class="col-form-label">Contrasena:</label>
									<input type="password" class="form-control" id="registroContrasena" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="confirmar_contrasena" class="col-form-label">Confirmar Contrasena:</label>
									<input type="password" class="form-control" id="registroConfirmarContrasena" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento:</label>
									<input type="date" class="form-control" id="registroFechaNacimiento" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha_alta" class="col-form-label">Fecha de alta:</label>
									<?php $fcha = date("Y-m-d");?>
									<input type="date" class="form-control"  id="registroFechaAlta"value="<?php echo $fcha;?>" readonly>
								</div>
							</div>
							<!-- SWITCH: ESTADO DEL USUARIO -->
							<div class="col-md-5">
								<div class="form-group">
									<label for="estado" class="col-form-label">Estado:&nbsp;&nbsp;</label>
									<label class="switch">
  										<input type="checkbox" lass="form-control" id="registroEstado" value="1">
  										<span class="slider"></span>
									</label>
								</div>
							</div>
							<div class="col-md-5">
							<div class="form-group">
								<label for="nivel" class="col-form-label">Nivel:</label>
								<select id="registroNivel" class="col-form-label" name="" required>
									<option value="" selected>Seleccione un nivel:</option>
									<option value="Administrador">Administrador</option>
									<option value="Supervisor">Supervisor</option>
								</select>
							</div>
							</div>
							<div class="col-md-5">
							<div class="form-group">
								<label for="imagen">Insertar una imagen:</label>
								<input type="file" id="registroImagen" accept="image/png, image/jpeg, image/jpg" name="">
						</div>
						</div>
					</div>
					<br>
					<center>
							<button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary">Registrar</button>
					</center>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- TABLA: LISTA DE USUARIOS REGISTRADORS EN EL SISTEMA -->
<table id="usuariosTabla" class="table table-striped display">	
	<!-- CABECERA TABLA -->
	<thead>
		<tr align="center">		
			<th>#</th>
			<th>Nombre Completo</th>
			<th>Correo Electrónico</th>
			<th>Fecha de nacimiento</th>
			<th>Nivel</th>
			<th>Imagen</th>
			<th>Fecha de alta</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<!-- CUERPO DE LA TABLA: DECLARAMOS CICLO FOREACH DE PHP PARA MOSTRAR LA LISTA DE USUARIOS -->
	<tbody>
		<?php foreach ($usuarios as $key => $value) : ?>
			<tr align="center">
				<td><?php echo ($key + 1); ?></td>
				<td><?php echo $value["nombre_completo"]; ?></td>
				<td><?php echo $value["correo_electronico"]; ?></td>
				<td><?php echo $value["fecha_nacimiento"]; ?></td>
				<td><?php echo $value["nivel"]; ?></td>
				<td><img src="<?php echo $value["imagen"]; ?>" width="20%" height="20%"></td>
				<td><?php echo $value["fecha_alta"]; ?></td>
				<td>
					<div class="btn-group">
						<!-- BOTON - FORMULARIO: EDITAR DATOS DE USUARIOS -->
						<div class="px-1">
							<a id_usuarios="<?php echo $value["id_usuarios"]; ?>" class="consultaDatosUsuarios btn btn-warning" title="Editar usuario" data-toggle="modal" data-target="#editarUsuariosModal" data-whatever="@mdo"><i class="fas fa-pencil-alt"></i></a>
						</div>		
						<!-- BOTON: ELIMINAR USUARIOS DEL SISTEMA -->
						<button id_usuarios="<?php echo $value["id_usuarios"]; ?>" class="eliminarUsuarios btn btn-danger" title="Eliminar usuario"><i class="fas fa-trash-alt"></i></button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<!-- FORMULARIO MODAL: EDITAR DATOS DE USUARIOS -->
<div class="modal fade" id="editarUsuariosModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuariosModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<!-- TITULO DEL MODAL -->	
			<div class="modal-header">				
				<H5 class="modal-title" id="editarUsuariosModalLabel">Editar usuario</H5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<!-- CUERPO DEL MODAL -->
			<div class="modal-body">
				<!-- INICIO DEL FORMULARIO: EDITAR DATOS DE USUARIOS -->
				<form id="formularioEditarUsuarios" onsubmit="return false;">
					<div class="form-row row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="nombre_completo" class="col-form-label">Nombre completo:</label>
								<input type="text" class="form-control" id="editarNombreCompleto" name="" required>
							</div>
						</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="correo_electronico" class="col-form-label">Correo Electronico:</label>
									<input type="email" class="form-control" id="editarCorreoElectronico" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="contrasena" class="col-form-label">Contrasena:</label>
									<input type="password" class="form-control" id="editarContrasena" name=""><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="confirmar_contrasena" class="col-form-label">Confirmar Contrasena:</label>
									<input type="password" class="form-control" id="editarConfirmarContrasena" name=""><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento:</label>
										<input type="date" class="form-control" id="editarFechaNacimiento" name="" required><br>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="fecha_alta" class="col-form-label">Fecha de alta:</label>
										<?php $fcha = date("Y-m-d");?>
										<input type="date" class="form-control"  id="editarFechaAlta"value="<?php echo $fcha;?>" readonly>
								</div>
							</div>
							<!-- SWITCH: ESTADO DEL USUARIO -->
						<!--<div class="col-md-5">
							<div class="form-group">
								<label for="estado" class="col-form-label">Estado:</label>
								<input type="text" class="form-control" id="editarEstado" name="" required>
							</div>
						</div>-->
							<div class="col-md-5">
								<div class="form-group">
									<label for="estado" class="col-form-label">Estado:&nbsp;&nbsp;</label>
									<label class="switch">
										<input type="checkbox" class="form-control" id="editarEstado">
										<span class="slider"></span>
									</label>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="nivel" class="col-form-label">Nivel:</label>
									<select type="text" id="editarNivel" class="col-form-label" name="" required>
										<option value="">Seleccione un nivel:</option>
										<option value="Administrador">Administrador</option>
										<option value="Supervisor">Supervisor</option>
									</select>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="imagen">Insertar una imagen:</label>
									<input type="file" id="editarImagen" accept="image/png, image/jpeg, image/jpg" name="" required>
								</div>
							</div>
							</div>
							<center>
								<button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Modificar</button>
							</center>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>