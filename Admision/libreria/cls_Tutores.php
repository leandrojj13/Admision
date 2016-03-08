<?php 

class Tutores{
	
	public $id;
	public $nombres;
	public $apellidos;
	public $nacionalidad;
	public $telefono;
	public $celular;
	public $direccion;
	public $profesion;
	public $estado_Civil;
	public $sexo;
	
	function guardar(){
		//nuevo
		//$fecha = date('d/m/y');
		$sql= "INSERT INTO `tutores`( `nombres`, `apellidos`, `nacionalidad`, `telefono`, `celular`, `direccion`, `profesion`, `estado_Civil`, `sexo`) VALUES 
		('{$this->nombres}', '{$this->apellidos}', '{$this->nacionalidad}', '{$this->telefono}',
		'{$this->celular}', '{$this->direccion}', '{$this->profesion}', '{$this->estado_Civil}', '{$this->sexo}')";
			
			$con = conexion::get();
			mysqli_query($con, $sql);
			$this->id = mysqli_insert_id($con);
	}
	function traerTutor(){
		$sql = "select * from tutores where id = '{$this->id}'";
		
		$rs = mysqli_query(conexion::get(), $sql);
		
		if(mysqli_num_rows($rs) > 0){
			$fila = mysqli_fetch_assoc($rs);
			
			foreach($fila as $propiedad => $valor){
				$this->$propiedad = $valor;
			}
		}
		// $this->id = $fila ['Id'];
		// $this->nombre = $fila ['Nombre'];
		// $this->apellido = $fila ['Apellido'];
		// $this->partido = $fila ['Partido'];
		// $this->posicion = $fila ['Posicion'];
		// $this->promesa = $fila ['Promesa'];
	}
	
	// function verificarExistencia($emailRegistro){
		// $sql = "SELECT * from `suscripciones` where correo = '{$emailRegistro}'";
			
			// $con = conexion::get();
			// $rs = mysqli_query($con, $sql);
			// $fila = array();
			
			// $fila = mysqli_fetch_assoc($rs);
			// return  $fila;
	// }
	
	static function extraerRegistros(){
		$sql = "SELECT * from tutores";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	function borrarRegistro(){
		$sql = "delete from tutores where id = '{$this->id}'";
		mysqli_query(conexion::get(), $sql);
	}
}


?>