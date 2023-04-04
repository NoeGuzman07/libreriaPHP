<?php

    class UsuariosController {
        
        //CONTROLLER: REGISTRO DE USUARIOS
        static public function ControllerRegistroUsuarios($datosController) {

            if(isset($datosController["nombre_completo"])) {

                $encriptarContrasena = crypt($datosController["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $encriptarConfirmarContrasena = crypt($datosController["confirmar_contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    
                $datos = array ("nombre_completo" => $datosController["nombre_completo"],
                                "correo_electronico" => $datosController["correo_electronico"],
                                "contrasena" => $encriptarContrasena,
                                "confirmar_contrasena" => $encriptarConfirmarContrasena,
                                "fecha_nacimiento" => $datosController["fecha_nacimiento"],
                                "nivel" => $datosController["nivel"],
                                "imagen" => GeneralController::subirImagen($datosController["imagen"], "usuarios_imagenes", "usuarios"),
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

        //CONTROLLER: CONSULTA GENERAL DE USUARIOS
        static public function ControllerConsultaGeneralUsuarios($item, $valor) {

            $tabla="usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, $item, $valor);
            return $respuesta;

        }
        
        //CONTROLLER: CONSULTA PARTICULAR DE DATOS DE USUARIOS
        static public function ControllerConsultaUsuarios ($id_usuarios) {

            $tabla = "usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, "id_usuarios", $id_usuarios);
            return json_encode($respuesta);

        }

        //CONTROLLER: EDITAR USUARIOS
        static public function ControllerEditarUsuarios($datosController) {

            if(isset($datosController["nombre_completo"])) {

                $tabla = "usuarios";

                    if($datosController["contrasena"]!="") {
                        
                        $editarContrasena = crypt($datosController["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                        $editarConfirmarContrasena = crypt($datosController["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');    
                    
                    } else {

                        //Establecer instruccion para mandar la contrasena anterior, esto
                        //en caso de que el usuario deje vacio al campo de la contrasena.
                        $editarContrasena = $datosController["contrasena_actual"];
                        $editarConfirmarContrasena = $datosController["contrasena_actual"];

                    }

                    if($datosController["imagen"]!="") {
                        $editarImagen = GeneralController::subirImagen($datosController["imagen"], "usuarios_imagenes", "usuarios");
                    } else {
                        $editarImagen = $datosController["imagen_actual"];
                    }

                    $datos = array ("id_usuarios" => $datosController["id_usuarios"],
                                    "nombre_completo" => $datosController["nombre_completo"],
                                    "correo_electronico" => $datosController["correo_electronico"],
                                    "contrasena" => $editarContrasena,
                                    "confirmar_contrasena" => $editarConfirmarContrasena,
                                    "fecha_nacimiento" => $datosController["fecha_nacimiento"],
                                    "nivel" => $datosController["nivel"],
                                    "imagen" => $editarImagen,
                                    "estado" => $datosController["estado"],
                                    "fecha_alta" => $datosController["fecha_alta"]);

                    $respuesta = UsuariosModel::modelEditarUsuarios($tabla, $datos);

                    if($respuesta) {
                        echo 'usuarios';
                    } else {
                        echo 'error';
                    }

            } else {
                echo 'error';
            }

        }

        //CONTROLLER: ELIMINAR USUARIOS
        static public function ControllerEliminarUsuarios($datosController) {
            
            return UsuariosModel::modelEliminarUsuarios($datosController);

        }

    }