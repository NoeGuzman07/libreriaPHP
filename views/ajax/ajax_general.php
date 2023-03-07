<?php

require_once "../../controllers/controller_general.php";
require_once "../../models/model_general.php";

class General{

	public $datosGeneral;
	public $controllerGeneral;

	public function funcionGeneral(){

		$datosGeneral = $this->datosGeneral;
		$controllerGeneral = $this->controllerGeneral;

		$respuesta = GeneralController::$controllerGeneral($datosGeneral);

		echo $respuesta;

	}

}

session_start();

if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok'){

	/* CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

	if(isset($_POST['estadoSwitch'])){

		$datosGeneral = array(
			"estado"=>$_POST['estadoSwitch'],
			"tabla"=>$_POST['tablaSwitch'],
			"id"=>$_POST['idSwitch']
		);

		$a = new General();
		$a -> datosGeneral = $datosGeneral;
		$a -> controllerGeneral = "cambioEstadoSwitchController";
		$a -> funcionGeneral();

	}

	/* End of CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

	/* VALIDAR CAMPO */

	if(isset($_POST['valorCampo'])){

		$datosGeneral = array(
			"valor"=>$_POST['valorCampo'],
			"columna"=>$_POST['columnaCampo'],
			"tabla"=>$_POST['tablaCampo']
		);

		$b = new General();
		$b -> datosGeneral = $datosGeneral;
		$b -> controllerGeneral = "validarCampoController";
		$b -> funcionGeneral();

	}

	/* End of VALIDAR CAMPO */

	/* ELIMINAR REGISTRO */

	if(isset($_POST['idEliminar'])){

		$datosGeneral = array(
			"id"=>$_POST['idEliminar'],
			"tabla"=>$_POST['tablaEliminar']
		);

		$c = new General();
		$c -> datosGeneral = $datosGeneral;
		$c -> controllerGeneral = "eliminarRegistroController";
		$c -> funcionGeneral();

	}

	/* End of ELIMINAR REGISTRO */

	/* VALIDAR CAMPO SECUNDARIO */

	if(isset($_POST['valorCampoPrimario'])){

		$datosGeneral = array(
			"valorPrimario"=>$_POST['valorCampoPrimario'],
			"columnaPrimario"=>$_POST['columnaCampoPrimario'],
			"valorSecundario"=>$_POST['valorCampoSecundario'],
			"columnaSecundario"=>$_POST['columnaCampoSecundario'],
			"tabla"=>$_POST['tablaCampo']
		);

		$d = new General();
		$d -> datosGeneral = $datosGeneral;
		$d -> controllerGeneral = "validarCampoSecundarioController";
		$d -> funcionGeneral();

	}

	/* End of VALIDAR CAMPO SECUNDARIO */

	/* VALIDAR CAMPO EDITAR */
	
	if(isset($_POST['valorCampoEditar'])){

		$datosGeneral = array(
			"valor"=>$_POST['valorCampoEditar'],
			"columna"=>$_POST['columnaCampoEditar'],
			"id"=>$_POST['idRegistro'],
			"tabla"=>$_POST['tablaCampoEditar']
		);

		$e = new General();
		$e -> datosGeneral = $datosGeneral;
		$e -> controllerGeneral = "validarCampoEditarController";
		$e -> funcionGeneral();

	}
	
	/* End of VALIDAR CAMPO EDITAR */

	/* VALIDAR CAMPO SECUNDARIO EDITAR */

	if(isset($_POST['valorCampoPrimarioEditar'])){

		$datosGeneral = array(
			"valorPrimario"=>$_POST['valorCampoPrimarioEditar'],
			"columnaPrimario"=>$_POST['columnaCampoPrimarioEditar'],
			"valorSecundario"=>$_POST['valorCampoSecundarioEditar'],
			"columnaSecundario"=>$_POST['columnaCampoSecundarioEditar'],
			"tabla"=>$_POST['tablaCampoEditar'],
			"id"=>$_POST['idRegistro']
		);

		$d = new General();
		$d -> datosGeneral = $datosGeneral;
		$d -> controllerGeneral = "validarCampoSecundarioEditarController";
		$d -> funcionGeneral();

	}

	/* End of VALIDAR CAMPO SECUNDARIO EDITAR */

}else{
	echo "session_expired";
}

