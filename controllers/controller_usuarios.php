<?php 

    class UsuariosController {

        //Consulta de datos
        static public function ControllerConsultaUsuarios ($item, $valor) {

            $tabla = "usuarios";
            $respuesta = UsuariosModel::modelConsultaUsuarios($tabla, $item, $valor);
            return $respuesta;

        }

    }