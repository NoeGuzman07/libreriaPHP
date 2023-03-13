<?php

require_once "conexion.php";

class UsuariosModel extends Conexion {

	//Modelo Registro de usuarios
	static public function modelRegistroUsuarios($datosModel) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre_completo, correo_electronico, contrasena, confirmar_contrasena, fecha_nacimiento, nivel, imagen) VALUES (:nombre_completo, :correo_electronico, :contrasena, :confirmar_contrasena, :fecha_nacimiento, :nivel, :imagen)");

		$stmt->bindParam(":nombre_completo", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":correo_electronico", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":confirmar_contrasena", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datosModel, PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel, PDO::PARAM_STR);

		if ($stmt->execute()) {

            return "ok";
        
		} else {
        
			print_r(Conexion::conectar()->errorInfo());
        
		}

		//$stmt->close();
		//$stmt = null;	

	}
	
	//Modelo Consulta de datos
	static public function modelConsultaUsuarios($tabla, $item, $valor) {

		if($item == null && $valor == null){

            $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS fecha_alta FROM $tabla");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{

            $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS fecha_alta FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetch();
		}

		//$stmt->close();
		//$stmt = null;	

	}

}