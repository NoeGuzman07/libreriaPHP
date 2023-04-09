<?php

    require_once "../../controllers/controller_libros.php";
    require_once "../../controllers/controller_general.php";
    require_once "../../models/model_libros.php";
    require_once "../../models/model_general.php";

    class Libros {

        //Funcion que permite llamar a los metodos definidos en la capa Controller
        public $datos;
        public $controller;
        public function funcionLibros() {
            $datos = $this->datos;
            $controller = $this->controller;
            $respuesta = LibrosController::$controller($datos);
            echo $respuesta;

        }

        //Funcion para validar Codigos de libros existentes de libros
        public $validarCodigoLibros;
	    public function ajaxValidarCodigoLibros() {
		    $item = "codigo";
		    $valor = $this->validarCodigoLibros;
		    $respuesta = LibrosController::buscarColumnaLibrosController($item, $valor);
		    echo json_encode($respuesta);
	    }

    }

    session_start();

    //Condición: Validar codigo de libro existente
    if(isset($_POST["validarCodigoLibros"])) {
        $v = new Libros();
	    $v -> validarCodigoLibros = $_POST["validarCodigoLibros"];
	    $v -> ajaxValidarCodigoLibros();
    }

    //Condicion: Registro de libros
    if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
        
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