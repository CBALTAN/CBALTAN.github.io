<?php

require_once("conexion.php");
Class consoleusuario
{
	public function obtenerTodo()
	{
		$con=new conexion;
		$resultados=$con->consultar("consoleusuario");
		$con=null;
		return $resultados;
	}

	public function insertar($datos)
	{
		$con=new conexion;
		$mensaje=$con->insertar("consoleusuario",$datos);
		$con=null;
		return $mensaje;
	}
	public function consultarusuario($filtro)
	{
		$con=new conexion;
		$datos=$con->consultaFiltro("consoleusuario",$filtro);
		$con=null;
		return $datos;
	}	
	
}

?>