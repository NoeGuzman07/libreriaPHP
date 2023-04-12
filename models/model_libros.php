<?php

    require_once "conexion.php";

    class LibrosModel extends Conexion {

        /* Obtener libros se consulta a todos los datos de la base de datos */

        static public function obtenerLibrosModel() {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll();
            $stmt = null;
        }

        /* End of Obtener libros */

        /* Agregar libros */

        static public function insertarLibrosModel($datos) {

            $conexion = Conexion::conectar();
            
            $stmt = $conexion->prepare("INSERT INTO libros(id_categoria, codigo, nombre, autor, editorial, descripcion, precio, imagen, stock, id_alta, fecha_alta) VALUES (:id_categoria, :codigo, :nombre, :autor, :editorial, :descripcion, :precio, 'views/assets/img/usuario_default.png', :stock, :id_alta, :fecha_alta)");

            $stmt -> bindParam(':id_categoria', $datos['id_categoria'],PDO::PARAM_INT);
            $stmt -> bindParam(':codigo', $datos['codigo'],PDO::PARAM_STR);
            $stmt -> bindParam(':nombre', $datos['nombre'],PDO::PARAM_STR);
            $stmt -> bindParam(':autor', $datos['autor'],PDO::PARAM_STR);
            $stmt -> bindParam(':editorial', $datos['editorial'],PDO::PARAM_STR);
            $stmt -> bindParam(':descripcion', $datos['descripcion'],PDO::PARAM_STR);
            $stmt -> bindParam(':precio', $datos['precio'],PDO::PARAM_INT);
            $stmt -> bindParam(':stock', $datos['stock'],PDO::PARAM_INT);
            $stmt -> bindParam(':id_alta',$datos['id_alta'],PDO::PARAM_INT);
            $stmt -> bindParam(':fecha_alta',$datos['fecha_alta'],PDO::PARAM_STR); 

            if($stmt->execute()) {
                return $conexion-> lastInsertId();
            }else{
                return "error";
            }
            $stmt = null;

        }

        /* End of Agregar libros */

        /* Editar libros */

        static public function editarLibrosModel($datos) {

            $stmt = Conexion::conectar()->prepare("UPDATE libros SET id_categoria=:id_categoria, codigo=:codigo, nombre=:nombre, autor=:autor, editorial=:editorial, precio=:precio, stock_actual=:stock_actual, descripcion=:descripcion WHERE id_libros=:id_libros");

            $stmt -> bindParam(':id_categoria', $datos['id_categoria'],PDO::PARAM_STR);
            $stmt -> bindParam(':codigo', $datos['codigo'],PDO::PARAM_STR);
            $stmt -> bindParam(':nombre', $datos['nombre'],PDO::PARAM_STR);
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

        /* End of Editar Libros */

        /* Editar imagen de un libro */

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

        /* End of Editar Imagen de un libro */

        /* Buscar los datos de un libro en particular a partir de su ID */

        static public function buscarLibrosModel($id_libros) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM libros WHERE  id_libros=:id_libros");

            $stmt->bindParam(':id_libros',$id_libros, PDO::PARAM_INT);

            $stmt -> execute();
    
            return $stmt -> fetch();
    
            $stmt = null;

        }

        /* End of Buscar los datos de un libros en particular a partir de su ID */

        //Consulta de cualquier columna de la tabla libros
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

        //Modelo: Consulta de autores, aqui se utiliza la funcion Distinct para evitar mostrar autores repetidos
		static public function buscarAutorLibrosModel($tabla, $item, $valor) {

		    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT autor FROM $tabla");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

        //Modelo: Consulta de Editoriales, aqui se utiliza la funcion Distinct para evitar mostrar autores repetidos
		static public function buscarEditorialLibrosModel($tabla, $item, $valor) {

		    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT editorial FROM $tabla");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

        //Modelo: Consulta de Categorias, aqui se utiliza la Tabla Categorias y la función Distinct para evitar mostrar autores repetidos
		static public function buscarCategoriaModel($tabla, $item, $valor) {

		    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

    }