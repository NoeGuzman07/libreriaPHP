<?php

    class LibrosController {

    /* Funcion para validar un Libro y agregarlo a la base de datos */
    static public function insertarLibrosController($datos) {
        //Verificacion de ID existente
        if($datos['id_libros']) {
            //Si se encuentra el ID, se realizara cambios del libro en la base de datos
            LibrosController::editarLibrosController($datos);
        } else {
            //Cuando No se encuentra un ID, se realizara el registro del libro en la base de datos
            $datos['id_alta'] = $_SESSION['id_usuarios'];
            $datos['fecha_alta']= date("Y-m-d H:i:s");
            $datos['id_libros'] = LibrosModel::insertarLibrosModel($datos);
        }
        //Buscamos al libro para obtener el nombre del archivo de la imagen actual
        $libros = LibrosModel::buscarLibrosModel($datos['id_libros']);
        if($datos['imagen']) {
            //Si se encuentra la imagen, verificamos si existe la imagen para poder eliminarla-remplazarla
            if($libros['imagen']!=""&&file_exists("../../".$libros['imagen'])&&$libros['imagen']!="views/assets/img/usuario_default.png") unlink("../../".$libros['imagen']);
            //Procedemos a almacenar la imagen al servidor
            $nombre_imagen = "imagen_libros_".$datos['id_libros'];
            $datos['imagen'] = GeneralController::subirImagen($datos['imagen'],"libros",$nombre_imagen);
            //Procedemos al editar la imagen del libro
            LibrosModel::editarImagenLibrosModel($datos);
        }
        return "success";
    }

    /* Buscar un libro en particular */
    /* Realizamos la busqueda de un libro en particular utilizando su ID */

    static public function buscarLibrosController($id_libros) {

        return json_encode(LibrosModel::buscarLibrosController($id_libros));

    }
    
    /* Consulta de codigos y de cualquier columna de la tabla libros */
    //Enviamos a Model como parametros el nombre de la tabla, columna y su valor
    static public function buscarColumnaLibrosController($item, $valor) {

        $tabla="libros";
        $respuesta = LibrosModel::buscarColumnaLibrosModel($tabla, $item, $valor);
        return $respuesta;

    }

    /* Consulta de autores existentes en la tabla libros */
    static public function buscarAutorLibrosController($item, $valor) {

        $tabla="libros";
        $respuesta = LibrosModel::buscarAutorLibrosModel($tabla, $item, $valor);
        return $respuesta;

    }

    /* Consulta de editoriales en la tabla libros */
    static public function buscarEditorialLibrosController($item, $valor) {

        $tabla="libros";
        $respuesta = LibrosModel::buscarEditorialLibrosModel($tabla, $item, $valor);
        return $respuesta;

    }

    /* Consulta de categorias en la tabla categoria */
    static public function buscarCategoriaController($item, $valor) {

        $tabla="categoria";
        $respuesta = LibrosModel::buscarCategoriaModel($tabla, $item, $valor);
        return $respuesta;

    }

}