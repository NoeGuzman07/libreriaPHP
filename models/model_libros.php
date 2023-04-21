<?php

    require_once "conexion.php";

    class LibrosModel extends Conexion {

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

            $stmt = Conexion::conectar()->prepare("UPDATE libros SET id_categoria=:id_categoria, codigo=:codigo, nombre=:nombre, autor=:autor, editorial=:editorial, descripcion=:descripcion, precio=:precio, stock=:stock, fecha_alta=:fecha_alta WHERE id=:id");

            $stmt -> bindParam(':id_categoria', $datos['id_categoria'],PDO::PARAM_INT);
            $stmt -> bindParam(':codigo', $datos['codigo'],PDO::PARAM_STR);
            $stmt -> bindParam(':nombre', $datos['nombre'],PDO::PARAM_STR);
            $stmt -> bindParam(':autor', $datos['autor'],PDO::PARAM_STR);
            $stmt -> bindParam(':editorial', $datos['editorial'],PDO::PARAM_STR);
            $stmt -> bindParam(':descripcion', $datos['descripcion'],PDO::PARAM_STR);
            $stmt -> bindParam(':precio', $datos['precio'],PDO::PARAM_INT);
            $stmt -> bindParam(':stock', $datos['stock'],PDO::PARAM_INT);
            $stmt -> bindParam(':fecha_alta',$datos['fecha_alta'],PDO::PARAM_STR);
            $stmt -> bindParam(':id', $datos['id'], PDO::PARAM_INT);

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
        
            $stmt = Conexion::conectar()->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");

            $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);

            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        
            $stmt = null;
        
        }

        /* End of Editar Imagen de un libro */

        /* Buscar los datos de un libro en particular a partir de su ID */

        static public function buscarLibrosModel($id) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM libros WHERE  id=:id");
            $stmt->bindParam(':id',$id, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt -> fetch();
            $stmt = null;
        }

        /* End of Buscar los datos de un libros en particular a partir de su ID */

        /* Modelo: Consulta de autores, aquí se utiliza la función Distinct para evitar mostrar autores repetidos */
        
		static public function buscarAutorLibrosModel() {

		    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT autor FROM libros");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

        /* End of Modelo: Consulta de autores utilizando la función Distinct para evitar mostrar autores repetidos */

        /* Modelo: Consulta de Editoriales, aquí se utiliza la función Distinct para evitar mostrar autores repetidos */
		static public function buscarEditorialLibrosModel() {

		    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT editorial FROM libros");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

        /* End of Modelo: Consulta de Editoriales, utilizando la función Distinct para evitar mostrar autores repetidos */

        //Modelo: Consulta de Categorias, aqui se utiliza la Tabla Categorias y la función Distinct para evitar mostrar autores repetidos
		static public function buscarCategoriaModel() {

		    $stmt = Conexion::conectar()->prepare("SELECT * FROM categoria");
			$stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

        //Modelo: Consulta de todos los libros registrados en el sistema
        static public function consultaLibrosModel() {
            $stmt = Conexion::conectar()->prepare("SELECT 
            libros.id, 
            libros.estado, 
            libros.imagen, 
            libros.codigo,
            categoria.nombre AS categoria,
            libros.nombre,
            libros.autor,
            libros.editorial,
            libros.precio,
            libros.stock,
            libros.fecha_alta 
            FROM libros 
            INNER JOIN categoria ON libros.id_categoria = categoria.id_categoria 
            WHERE libros.estado!=2");
            $stmt->execute();
			return $stmt -> fetchAll();

			//$stmt->close();
			//$stmt = null;

		}

    }