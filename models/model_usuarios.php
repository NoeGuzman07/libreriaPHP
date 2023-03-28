<?php

require_once "conexion.php";

class UsuariosModel extends Conexion {

	//MODELO: REGISTRO DE USUARIOS
	static public function modelRegistroUsuarios($datosModel) {
		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre_completo, correo_electronico, contrasena, confirmar_contrasena, fecha_nacimiento, nivel, imagen, estado, fecha_alta) VALUES (:nombre_completo, :correo_electronico, :contrasena, :confirmar_contrasena, :fecha_nacimiento, :nivel, :imagen, :estado, :fecha_alta)");
		$stmt->bindParam(":nombre_completo", $datosModel["nombre_completo"], PDO::PARAM_STR);
		$stmt->bindParam(":correo_electronico", $datosModel["correo_electronico"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":confirmar_contrasena", $datosModel["confirmar_contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datosModel["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datosModel["nivel"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_alta", $datosModel["fecha_alta"], PDO::PARAM_STR);
		if ($stmt->execute()) {
            return "ok";
		} else {
			print_r(Conexion::conectar()->errorInfo());
		}
		//$stmt->close();
		//$stmt = null;	
	}
	
	//MODELO: CONSULTA GENERAL DE USUARIOS Y CONSULTA PARTICULAR DE USUARIOS
	static public function modelConsultaUsuarios($tabla, $item, $valor) {

		if($item == null && $valor == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt -> fetchAll();

		} else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
			
		}

		//$stmt->close();
		//$stmt = null;	
	}

	//MODELO: EDITAR DATOS USUARIOS
	static public function modelEditarUsuarios($id, $datosModel) {
		$stmt = Conexion::conectar()->prepare("UPDATE SET nombre_completo=:nombre_completo, correo_electronico=:correo_electronico, contrasena=:contrasena, confirmar_contrasena=:confirmar_contrasena, fecha_nacimiento=:fecha_nacimiento, nivel=:nivel, imagen=:imagen WHERE id_usuarios = :id_usuarios");
		$stmt->bindParam(":nombre_completo", $datosModel["nombre_completo"], PDO::PARAM_STR);
		$stmt->bindParam(":correo_electronico", $datosModel["correo_electronico"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":confirmar_contrasena", $datosModel["confirmar_contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datosModel["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datosModel["nivel"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuarios", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
            return "ok";
		} else {
			print_r(Conexion::conectar()->errorInfo());
		}
		//$stmt->close();
		//$stmt = null;
	}

	//Modelo Eliminar usuarios del sistema
	static public function modelEliminarUsuarios($id) {
		$stmt = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE id_usuarios = :id_usuarios");
		$stmt->bindParam(":id_usuarios", $id, PDO::PARAM_INT);
		if($stmt->execute()) {
			return "ok";
		} else {
			print_r(Conexion::conectar()->errorInfo());
		}
		//$stmt->close();
		//$stmt = null;
	}

}