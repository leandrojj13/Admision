<?php

class Notificaciones {

	public $id;
	public $notificacion;
	public $id_Usuario;
	
	function guardar(){
		//nuevo
		//$fecha = date('d/m/y');
		$sql= "INSERT INTO `notificaciones`(`notificacion`, `id_usuario`) VALUES ('{$this->notificacion}', '{$this->id_Usuario}')";
			
			$con = conexion::get();
			mysqli_query($con, $sql);
			$this->id = mysqli_insert_id($con);
	}
	
	function extraerNotificaciones(){
		$sql = "SELECT * from notificaciones where id_Usuario = {$this->id_Usuario}";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	function borrarNotificaciones($index){
		$sql = "delete from notificaciones where id = '{$index}'";
		mysqli_query(conexion::get(), $sql);
	}

}