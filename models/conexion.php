<?php

class Conexion{

	static public function conectar(){

		    $link = new PDO("mysql:host=localhost;dbname=plantilla","root","");

		    // $link = new PDO("mysql:host=localhost;dbname=GVM","esol123","esol2020");

			$acentos = $link->query("SET NAMES 'utf8'");

		return $link;
	}
}