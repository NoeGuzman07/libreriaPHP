<?php

    class UsuariosController {
        
        static public function ControllerRegistroUsuarios($datosController) {

            if(isset($datosController["nombre_completo"])) {

                    $encriptar = crypt($datosController["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array("nombre_completo" => $datosController["nombre_completo"],
                                   "correo_electronico" => $datosController["correo_electronico"],
                                   "contrasena" => $encriptar,
                                   "confirmar_contrasena" => $datosController["confirmar_contrasena"],
                                   "fecha_nacimiento" => $datosController["fecha_nacimiento"],
                                   "nivel" => $datosController["nivel"],
                                   "imagen" => $datosController["imagen"]);

                    //Se instancia el Modelo:
                    $respuesta = UsuariosModel::modelRegistroUsuarios($datos);

                    return $respuesta;
                
            }

        }
        
        //Controller Consulta de usuarios
        static public function ControllerConsultaUsuarios ($item, $valor) {

            $tabla = "usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, $item, $valor);
            return $respuesta;

        }

    }