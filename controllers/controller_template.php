<?php

class TemplateController{

	/* LLAMADA A LA PLANTILLA */
	
	static public function template(){

		include "views/template.php";

	}
	
	/* End of LLAMADA A LA PLANTILLA */

	/* URL DEL PROYECTO */
	
	static public function obtenerUrlController(){

		return "http://localhost/libreriaPHP/";

	}
	
	/* End of URL DEL PROYECTO */
	
}