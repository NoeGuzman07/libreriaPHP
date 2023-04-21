<?php

    class LibrosController {

    /* Función para validar un Libro y agregarlo a la base de datos */
    static public function registrarLibrosController($datos) {

        date_default_timezone_set("America/Tijuana");

        //Verificación de ID existente
        if($datos['id']) {

            //Si se encuentra el ID, se realizará cambios del libro en la base de datos
            // Y se actualiza la fecha actual
            $datos['fecha_alta']= date("Y-m-d H:i:s");
            LibrosModel::editarLibrosModel($datos);
        
        } else {
        
            //Cuando No se encuentra un ID, se realizará el registro del libro en la base de datos
            $datos['id_alta'] = $_SESSION['id_usuarios'];
            $datos['fecha_alta']= date("Y-m-d H:i:s");
            $datos['id'] = LibrosModel::insertarLibrosModel($datos);
        
        }
        
        //Buscamos al libro para obtener el nombre del archivo de la imagen actual
        $libros = LibrosModel::buscarLibrosModel($datos['id']);
        
        if($datos['imagen']) {
            //Si se encuentra la imagen, verificamos si existe la imagen para poder eliminarla-remplazarla
            if($libros['imagen']!=""&&file_exists("../../".$libros['imagen'])&&$libros['imagen']!="views/assets/img/usuario_default.png") unlink("../../".$libros['imagen']);
            //Procedemos a almacenar la imagen al servidor
            $nombre_imagen = "imagen_libros_".$datos['id'];
            $datos['imagen'] = GeneralController::subirImagen($datos['imagen'],"libros",$nombre_imagen);
            //Procedemos al editar la imagen del libro
            LibrosModel::editarImagenLibrosModel($datos);
        }
        return "success";
    }

    /* Buscar un libro en particular */
    /* Realizamos la busqueda de un libro en particular utilizando su ID */
    /* Esta función se utiliza en el Ajax de libros al momento de registrar un libro */

    static public function buscarLibrosController($id) {

        return json_encode(LibrosModel::buscarLibrosModel($id));

    }

    /* Consula de Todos los libros registrados en el sistema */
    static public function consultaLibrosController() {
        $respuesta = LibrosModel::consultaLibrosModel();
        return $respuesta;

    }

    /* Consulta de Autores existentes en la tabla libros */
    static public function buscarAutorLibrosController() {

        $respuesta = LibrosModel::buscarAutorLibrosModel();
        return $respuesta;

    }

    /* Consulta de Editoriales en la tabla libros */
    static public function buscarEditorialLibrosController() {

        $respuesta = LibrosModel::buscarEditorialLibrosModel();
        return $respuesta;

    }

    /* Consulta de Categorias en la tabla categoría */
    static public function buscarCategoriaController() {

        $tabla="categoria";
        $respuesta = LibrosModel::buscarCategoriaModel();
        return $respuesta;

    }

}