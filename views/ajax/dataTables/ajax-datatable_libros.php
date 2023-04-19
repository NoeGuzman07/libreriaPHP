<?php

    require_once "../../../controllers/controller_libros.php";
    require_once "../../../controllers/controller_general.php";
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
                    
                    
                $checked=($libro['estado']==0) ? "checked" : "";
                
                $botones = "<a class='editar_libros' id_libros='".$libro['id']."'><button class='btn btn-icono btn-editar'></button></a>  <a class='eliminarRegistro' tabla='libros' idRegistro='".$libro['id']."'><button class='btn btn-icono btn-eliminar'></button></a>";
                
                $estado="<div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input cambioEstado' id='switch='".$libro['id']."'' idRegistro='".$libro['id']."' tabla='libros' ".$checked."><label class='custom-control-label' for='switch='".$libro['id']."''></label></div>";

                $imagen = "<td><img width='60px;' src='".$libro['imagen']."'></td>";

                $datosJson .= '[
                        "'.++$i.'",
                        "'.$botones.'",
                        "'.$estado.'",
                        "'.$imagen.'",
                        "'.$libro["codigo"].'",
                        "'.$libro["nombre"].'",
                        "'.$libro["autor"].'",
                        "'.$libro["editorial"].'",
                        "'.$libro["precio"].'",
                        "'.$libro["stock"].'",
                        "'.$libro["fecha_alta"].'"
                      ],';
    
                }
    
                $datosJson = substr($datosJson, 0, -1);

                $datosJson .= ']
                }';
    
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