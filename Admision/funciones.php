<?php
session_start();

include ('libreria/motor.php');
		
$con = Conexion::get();
class Gestor{
	
	function login($usuario, $contrasena){
		$resultado = false;

		$usuarios = Usuarios::extraerUsuarios();
		
		$administrador = new Administradores();
		
		$administrador->admin = $usuario;
		//$administrador->clave = $contrasena;
		
		
		if(($usuario == 'admin' && $contrasena == '123') || $administrador->traerAdministradores() > 0){
			
			if ($usuario == 'admin'){
				$_SESSION['administrar'] = "Administrador";
			}else {
				$_SESSION['administrar'] = $usuario;
			}
			$resultado = true;
		}else{
			foreach($usuarios as $usr){
				if(($usr['usuario'] == $usuario || $usr['email'] == $usuario) && $usr['clave'] == $contrasena){
					$_SESSION['logeado'] = $usuario;
					return true;
					
				}
			}
		}
		return $resultado;
	}
}

function verificarUsuario(){
	if(!isset($_SESSION['logeado'])){
		session_start();
		session_destroy();
		header("Location:./");
	}
}
function verificarAdministrador(){
	if(!isset($_SESSION['administrar'])){
		session_start();
		session_destroy();
		header("Location: ./");
	}
}

function sesionActiva(){
	return isset ($_SESSION['logeado']);
}

?>