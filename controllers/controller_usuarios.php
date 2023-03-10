<?php

    class UsuariosController {
        
        //Controller Registro de usuarios
        static public function ControllerRegistroUsuarios() {

            if(isset($_POST["registroNombreCompleto"])) {

                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombreCompleto"]) &&
			       preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroCorreoElectronico"]) &&
			       preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroContrasena"])) {

                    $tabla = "usuarios";

                    $encriptar = crypt($_POST["registroContrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array("nombre_completo" => $_POST["registroNombreCompleto"],
                                   "correo_electronico" => $_POST["registroCorreoElectronico"],
                                   "contrasena" => $encriptar,
                                   "confirmar_contrasena" => $_POST["registroConfirmarContrasena"],
                                   "fecha_nacimiento" => $_POST["registroFechaNacimiento"],
                                   "nivel" => $_POST["registroNivel"],
                                   "imagen" => $_POST["registroImagen"]);

                    //Se instancia el Modelo:
                    $respuesta = UsuariosModel::modelRegistroUsuarios($tabla, $datos);

                    return $respuesta;
                
                } else {

                    $respuesta = "error";
                    return $respuesta;

                }

            }

        }
        
        //Controller Consulta de usuarios
        static public function ControllerConsultaUsuarios ($item, $valor) {

            $tabla = "usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, $item, $valor);
            return $respuesta;

        }

    }