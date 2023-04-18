<?php

    require_once "../../controllers/controller_libros.php";
    require_once "../../controllers/controller_general.php";
    require_once "../../models/model_libros.php";
    require_once "../../models/model_general.php";

    class Libros {

        //Funcion para llamar a los metodos definidos en controller libros
        public $datos;
        public $controller;
        public function funcionLibros() {
            $datos = $this->datos;
            $controller = $this->controller;
            $respuesta = LibrosController::$controller($datos);
            echo $respuesta;

        }

    }

    session_start();

    if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
        
        if(isset($_POST['nombre_libros'])) {

            //Arreglo: Agregar libros
            $datos = array (
                "id" => isset($_POST['id_libros']) ? $_POST['id_libros'] : false,
                "id_categoria"=>$_POST['id_categoria'],
                "codigo"=>$_POST['codigo_libros'],
                "nombre"=>$_POST['nombre_libros'],
                "autor"=>$_POST['autor_libros'],
                "editorial"=>$_POST['editorial_libros'],
                "precio"=>$_POST['precio_libros'],
                "stock"=>$_POST['stock_libros'],
                "descripcion"=>$_POST['descripcion_libros'],
                "imagen"=> isset($_FILES["imagen_libros"]) ? $_FILES["imagen_libros"] : false,
            );

            $funcion = "registrarLibrosController";

        } else if(isset($_POST['id_libros_buscar'])) {
            //Instruccion para buscar un libro en particular, esto a partir de su ID
            $datos = $_POST['id_libros_buscar'];
            $funcion = "buscarLibrosController";
        } else {
            $datos = false;
        }

        if($datos) {
            $a = new Libros();
            $a -> datos = $datos;
            $a -> controller = $funcion;
            $a -> funcionLibros();
        }

    } else {
        echo "session_expired";
    }