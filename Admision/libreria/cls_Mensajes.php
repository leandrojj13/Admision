<?php

class Mensajes {
	
	public $id;
	public $asunto;
	public $cuerpo;
	public $fecha;
	public $usuario;
	
	function guardarAdmin(){
		date_default_timezone_set('America/Santo_Domingo');
		$fecha = date('y/m/d');
		$sql= "INSERT INTO `mensajeriaadmin`(`asunto`, `cuerpo`, `fecha`, `usuario`) VALUES (
			'{$this->asunto}', '{$this->cuerpo}', '{$fecha}','{$this->usuario}')";
		
		$con = conexion::get();
		mysqli_query($con, $sql);
		$this->id = mysqli_insert_id($con);
	}
	
	static function extraerMensajes(){
		$sql = "SELECT * from mensajeriaadmin";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	function traerMensaje(){
		$sql = "select * from mensajeriaadmin where id = '{$this->id}'";
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		if(mysqli_num_rows($rs) > 0){
			$fila = mysqli_fetch_assoc($rs);
			
			foreach($fila as $propiedad => $valor){
				$this->$propiedad = $valor;
			}
			
		}
	}

	function borrarMensaje($index){
		$sql = "delete from mensajeriaadmin where id = '{$index}'";
		mysqli_query(conexion::get(), $sql);
	}
}
