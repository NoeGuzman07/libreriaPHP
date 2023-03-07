<?php

class GeneralController{

	/* CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */
	
	static public function cambioEstadoSwitchController($datosController){

		$respuesta = GeneralModel::cambioEstadoSwitchModel($datosController['estado'],$datosController['id'],$datosController['tabla']);

	}
	
	/* End of CAMBIO DE ESTADO EN UN ELEMENTO SWITCH */

	/* VALIDAR UN CAMPO */
	
	static public function validarCampoController($datosController){

		$valor = $datosController['valor'];
		$columna = $datosController['columna'];
		$tabla = $datosController['tabla'];

		$respuesta = GeneralModel::validarCampoModel($valor,$columna,$tabla);

		if($respuesta){
			echo 0;
		}else{
			echo 1;
		}

	}
	
	/* End of VALIDAR UN CAMPO */

	/* VALIDAR UN CAMPO EDITAR */
	
	static public function validarCampoEditarController($datosController){

		$valor = $datosController['valor'];
		$columna = $datosController['columna'];
		$tabla = $datosController['tabla'];
		$id = $datosController['id'];

		$respuesta = GeneralModel::validarCampoEditarModel($valor,$columna,$tabla,$id);

		if($respuesta){
			echo 0;
		}else{
			echo 1;
		}

	}
	
	/* End of VALIDAR UN CAMPO EDITAR */

	/* ELIMINAR REGISTRO */
	
	static public function eliminarRegistroController($datosController){

		$respuesta = GeneralModel::eliminarRegistroModel($datosController['id'],$datosController['tabla']);

	}
	
	/* End of ELIMINAR REGISTRO */

	/* VALIDAR CAMPO SECUNDARIO */
	
	static public function validarCampoSecundarioController($datosController){

		$valorPrimario = $datosController['valorPrimario'];
		$columnaPrimario = $datosController['columnaPrimario'];
		$valorSecundario = $datosController['valorSecundario'];
		$columnaSecundario = $datosController['columnaSecundario'];
		$tabla = $datosController['tabla'];

		$respuesta = GeneralModel::validarCampoSecundarioModel($valorPrimario,$columnaPrimario,$valorSecundario,$columnaSecundario,$tabla);

		if($respuesta){
			echo 0;
		}else{
			echo 1;
		}

	}
	
	/* End of VALIDAR CAMPO SECUNDARIO */

	/* VALIDAR CAMPO SECUNDARIO EDITAR */
	
	static public function validarCampoSecundarioEditarController($datosController){

		$valorPrimario = $datosController['valorPrimario'];
		$columnaPrimario = $datosController['columnaPrimario'];
		$valorSecundario = $datosController['valorSecundario'];
		$columnaSecundario = $datosController['columnaSecundario'];
		$tabla = $datosController['tabla'];
		$id = $datosController['id'];

		$respuesta = GeneralModel::validarCampoSecundarioEditarModel($valorPrimario,$columnaPrimario,$valorSecundario,$columnaSecundario,$tabla,$id);

		if($respuesta){
			echo 0;
		}else{
			echo 1;
		}

	}
	
	/* End of VALIDAR CAMPO SECUNDARIO EDITAR */

	/* GENERAR RUTA */
	
	static public function generarRuta($cadena)
	{

		//Reemplazamos la A y a
		$cadena = str_replace(
			array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
			array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
			$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
			array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
			array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
			$cadena
		);

		//Reemplazamos la I y i
		$cadena = str_replace(
			array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
			array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
			$cadena
		);

		//Reemplazamos la O y o
		$cadena = str_replace(
			array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
			array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
			$cadena
		);

		//Reemplazamos la U y u
		$cadena = str_replace(
			array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
			array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
			$cadena
		);

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
			array('Ñ', 'ñ', 'Ç', 'ç'),
			array('N', 'n', 'C', 'c'),
			$cadena
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$cadena = str_replace(
			array(
				"¨", "º", "~", "|", "!",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "<code>", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".", " ", "#"
			),
			'-',
			$cadena
		);

		//Reemplazamos espacios
		$cadena = str_replace(
			array(' ', '_'),
			array('-', '-'),
			$cadena
		);

		return strtolower($cadena);
	}
	
