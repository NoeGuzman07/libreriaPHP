<?php 

require_once "../../controllers/controller_usuarios.php";
require_once "../../models/model_usuarios.php";

class Usuarios {

    //Registro de usuarios
    public $datosUsuarios;
    public $controllerUsuarios;
    public function funcionUsuarios() {
        $datosUsuarios = $this->datosUsuarios;
        $controllerUsuarios = $this->controllerUsuarios;
        $respuesta = UsuariosController::$controllerUsuarios($datosUsuarios);
        echo $respuesta;
    }

    //Correo electronico existente
	/*=============================================
	VALIDAR EMAIL EXISTENTE
	=============================================*/	
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
        "imagen"=>$_POST['registroImagen'],
        "estado"=>$_POST['registroEstado'],
        "fecha_alta"=>$_POST['registroFechaAlta']

    );

    $i = new Usuarios();
    $i ->datosUsuarios = $datosUsuarios;
    $i -> controllerUsuarios = "ControllerRegistroUsuarios";
    $i -> funcionUsuarios();

}

//Correo electronico existente
/*=============================================
Objeto de AJAX que recibe la variable POST
=============================================*/

if(isset($_POST["validarCorreoElectronico"])) {

	$v = new Usuarios();
	$v -> validarCorreoElectronico = $_POST["validarCorreoElectronico"];
	$v -> ajaxValidarCorreoElectronico();

}