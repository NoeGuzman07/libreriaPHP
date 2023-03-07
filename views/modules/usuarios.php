
<?php

//Consulta de datos
$usuarios = UsuariosController::ControllerConsultaUsuarios(null, null);

?>


<div class="titulo-boton">
    <h1 class="titulo-modulo">Lista de usuarios:</h1>
    <button class="btn btn-primary">+ Registrar usuario</button>
</div>

<table class="table table-striped">
	<thead>
    <tr align="center">
			<th>#</th>
			<th>Nombre</th>
			<th>Email</th>
            <th>Fecha de nacimiento</th>
			<th>Nivel</th>
            <th>Imagen</th>
            <th>Fecha Alta</th>
			<th>Acciones</th>
		</tr>
	</thead>

	<tbody>

	<?php foreach ($usuarios as $key => $value): ?>
        <tr align="center">
			
            <td><?php echo ($key+1); ?></td>
			<td><?php echo $value["nombre_completo"]; ?></td>
			<td><?php echo $value["correo_electronico"]; ?></td>
            <td><?php echo $value["fecha_nacimiento"]; ?></td>
            <td><?php echo $value["nivel"]; ?></td>
            <td><?php echo $value["imagen"]; ?></td>
    
			<td><?php echo $value["fecha_alta"]; ?></td>
            
            <td><div class="btn-group">
			    <div class="px-1">				
			        <a href="index.php?pagina=editar&id=<?php echo $value["id_usuario"]; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
			    </div>
            </div></td>

        </tr>
		
	<?php endforeach ?>	
	
	</tbody>

</table>