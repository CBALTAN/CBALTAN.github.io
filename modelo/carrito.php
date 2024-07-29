<?php

require_once("conexion.php");
Class carrito
{
	public function obtenerTodo()
	{
		$con=new conexion;
		$resultados=$con->consultar("carrito");
		$con=null;
		return $resultados;
	}

	public function insertar($datos)
	{
		$con=new conexion;
		$mensaje=$con->insertar("carrito",$datos);
		$con=null;
		return $mensaje;
	}
	public function consultarusuario($filtro)
	{
		$con=new conexion;
		$datos=$con->consultaFiltro("carrito",$filtro);
		$con=null;
		return $datos;
	}	
	public function eliminarTodo()
    {
        $con = new conexion;
        $mensaje = $con->eliminarTodo("carrito");
        $con = null;
        return $mensaje;
    }
}

?>