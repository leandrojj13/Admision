<?php 

class Estudiantes {
	
	public $id;
	public $nombres;
	public $apellidos;
	public $fecha_nacimiento;
	public $nacionalidad;
	public $telefono;
	public $celular;
	public $direccion;
	public $estado_Civil;
	public $sexo;
	public $id_Tutor;
	public $id_Usuario;
	
	function guardarEditar(){
		
		if($this->id > 0){
			// //actualizar
			// $sql = "UPDATE `temas` SET `titulo`='{$this->titulo}' WHERE id = '{$this->id}'";
			
			
			// $con = conexion::get();
			// mysqli_query($con, $sql);
		}else{
			//nuevo
			$fecha = date('y/m/d');
			$sql= "INSERT INTO `estudiante`(`nombres`, `apellidos`, `fecha_nacimiento`, `nacionalidad`, `telefono`, 
				`celular`, `direccion`, `estado_Civil`, `sexo`, `id_Tutor`, `fecha`, `id_Usuario`) VALUES 
				('{$this->nombres}', '{$this->apellidos}', '{$this->fecha_nacimiento}', '{$this->nacionalidad}',
					'{$this->telefono}','{$this->celular}','{$this->direccion}','{$this->estado_Civil}', '{$this->sexo}'
					,'{$this->id_Tutor}', '{$fecha}', '{$this->id_Usuario}')";
			
			$con = conexion::get();
			mysqli_query($con, $sql);
			$this->id = mysqli_insert_id($con);
		}
	}

	
	static function extraerEstudiantes(){
		$sql = "SELECT * from estudiante";
		$rs = mysqli_query(conexion::get(), $sql);
		$resultado = array();
		
		while ($fila = mysqli_fetch_assoc($rs)){
			$resultado [] = $fila;
		}
		return $resultado;
	}
	
	 // function extraerTemasSiguientes(){
		// $sql = "SELECT * from temas where id >= {$this->id}";
		
		// $rs = mysqli_query(conexion::get(), $sql);
		// $resultado = array();
		
		// while ($fila = mysqli_fetch_assoc($rs)){
			// $resultado [] = $fila;
		// }
		// return $resultado;
	// }
	
	 // static function ultimoId(){
		// $sql = "SELECT MAX(id) FROM temas";
		
		// $rs = mysqli_query(conexion::get(), $sql);
		// $resultado = array();
		
		// while ($fila = mysqli_fetch_assoc($rs)){
			// $resultado [] = $fila;
		// }
		// return $resultado[0]['MAX(id)'];
	// }
	
	
	
	function traerEstudiante(){
		$sql = "select * from estudiante where id = '{$this->id}'";
		
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
	
	function borrarEstudiante(){
		$sql = "delete from estudiante where id = '{$this->id}'";
		mysqli_query(conexion::get(), $sql);
	}
	
	function reset(){
		$campos = get_class_vars('Temas');
		
		foreach($campos as $variable=>$v){
			$this->$variable = '';
		}
	}
	
	// function idFoto($titulo){
			// $sql = "SELECT * from temas where titulo = '{$titulo}'";
			
			// $con = conexion::get();
			// $rs = mysqli_query($con, $sql);
			// $fila = array();
			
			// $fila = mysqli_fetch_assoc($rs);
			
			
			// return  $fila ['id'];
	// }
	
	// function agregarComentario(){
		// $sql = "INSERT INTO `comentarios`(`comentario`, `idtema`) VALUES ('{$this->comentario}','{$this->id}')";
		
		// $con = conexion::get();
		// mysqli_query($con, $sql);
	// }
	
	// function extraerComentario(){
		// $sql = "select * from comentarios where idtema = '{$this->id}'";
		
		// $rs = mysqli_query(conexion::get(), $sql);
		// $resultado = array();
		
		// while ($fila = mysqli_fetch_assoc($rs)){
			// $resultado [] = $fila;
		// }
		// return $resultado;
	// }
	
	// function borrarComentario($index){
		// $sql = "delete from comentarios where id = '{$index}'";
		// mysqli_query(conexion::get(), $sql);
	// }
}


?>