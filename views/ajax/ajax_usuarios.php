<?php

    require_once "../../controllers/controller_usuarios.php";
    require_once "../../models/model_usuarios.php";
    require_once "../../controllers/controller_general.php";

    class Usuarios {

        //FUNCION QUE AYUDA A LLAMAR A LOS METODOS DE CONTROLLER
        public $datosUsuarios;
        public $controllerUsuarios;        
        public function funcionUsuarios() {
            $datosUsuarios = $this->datosUsuarios;
            $controllerUsuarios = $this->controllerUsuarios;
            $respuesta = UsuariosController::$controllerUsuarios($datosUsuarios);
            //echo json_encode($respuesta);
            echo $respuesta;
        }

        //FUNCION PARA VALIDAR CORREO ELECTRONICO EXISTENTE
        public $validarCorreoElectronico;
	    public function ajaxValidarCorreoElectronico() {
		    $item = "correo_electronico";
		    $valor = $this->validarCorreoElectronico;
		    $respuesta = UsuariosController::ControllerConsultaGeneralUsuarios($item, $valor);
		    echo json_encode($respuesta);
	    }

    }

    //CONDICION: VALIDAR CORREO EXISTENTE
    if(isset($_POST["validarCorreoElectronico"])) {
        $v = new Usuarios();
	    $v -> validarCorreoElectronico = $_POST["validarCorreoElectronico"];
	    $v -> ajaxValidarCorreoElectronico();
    }

    //CONDICION: REGISTRO DE USUARIOS
    if(isset($_POST['registroNombreCompleto'])) {
        
        $datosUsuarios = array (
            "nombre_completo"=>$_POST['registroNombreCompleto'],
            "correo_electronico"=>$_POST['registroCorreoElectronico'],
            "contrasena"=>$_POST['registroContrasena'],
            "confirmar_contrasena"=>$_POST['registroConfirmarContrasena'],
            "fecha_nacimiento"=>$_POST['registroFechaNacimiento'],
            "nivel"=>$_POST['registroNivel'],
            "imagen"=>$_FILES['registroImagen'],
            "estado"=>$_POST['registroEstado'],
            "fecha_alta"=>$_POST['registroFechaAlta']
        );

        $i = new Usuarios();
        $i ->datosUsuarios = $datosUsuarios;
        $i -> controllerUsuarios = "ControllerRegistroUsuarios";
        $i -> funcionUsuarios();

    }

    //CONDICION: CONSULTA PARTICULAR DE DATOS SE ENVIA ID COMO PARAMETRO A CONTROLLER
    if(isset($_POST['id_usuarios_consultar'])) {

        $datosUsuarios = $_POST['id_usuarios_consultar'];

        $i = new Usuarios();
        $i ->datosUsuarios = $datosUsuarios;
        $i -> controllerUsuarios = "ControllerConsultaUsuarios";
        $i -> funcionUsuarios();

    }

    //CONDICION: EDITAR USUARIOS
    if(isset($_POST['editarNombreCompleto'])) {

        $datosUsuarios = array (
            "id_usuarios"=>$_POST['id_usuarios_editar'],
            "nombre_completo"=>$_POST['editarNombreCompleto'],
            "correo_electronico"=>$_POST['editarCorreoElectronico'],
            "contrasena"=>$_POST['editarContrasena'],
            "contrasena_actual"=>$_POST['contrasenaActual'],
            "confirmar_contrasena"=>$_POST['contrasenaActual'],
            "fecha_nacimiento"=>$_POST['editarFechaNacimiento'],
            "nivel"=>$_POST['editarNivel'],
            "imagen"=>isset($_FILES['editarImagen']) ? $_FILES['editarImagen'] : null,
            "imagen_actual"=>$_POST['imagenActual'],
            "estado"=>$_POST['editarEstado'],
            "fecha_alta"=>$_POST['editarFechaAlta']
        );

        $b = new Usuarios();
        $b ->datosUsuarios = $datosUsuarios;
        $b -> controllerUsuarios = "ControllerEditarUsuarios";
        $b -> funcionUsuarios();

    }

    //CONDICION: ELIMINAR USUARIOS, SE UTILIZA EL ID Y SE ENVIA A CONTROLLER
    if(isset($_POST['id_usuarios_eliminar'])) {

        $datosUsuarios = $_POST['id_usuarios_eliminar'];

        $i = new Usuarios();
        $i -> datosUsuarios = $datosUsuarios;
        $i -> controllerUsuarios = "ControllerEliminarUsuarios";
        $i -> funcionUsuarios();

    }