<?php

class LoginController{

	/* INGRESO */
	
	static public function ingresoController($datosController){

		$encriptar = crypt($datosController['contrasena'],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$respuesta = LoginModel::ingresoModel($datosController["correo_electronico"]);

		if($respuesta) {
			
			//usuario correcto

			if(strtoupper($respuesta['correo_electronico']) == strtoupper($datosController['correo_electronico']) && $respuesta['contrasena'] == $encriptar){
				
				//usuario y contraseña validos

				if($respuesta['estado'] == 0) {
					
					//usuario activo

					//variables de sesión

					session_start();
					$_SESSION['iniciarSesion'] = "ok";
					$_SESSION['id_usuarios'] = $respuesta['id_usuarios'];
					$_SESSION['nivel'] = $respuesta['nivel'];
					$_SESSION['nombre_completo'] = $respuesta['nombre_completo'];
					$_SESSION['imagen'] = $respuesta['imagen'];
					
						echo 'dashboard';

				}else{

					//usuario desactivado

					echo 'desactivado';
				}

			}else{

				//usuario o contraseña invalidos

				echo 'invalido';
			}

		}else{

			//usuario incorrecto

			echo 'invalido';
		}

	}
	
	/* End of INGRESO */	

}