<?php

class Conexion
{
	private $usuario = "root";
	private $pass = "";
	private $dbcon = null;
	private $dns = "mysql:host=localhost:3306;dbname=proyectofinal";
	private $error = null;

	private function conectar()
	{
		try {
			$this->dbcon = new PDO($this->dns, $this->usuario, $this->pass);
			$this->dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return true;
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
			return false;
		}
	}

	public function consultar($tabla)
	{
		try {
			if (!$this->conectar()) {
				return "No conecta: " . $this->error;
				exit;
			}

			$query = "SELECT * FROM $tabla";
			$result_set = $this->dbcon->prepare($query);
			$result_set->execute();
			$resultados = $result_set->fetchAll();
			return $resultados;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function consultaFiltro($tabla, $filtro)
	{
		try {
			if (!$this->conectar()) {
				return "No conecta: " . $this->error;
				exit;
			}
			$query = "SELECT * FROM $tabla WHERE ";
			foreach ($filtro as $clave => $valor) {
				$query .= "$clave = :$clave AND ";
			}
			$query = substr($query, 0, strlen($query) - 5); // Cambiado de -4 a -5
			$result_set = $this->dbcon->prepare($query);
			foreach ($filtro as $clave => $valor) {
				$clave = ":" . $clave; // Corregido = a =>
				$result_set->bindValue($clave, $valor);
			}
			$result_set->execute();
			$resultados = $result_set->fetchAll();
			return $resultados;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function insertar($tabla, $datos)
	{
		try {
			if (!$this->conectar()) {
				return "No conecta: " . $this->error;
				exit;
			}
			$sentencia = "INSERT INTO $tabla (";
			foreach ($datos as $clave => $valor) {
				$sentencia .= "$clave,";
			}
			$sentencia = substr($sentencia, 0, strlen($sentencia) - 1) . ") VALUES (";
			foreach ($datos as $clave => $valor) {
				$sentencia .= ":$clave,";
			}
			$sentencia = substr($sentencia, 0, strlen($sentencia) - 1) . ")";
			$st = $this->dbcon->prepare($sentencia);
			foreach ($datos as $clave => $valor) {
				$clave = ":" . $clave;
				$st->bindValue($clave, $valor);
			}
			$st->execute(); 
			return "Registro guardado...";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function eliminarTodo($tabla)
	{
    try {
        if (!$this->conectar()) {
            return "No conecta: " . $this->error;
        }

        $sql = "DELETE FROM $tabla";
        $stmt = $this->dbcon->prepare($sql);
        if ($stmt->execute()) {
            return "Eliminación exitosa";
        } else {
            return "Error al intentar eliminar todo";
        }
    } catch (Exception $e) {
        return $e->getMessage();
    	}
	}


}
