<?php

    class UsuariosController {
        
        static public function ControllerRegistroUsuarios($datosController) {

            //Controller Registro de usuarios
            //var_dump($datosController);
            
            if(isset($datosController["nombre_completo"])) {

                    $encriptarContrasena = crypt($datosController["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    $encriptarConfirmarContrasena = crypt($datosController["confirmar_contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    
                    $datos = array ("nombre_completo" => $datosController["nombre_completo"],
                                    "correo_electronico" => $datosController["correo_electronico"],
                                    "contrasena" => $encriptarContrasena,
                                    "confirmar_contrasena" => $encriptarConfirmarContrasena,
                                    "fecha_nacimiento" => $datosController["fecha_nacimiento"],
                                    "nivel" => $datosController["nivel"],
                                    "imagen" => $datosController["imagen"],
                                    "estado" => $datosController["estado"],
                                    "fecha_alta" => $datosController["fecha_alta"]);

                     $respuesta = UsuariosModel::modelRegistroUsuarios($datos);

                    if($respuesta) {

                        echo 'usuarios';

                    } else {

                        echo 'error';

                    }
                
            } else {

                echo 'error';

            }

        }
        
        //Controller Consulta de usuarios
        static public function ControllerConsultaUsuarios ($item, $valor) {

            $tabla = "usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, $item, $valor);
            return $respuesta;

        }

        //Controller Eliminar usuarios
        static public function ControllerEliminarUsuarios($datosController) {

            //var_dump($datosController);

            return UsuariosModel::modelEliminarUsuarios($datosController);

    
        }

    }