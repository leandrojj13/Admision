<?php

class MensajesEstudiantes {
	
	public $id;
	public $asunto;
	public $cuerpo;
	public $fecha;
	public $id_usuario;
	
	function guardar(){
		date_default_timezone_set('America/Santo_Domingo');
		$fecha = date('y/m/d');
		$sql= "INSERT INTO `mensajesestudiantes`(`asunto`, `cuerpo`, `id_usuario`, `fecha`) VALUES 
		('{$this->asunto}','{$this->cuerpo}','{$this->id_usuario}','{$fecha}')";
		
		$con = conexion::get();
		mysqli_query($con, $sql);
		$this->id = mysqli_insert_id($con);
	}
	
	function extraerMensajes(){
		$sql = "SELECT * from mensajesestudiantes where id_usuario = {$this->id_usuario} ";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	function traerMensaje(){
		$sql = "select * from mensajesestudiantes where id = '{$this->id}'";
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		if(mysqli_num_rows($rs) > 0){
			$fila = mysqli_fetch_assoc($rs);
			
			foreach($fila as $propiedad => $valor){
				$this->$propiedad = $valor;
			}
		}
	}

	function borrarMensaje($index){
		$sql = "delete from mensajesestudiantes where id = '{$index}'";
		mysqli_query(conexion::get(), $sql);
	}
}
