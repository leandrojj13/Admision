<?php 

class Administradores{
	
	public $id;
	public $admin;
	public $clave;
	
	function guardarEditar(){
		//actualizar
		if($this->id > 0){
			
			// $sql = "UPDATE `usuarios` SET 
			// `usuario`='{$this->usuario}',`clave`='{$this->clave}' WHERE id = '{$this->id}'";
			
			// $con = conexion::get();
			// mysqli_query($con, $sql);
		}else{
			//nuevo
			date_default_timezone_set('America/Santo_Domingo');
			$fecha = date('y/m/d');
			$sql = "INSERT INTO `administradores`(`admin`, `clave`,`fecha`) VALUES ('{$this->admin}','{$this->clave}', '{$fecha}')";
			$con = conexion::get();
			mysqli_query($con, $sql);
			$this->id = mysqli_insert_id($con);
		}
	}
	
	static function extraerAdministradores(){
		$sql = "SELECT * from administradores";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	function traerAdministradores(){
		$sql = "select count(*) as conteo from administradores where admin = '{$this->admin}'";
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		$fila = mysqli_fetch_assoc($rs);
		
		
			
		return  $fila ['conteo'];

	}
	
	function borrarAdministrador(){
		$sql = "delete from administradores where id = '{$this->id}'";
		mysqli_query(conexion::get(), $sql);
	}
	
	// function reset(){
		// $campos = get_class_vars('Administradores');
		
		// foreach($campos as $variable=>$v){
			// $this->$variable = '';
		// }
	// }
	
}


?>