<?php

    require_once "../../controllers/controller_libros.php";
    require_once "../../controllers/controller_general.php";
    require_once "../../models/model_libros.php";
    require_once "../../models/model_general.php";

    class Libros {

        //FUNCION QUE PERMITE LLAMAR A LOS METODOS DEFINIDOS EN CONTROLLER
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

        //CONDICION-PETICION: REGISTRO DE LIBROS
        if(isset($_POST['nombre_libros'])) {

            $datos = array (
                "id_libros" => isset($_POST['id_libros']) ? $_POST['id_libros'] : false,
                "categoria"=>$_POST['categoria_libros'],
                "codigo"=>$_POST['codigo_libros'],
                "nombre_libros"=>$_POST['nombre_libros'],
                "autor"=>$_POST['autor_libros'],
                "editorial"=>$_POST['editorial_libros'],
                "precio"=>$_POST['precio_libros'],
                "stock_actual"=>$_POST['stock_actual_libros'],
                "descripcion"=>$_POST['descripcion_libros'],
                "imagen"=> isset($_FILES["imagen_libros"]) ? $_FILES["imagen_libros"] : false,
            );

            $funcion = "insertarLibrosController";

        } else if(isset($_POST['id_libros_buscar'])) {

            //INSTRUCCION PARA BUSCAR UN LIBRO EN PARTICULAR A PARTIR DE SU ID
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