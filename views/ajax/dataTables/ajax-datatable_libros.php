<?php

    require_once "../../../controllers/controller_libros.php";
    require_once "../../../controllers/controller_template.php";
    require_once "../../../models/model_libros.php";

    class TablaLibros {

        /*  TABLA LIBROS  */
        public function mostrarTablaLibros() {

            date_default_timezone_set("America/Tijuana");
            session_start();

            $url = TemplateController::obtenerUrlController();

            $libros = LibrosController::consultaLibrosController();

            if(!empty($libros)) {
    
                $datosJson = '{
                  "data": [';
    
                $i = 0;
                foreach ($libros as $libro) {
                    
                    $datosJson .= '[
                        "'.++$i.'",
                        "'.$libro["id_categoria"].'",
                        "'.$libro["codigo"].'",
                        "'.$libro["nombre"].'",
                        "'.$libro["autor"].'",
                        "'.$libro["editorial"].'",
                        "'.$libro["descripcion"].'",
                        "'.$libro["precio"].'",
                        "'.$libro["stock"].'",
                        "'.$libro["fecha_alta"].'"
                      ],';
    
                }
    
                $datosJson = substr($datosJson, 0, -1);
    
                echo $datosJson;
    
            } else {
    
                echo '{
                        "data":[],
                    }';
    
            }

        }

    }

    /*  TABLA LIBROS  */
    $mostrarTablaLibros = new TablaLibros();
    $mostrarTablaLibros -> mostrarTablaLibros();
    /*  TABLA LIBROS  */