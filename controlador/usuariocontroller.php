<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require_once("../modelo/consoleusuario.php");
$usuobj=new consoleusuario;
switch ($_POST['opcion']){
	case 'consulta':
		$datos=$usuobj->obtenerTodo();
		$tabla="";
		foreach ($datos as $fila){
			$tabla.="<tr><td>".$fila['codigo']."</td>";
			$tabla.="<td>".$fila['usuario']."</td>";
			$tabla.="<td>".$fila['password']."</td>";
			$tabla.="<td>".$fila['nombre']."</td>";
			$tabla.="<td>".$fila['apellido']."</td>";
			$tabla.="<td>".$fila['fechacreacion']."</td></tr>";
		}
		echo $tabla;
		break;

	case 'insertar':
		$datos['usuario']=$_POST['usuario'];
		$datos['password']=$_POST['password'];
		$datos['nombre']=$_POST['nombre'];
		$datos['apellido']=$_POST['apellido'];
		$datos['fechacreacion']=date("y-m-d");
		echo ($usuobj->insertar($datos));
		break;
	case 'login':

		$filtro['usuario'] = $_POST['usuario'];
        $filtro['password'] = $_POST['password'];
        $consoleusuario = $usuobj->consultarusuario($filtro);

        if (empty($consoleusuario)) {
            echo "No se pueden validar credenciales";
        } else {
            session_start();
            $_SESSION['usuario'] = $consoleusuario[0]['usuario'];

            // Agrega la lógica para redirigir según el tipo de usuario
            if ($_SESSION['usuario'] == 'admin') {
                echo 'admin';
            } else {
                echo 'user';
            }
        }
		break;
	case 'validarsesion':
		session_start();
		if(isset($_SESSION['usuario']))
		{
			echo true;
		}else{
			echo false;
		}
		break;
	case 'cerrasesion':
		session_start();
		if(isset($_SESSION['usuario']))
		{
			unset($_SESSION['usuario']);
			session_destroy();
		}
		echo false;
		break;
	default:
		// code..
		break;
}


?>