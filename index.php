<?php

//controllers
require_once "controllers/controller_template.php";
require_once "controllers/controller_general.php";
require_once "controllers/controller_login.php";
require_once "controllers/controller_usuarios.php";
require_once "controllers/controller_libros.php";

//models
require_once "models/model_login.php";
require_once "models/model_general.php";
require_once "models/model_usuarios.php";
require_once "models/model_libros.php";

$template = new TemplateController();
$template -> template();