<?php

require_once "conexion.php";

class UsuariosModel extends Conexion {

	static public function modelConsultaUsuarios($tabla, $item, $valor){

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