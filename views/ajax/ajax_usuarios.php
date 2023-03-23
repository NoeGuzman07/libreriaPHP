<?php 

require_once "../../controllers/controller_usuarios.php";
require_once "../../models/model_usuarios.php";
require_once "../../controllers/controller_general.php";

class Usuarios {

    //Registro de usuarios
    //Funcion que permite llamar metodos del controlador, se puede utilizar para los demas metodos de un sistema CRUD
    public $datosUsuarios;
    public $controllerUsuarios;
    public function funcionUsuarios() {
        $datosUsuarios = $this->datosUsuarios;
        $controllerUsuarios = $this->controllerUsuarios;
        $respuesta = UsuariosController::$controllerUsuarios($datosUsuarios);
        echo $respuesta;
    }

    //Validar Correo electronico existente
	public $validarCorreoElectronico;
	public function ajaxValidarCorreoElectronico() {
		$item = "correo_electronico";
		$valor = $this->validarCorreoElectronico;
		$respuesta = UsuariosController::ControllerConsultaUsuarios($item, $valor);
		echo json_encode($respuesta);
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
        "imagen"=>$_FILES['registroImagen'],
        "estado"=>$_POST['registroEstado'],
        "fecha_alta"=>$_POST['registroFechaAlta']
    );

    $i = new Usuarios();
    $i ->datosUsuarios = $datosUsuarios;
    $i -> controllerUsuarios = "ControllerRegistroUsuarios";
    $i -> funcionUsuarios();

}

//Ajax Eliminar usuarios del sistema
if(isset($_POST['id_usuarios'])) {

    $datosUsuarios = $_POST['id_usuarios'];

    $i = new Usuarios();
    $i -> datosUsuarios = $datosUsuarios;
    $i -> controllerUsuarios = "ControllerEliminarUsuarios";
    $i -> funcionUsuarios();

}

//Correo electronico existente
//Objeto de AJAX que recibe la variable POST
if(isset($_POST["validarCorreoElectronico"])) {

	$v = new Usuarios();
	$v -> validarCorreoElectronico = $_POST["validarCorreoElectronico"];
	$v -> ajaxValidarCorreoElectronico();

}