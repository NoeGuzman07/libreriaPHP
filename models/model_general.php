<?php

require_once "conexion.php";

class GeneralModel extends Conexion{

	/* CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */
	
	static public function cambioEstadoSwitchModel($estado,$id,$tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

        $stmt -> bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){

            return 'success';

        }else{

            return 'error';
        }   

	}
	
	/* End of CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

	/* VALIDAR CAMPO */
	
	static public function validarCampoModel($valor,$columna,$tabla){

		$stmt = Conexion::conectar()->prepare("SELECT $columna FROM $tabla WHERE $columna = :$columna AND estado <> 2");

		$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		//$stmt -> close();

		//$stmt = null;

	}
	
	/* End of VALIDAR CAMPO */

	/* VALIDAR UN CAMPO EDITAR */
	
	static public function validarCampoEditarModel($valor,$columna,$tabla,$id){

		$stmt = Conexion::conectar()->prepare("SELECT $columna FROM $tabla WHERE $columna = :$columna AND estado <> 2 AND id <> :id");

		$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		//$stmt -> close();

		//$stmt = null;

	}
	
	/* End of VALIDAR UN CAMPO EDITAR */
	
	/* ELIMINAR REGISTRO */
	
	static public function eliminarRegistroModel($id,$tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 2 WHERE id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){

            return 'success';

        }else{

            return 'error';
        }   

	}
	
	/* End of ELIMINAR REGISTRO */

	/* VALIDAR CAMPO SECUNDARIO */
	
	static public function validarCampoSecundarioModel($valorPrimario,$columnaPrimario,$valorSecundario,$columnaSecundario,$tabla){

		$stmt = Conexion::conectar()->prepare("SELECT 
		$columnaPrimario,
		$columnaSecundario FROM $tabla WHERE $columnaPrimario = :$columnaPrimario AND $columnaSecundario = :$columnaSecundario AND estado <> 2");

		$stmt -> bindParam(":".$columnaPrimario, $valorPrimario, PDO::PARAM_INT);
		$stmt -> bindParam(":".$columnaSecundario, $valorSecundario, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		//$stmt -> close();

		//$stmt = null;

	}
	
	/* End of VALIDAR CAMPO SECUNDARIO */

	/* VALIDAR CAMPO SECUNDARIO EDITAR */
	
	static public function validarCampoSecundarioEditarModel($valorPrimario,$columnaPrimario,$valorSecundario,$columnaSecundario,$tabla,$id){

		$stmt = Conexion::conectar()->prepare("SELECT 
		$columnaPrimario,
		$columnaSecundario FROM $tabla WHERE $columnaPrimario = :$columnaPrimario AND $columnaSecundario = :$columnaSecundario AND estado <> 2 AND id <> :id");

		$stmt -> bindParam(":".$columnaPrimario, $valorPrimario, PDO::PARAM_INT);
		$stmt -> bindParam(":".$columnaSecundario, $valorSecundario, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		//$stmt -> close();

		//$stmt = null;

	}
	
	/* End of VALIDAR CAMPO SECUNDARIO EDITAR */

}