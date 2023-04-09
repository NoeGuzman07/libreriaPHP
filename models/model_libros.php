<?php

    require_once "conexion.php";

    class LibrosModel extends Conexion {

        /* OBTENER LIBROS */

        static public function obtenerLibrosModel() {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll();
            $stmt = null;
        }

        /* OBTENER LIBROS */

        /* INSERTAR-REGISTRAR LIBROS */

        static public function insertarLibrosModel($datos) {

            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("INSERT INTO libros(categoria, codigo, nombre_libros, autor, editorial, precio, stock_actual, descripcion, imagen) VALUES (:categoria, :codigo, :nombre_libros, :autor, :editorial, :precio, :stock_actual, :descripcion, 'views/assets/img/usuario_default.png') ");

            $stmt -> bindParam(':categoria', $datos['categoria'],PDO::PARAM_STR);
            $stmt -> bindParam(':codigo', $datos['codigo'],PDO::PARAM_STR);
            $stmt -> bindParam(':nombre_libros', $datos['nombre_libros'],PDO::PARAM_STR);
            $stmt -> bindParam(':autor', $datos['autor'],PDO::PARAM_STR);
            $stmt -> bindParam(':editorial', $datos['editorial'],PDO::PARAM_STR);
            $stmt -> bindParam(':precio', $datos['precio'],PDO::PARAM_INT);
            $stmt -> bindParam(':stock_actual', $datos['stock_actual'],PDO::PARAM_INT);
            $stmt -> bindParam(':descripcion', $datos['descripcion'],PDO::PARAM_STR);

            if($stmt->execute()){
                return $conexion-> lastInsertId();
            }else{
                return "error";
            }
            $stmt = null;

        }

        /* INSERTAR-REGISTRAR LIBROS */

        /* EDITAR LIBRO */

        static public function editarLibrosModel($datos) {

            $stmt = Conexion::conectar()->prepare("UPDATE libros SET categoria=:categoria, codigo=:codigo, nombre_libros=:nombre_libros, autor=:autor, editorial=:editorial, precio=:precio, stock_actual=:stock_actual, descripcion=:descripcion WHERE id_libros=:id_libros");

            $stmt -> bindParam(':categoria', $datos['categoria'],PDO::PARAM_STR);
            $stmt -> bindParam(':codigo', $datos['codigo'],PDO::PARAM_STR);
            $stmt -> bindParam(':nombre_libros', $datos['nombre_libros'],PDO::PARAM_STR);
            $stmt -> bindParam(':autor', $datos['autor'],PDO::PARAM_STR);
            $stmt -> bindParam(':editorial', $datos['editorial'],PDO::PARAM_STR);
            $stmt -> bindParam(':precio', $datos['precio'],PDO::PARAM_INT);
            $stmt -> bindParam(':stock_actual', $datos['stock_actual'],PDO::PARAM_INT);
            $stmt -> bindParam(':descripcion', $datos['descripcion'],PDO::PARAM_STR);

            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        
            $stmt = null;

        }

        /* EDITAR LIBRO */

        /* EDITAR IMAGEN LIBRO */

        static public function editarImagenLibrosModel($datos) {
        
            $stmt = Conexion::conectar()->prepare("UPDATE libros SET imagen=:imagen WHERE id_libros=:id_libros");

            $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
            $stmt->bindParam(":id_libros", $datos['id_libros'], PDO::PARAM_INT);

            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        
            $stmt = null;
        
        }

        /* EDITAR IMAGEN LIBRO */

        /* BUSCAR UN LIBRO EN PARTICULAR */

        static public function buscarLibrosModel($id_libros) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM libros WHERE  id_libros=:id_libros");

            $stmt->bindParam(':id_libros',$id_libros, PDO::PARAM_INT);

            $stmt -> execute();
    
            return $stmt -> fetch();
    
            $stmt = null;

        }

        /* BUSCAR UN LIBRO EN PARTICULAR */

        //MODELO: CONSULTA DE CUALQUIER COLUMNA DE LA TABLA LIBROS EN LA BASE DE DATOS
		static public function buscarColumnaLibrosModel($tabla, $item, $valor) {

			if($item == null && $valor == null) {
            	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt -> fetchAll();
			} else {
            	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetch();
			}

			//$stmt->close();
			//$stmt = null;

		}

    }