<?php 

class Instancia{
	
	public $con;
	
	function __construct(){
				function noError(){
			
		}
		set_error_handler("noError");
		$this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ("<script> window.location = 'asistente.php'</script>");
		
	}
	
	function __destruct(){
		mysqli_close($this->con);
	}
}

class Conexion {
	
	public static $instancia = null;
	
	static function  get(){
		if(Conexion::$instancia == null){
			Conexion::$instancia = new Instancia();
		}
		return Conexion::$instancia->con;
	}
}
?>