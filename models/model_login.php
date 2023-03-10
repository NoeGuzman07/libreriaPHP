<?php

require_once "conexion.php";

class LoginModel extends Conexion {

	/* INGRESO */

    

    /* End of INGRESO */
    
    
    /* INGRESO */
	
	static public function ingresoModel($datosModel){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo_electronico = :correo_electronico");
        
        $stmt->bindParam(":correo_electronico", $datosModel, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
       
        //$stmt->close();

        //$stmt = null;

	}
	
	/* End of INGRESO */

}