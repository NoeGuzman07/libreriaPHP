<?php 

require_once "../../controllers/controller_usuarios.php";
require_once "../../models/model_usuarios.php";

class Usuarios {

    public $datosUsuarios;
    public $controllerUsuarios;

    public function funcionUsuarios() {

        $datosUsuarios = $this->datosUsuarios;
        $controllerUsuarios = $this->controllerUsuarios;

        $respuesta = UsuariosController::$controllerUsuarios($datosUsuarios);

        echo $respuesta;

    }

}

//Registro de usuarios
if(isset($_POST['registroNombreCompleto'])) {

    $datosUsuarios = array (

        "nombre_completo"=>$_POST['registroNombreCompleto'],
        "correo_electronico"=>$_POST['registroCorreoElectronico'],
        "contrasena"=>$_POST['registroContrasena'],
        "confirmar_contrasena"=>$_POST['registroConfirmarContrasena'],
        "fecha_nacimiento"=>$_POST['registroFechaNacimiento'],
        "nivel"=>$_POST['registroNivel'],
        "imagen"=>$_POST['registroImagen'],

    );

    $i = new Usuarios();
    $i ->datosUsuarios = $datosUsuarios;
    $i -> controllerUsuarios = "ControllerRegistroUsuarios";
    $i -> funcionUsuarios();

}