	/* End of GENERAR RUTA */

	/* SUBIR IMAGEN */
	
	/**
	 *  Descripcion: Carga una imagen hacia el directorio deseado cambiando el nombre del archivo por un numero aleatorio mas el nombre ingresado. 
	 *  @param $imagen  	- Variable $_FILES con el archivo que se desea cargar.
	 *  @param $directorio 	- Nombre del directorio donde se guardara la imagen.
	 *  @param $nombre  	- Variable del nombre que se desea para la imagen, a este se le concatenara un numero aleatorio y la extensión del archivo.
	 * */
	static public function subirImagen($imagen, $directorio, $nombre){

	    $tipo      = $imagen['type']; 
	    $tmpimg    = $imagen['tmp_name'];

		if($tipo == "image/jpg" || $tipo == "image/jpeg" ){
			
			$ext = 'jpg';

		}else if($tipo == "image/png"){

			$ext = 'png';

		}
 
	    $aleatorio = mt_rand(100,999);
 
	    $nuevo_nombre = $aleatorio.'_'.$nombre.'.'.$ext;
	    $ruta = "../../views/assets/img/$directorio/$nuevo_nombre";
		$ruta_produccion = "views/assets/img/$directorio/$nuevo_nombre";
		
	 

	    if($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/png"){
	    	 
	    	 $move =  @move_uploaded_file($tmpimg, $ruta);
			 $ruta_produccion = GeneralController::convertirImagenWebp($ruta, true);
	    	 if($move){
	    		 $x =  $ruta_produccion;
	    	 }else{
				$x =  "error_img";
	    	 }
	    	  
	     }else{
	    	  
			$x =  "invalido";
	    	 
	     }

		 return $x;
		
	}
	
	/* End of SUBIR IMAGEN */

	/* CONVERTIR IMAGEN A WEBP */
	
	/**
	 * Descripcion: Convertir una imagen JPG o PNG a formato WEBP.
	* @param string $imagePath - Ruta de la imagen con ../../ al inicio de la ruta.
	* @param bool $elminar 	   - Condición para eliminar la imagen original jpg o png.
	* @return string la ruta de la imagen sin el ../../ al inicio y con el formato webp.
	*/
	static public function convertirImagenWebp($imagePath, $eliminar=false){
		$continuar = true;
		$quality = 80;
		//PNG a WEBP
		if(function_exists("imagecreatefrompng") && substr_compare($imagePath, 'png', -(strlen("png"))) === 0){
			$im = imagecreatefrompng($imagePath);
			imagepalettetotruecolor($im);
			imagealphablending($im, true);
			imagesavealpha($im, true);

			$newImagePath = str_replace("png", "webp", $imagePath);
		}else if(function_exists("imagecreatefromjpeg") && substr_compare($imagePath, 'jpg', -(strlen("jpg"))) === 0){
		//JPG A WEBP
			$im = imagecreatefromjpeg($imagePath);
			$newImagePath = str_replace("jpg", "webp", $imagePath);
		}else{
		//Si no es PNG o JPG devuelve el archivo original
			$continuar = false;
		}
		if($continuar){
			//Crear la imagen .webp
			
			imagewebp($im, $newImagePath, $quality);
			if($eliminar){
				//Eliminar la imagen original (png o jpg)
				unlink($imagePath);
			}
			//Eliminar el inicio de la nueva ruta (../../)
			$newImagePath = substr($newImagePath, "6");
		}else{
			//Eliminar el inicio de la ruta original (../../)
			$newImagePath = substr($imagePath, "6");
		}
		return $newImagePath;
	}
	
	/* End of CONVERTIR IMAGEN A WEBP */

}