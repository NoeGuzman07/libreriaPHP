<?php

	//Consulta de datos
	$usuarios = UsuariosController::ControllerConsultaUsuarios(null, null);

?>

<div class="titulo-boton">
	<h1 class="titulo-modulo">Usuarios</h1>
</div>

<!-- Boton Modal para el registro de usuarios -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+ Registrar usuario</button><br>

<!-- Formulario Modal: Registro de usuarios -->

<br>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-lg" role="document">
		
		<div class="modal-content">
			
			<div class="modal-header">
				
				<H5 class="modal-title" id="exampleModalLabel">Registrar usuario</H5>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			
			</div>

			<div class="modal-body">

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
								<input type="datetime" class="form-control"  id="registroFechaAlta"value="<?php echo $fcha;?>" readonly>
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

<!-- Tabla de registro de usuarios -->

<table id="usuariosTabla" class="table table-striped display">
	
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

						<div class="px-1">
							<a href="index.php?pagina=editar&id=<?php echo $value["id_usuarios"]; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
						</div>

						<form method="POST">

							<input type="hidden" value="<?php echo $value["id_usuarios"]; ?>" name="eliminarUsuario">

							<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

							<?php

							//$eliminar = new ControladorFormularios();
							//$eliminar -> ctrEliminarRegistro();

							?>

						</form>

					</div> <br>

				</td>

			</tr>

		<?php endforeach ?>

	</tbody>

</table>