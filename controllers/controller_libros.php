<?php

    class LibrosController {

    /* MOSTRAR LIBROS */
    /* Funcion para obtener los libros de la base de datos */
    
    static public function obtenerLibrosController(){
        return LibrosModel::obtenerLibrosModel();
    }

    /* MOSTRAR LIBROS */

    /* REGISTRAR LIBROS */
    /* Funcion para validar un LIBRO y registrarlo en la base de datos */

    static public function insertarLibrosController($datos) {

        //VERIFICACION DE ID EXISTENTE
        if($datos['id_libros']) {

            //REGISTRAMOS LOS CAMBIOS EN LA BASE DE DATOS
            LibrosController::editarLibrosController($datos);

        } else {

            //REALIZAMOS EL REGISTRO DEL LIBRO EN LA BASE DE DATOS
            $datos['id_libros'] = LibrosModel::insertarLibrosModel($datos);

        }

        //BUSCAMOS AL LIBRO PARA OBTENER EL NOMBRE DEL ARCHIVO DE LA IMAGEN ACTUAL
        $libros = LibrosModel::buscarLibrosModel($datos['id_libros']);

        if($datos['imagen']){
        
            //VERIFICAMOS SI LA IMAGEN DEL LIBRO EXISTE PARA PODER ELIMINARLA
            if($libros['imagen']!=""&&file_exists("../../".$libros['imagen'])&&$libros['imagen']!="views/assets/img/usuario_default.png") unlink("../../".$libros['imagen']);

            //PROCEDEMOS A ALMACENAR LA IMAGEN AL SERVIDOR
            $nombre_imagen = "imagen_libros_".$datos['id_libros'];
            $datos['imagen'] = GeneralController::subirImagen($datos['imagen'],"libros",$nombre_imagen);

            //PROCEDEMOS A EDITAR LA IMAGEN DEL LIBRO
            LibrosModel::editarImagenLibrosModel($datos);
        
        }

        return "success";

    }

    /* REGISTRAR LIBROS */

    /* BUSCAR UN LIBRO EN PARTICULAR */
    /* REALIZAMOS LA BUSQUEDA DE UN LIBRO EN PARTICULAR EN LA BASE DE DATOS CON SU ID */

    static public function buscarLibrosController($id_libros) {

        return json_encode(LibrosModel::buscarLibrosController($id_libros));

    }
    
    /* BUSCAR UN LIBRO EN PARTICULAR */

}