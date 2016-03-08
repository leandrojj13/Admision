<?php 

class Usuarios{
	
	public $id;
	public $nombre;
	public $telefono;
	public $celular;
	public $usuario;
	public $email;
	public $clave;
	public $estado;
	public $foto;
	
	function guardarEditar(){
		//actualizar
		if($this->id > 0){
			
			$sql = "UPDATE `usuarios` SET `nombre`= '{$this->nombre}',`telefono`= '{$this->telefono}',`celular`= '{$this->celular}', `email`= '{$this->email}'  WHERE id = '{$this->id}'";
			
			$con = conexion::get();
			mysqli_query($con, $sql);
		}else{
			//nuevo
			$sql = "INSERT INTO `usuarios`(`nombre`, `telefono`, `celular`, `usuario`, `email`, `clave`) VALUES 
			('{$this->nombre}','{$this->telefono}','{$this->celular}','{$this->usuario}','{$this->email}','{$this->clave}')";
			$con = conexion::get();
			mysqli_query($con, $sql);
			$this->id = mysqli_insert_id($con);
		}
	}
	function actualizar(){
		//actualizar
		if($this->id > 0){
			
			$sql = "UPDATE `usuarios` SET  `estado`= '{$this->estado}'  WHERE id = '{$this->id}'";
			
			$con = conexion::get();
			mysqli_query($con, $sql);
		}
	}
	
	static function extraerUsuarios(){
		$sql = "SELECT * from usuarios";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	function traerUsuario(){
		$sql = "select * from usuarios where usuario = '{$this->usuario}' or email = '{$this->usuario}'";
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		if(mysqli_num_rows($rs) > 0){
			$fila = mysqli_fetch_assoc($rs);
			
			foreach($fila as $propiedad => $valor){
				$this->$propiedad = $valor;
			}
			
		}
	}
	
	
	function updateFoto(){
		$sql = "UPDATE `usuarios` SET `foto`= '{$this->foto}'  WHERE id = '{$this->id}'";
		
		$con = conexion::get();
		mysqli_query($con, $sql);
	}
	
	// function borrarUsuario(){
		// $sql = "delete from usuarios where id = '{$this->id}'";
		// mysqli_query(conexion::get(), $sql);
	// }
	
	function reset(){
		$campos = get_class_vars('Usuarios');
		
		foreach($campos as $variable=>$v){
			$this->$variable = '';
		}
	}
	
}


?>