<?php 
	function noError(){
		
	}
	set_error_handler("noError");
	
	if($_POST){
		$DB_HOST = $_POST['DB_HOST'];
		$DB_USER = $_POST['DB_USER'];
		$DB_PASS = $_POST['DB_PASS'];
		$DB_NAME = $_POST['DB_NAME'];
	
		$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS) or die ("<script>alert('Configuración errónea, favor verificar datos !'); window.location = 'asistente.php'</script>");
		
		mysqli_query($con, "drop{$DB_NAME}");
		mysqli_query($con, "create database {$DB_NAME}");
		mysqli_query($con, "use {$DB_NAME}");
		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `administradores` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `admin` varchar(255) NOT NULL,
								  `clave` varchar(255) NOT NULL,
								  `fecha` date NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;	");
		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `estudiante` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `nombres` varchar(50) NOT NULL,
							  `apellidos` varchar(50) NOT NULL,
							  `fecha_nacimiento` date NOT NULL,
							  `nacionalidad` varchar(50) NOT NULL,
							  `telefono` varchar(50) NOT NULL,
							  `celular` varchar(50) DEFAULT NULL,
							  `direccion` varchar(50) NOT NULL,
							  `estado_Civil` varchar(30) NOT NULL,
							  `sexo` varchar(15) NOT NULL,
							  `id_Tutor` int(11) NOT NULL,
							  `fecha` date DEFAULT NULL,
							  `id_Usuario` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
							");
		mysqli_query($con, "	CREATE TABLE IF NOT EXISTS `estudianteaprobado` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `nombres` varchar(50) NOT NULL,
							  `apellidos` varchar(50) NOT NULL,
							  `fecha_nacimiento` date NOT NULL,
							  `nacionalidad` varchar(50) NOT NULL,
							  `telefono` varchar(50) NOT NULL,
							  `celular` varchar(50) DEFAULT NULL,
							  `direccion` varchar(50) NOT NULL,
							  `estado_Civil` varchar(30) NOT NULL,
							  `sexo` varchar(15) NOT NULL,
							  `id_Tutor` int(11) NOT NULL,
							  `fecha` date DEFAULT NULL,
							  `id_Usuario` int(11) NOT NULL,
							  `id_EstudianteViejo` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");	
							
		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `mensajeriaadmin` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `asunto` varchar(40) NOT NULL,
						  `cuerpo` text NOT NULL,
						  `fecha` date NOT NULL,
						  `usuario` varchar(50) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
						");		
	mysqli_query($con, "CREATE TABLE IF NOT EXISTS `mensajesestudiantes` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `asunto` varchar(50) NOT NULL,
						  `cuerpo` text NOT NULL,
						  `id_usuario` int(11) NOT NULL,
						  `fecha` date NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
	mysqli_query($con, "CREATE TABLE IF NOT EXISTS `notificaciones` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `notificacion` text NOT NULL,
				  `id_usuario` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				");
	mysqli_query($con, "CREATE TABLE IF NOT EXISTS `tutores` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `nombres` varchar(50) NOT NULL,
					  `apellidos` varchar(50) NOT NULL,
					  `nacionalidad` varchar(30) NOT NULL,
					  `telefono` varchar(50) NOT NULL,
					  `celular` varchar(50) NOT NULL,
					  `direccion` varchar(50) NOT NULL,
					  `profesion` varchar(30) NOT NULL,
					  `estado_Civil` varchar(30) NOT NULL,
					  `sexo` varchar(30) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				");	
		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `usuarios` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `nombre` varchar(50) NOT NULL,
					  `telefono` varchar(50) NOT NULL,
					  `celular` varchar(50) NOT NULL,
					  `usuario` varchar(50) NOT NULL,
					  `email` varchar(50) NOT NULL,
					  `clave` varchar(50) NOT NULL,
					  `estado` varchar(50) DEFAULT '\"No hay solicitud!\"',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				");
	$config = "<?php 
	define ('DB_HOST', '{$DB_HOST}');
	define ('DB_NAME', '{$DB_NAME}');
	define ('DB_USER', '{$DB_USER}');
	define ('DB_PASS', '{$DB_PASS}');";
		
		file_put_contents("libreria/config.php", $config);
		$mensaje = "Configuración exitosa, información importante: Si no hay ningún usuario registrado su nombre de usuario será admin y su contraseña 123, de existir usuarios registrados este usuario quedará obsoleto.";
		echo"<script>window.location = './'; alert('{$mensaje}'); </script>";
	}
?>
<html>
	<head>
		<title>Sistema Admisi&oacute;n - Install</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci"/>
		<link rel="stylesheet" type="text/css" charset="UTF-8 sin BOM" href="css/style.css"/> 
		<link rel="stylesheet" type="text/css" charset="UTF-8 sin BOM" href="css/bootstrap.min.css"/> 
		<link rel="icon" type="image/png" href="imagenes/install.png" />
	</head>
	<body style="background-image: url('imagenes/background.jpg');">
		
	<div class="container"> 
	<br><br>
	<div class="page-header">
	<h1 class="text-center" style="font-family: courier new;"><b>Configuración del sistema</b><small class="text-warning"><b> Sistema de admisi&oacute;n</b></small></h1>
	</div>
<center>
	<br><br><br><br>
	<a href="#formulario" class= "btn btn-success btn-lg"  data-toggle = "modal" data-target="#formulario"><span class="glyphicon glyphicon-refresh"></span> Iniciar instalación</a>
</center>
	<div class ="modal fade" id="formulario">
		<div class= "modal-dialog">
			<div class="modal-content">
				<div class = "modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
					<h3 class = "modal-title text-center">Configuración</h3>
				</div>
				<div class="modal-body">
					<form action=""  method="post" class="form-horizontal" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label col-md-2">Servidor: </label>
							<div class="col-md-10">
								<input class="form-control" value="<?php if($_POST){ echo $_POST['DB_HOST'];} ?>" type="text" name="DB_HOST" placeholder="Sevidor (localhost)"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">SGBD: </label>
							<div class="col-md-10">
								<input class="form-control" value="<?php  if($_POST){ echo $_POST['DB_NAME'];}?>" type="text" name="DB_NAME" placeholder="Base de datos"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Usuario: </label>
							<div class="col-md-10">
								<input  class="form-control"value="<?php if($_POST){ echo $_POST['DB_USER'];} ?>" type="text" name="DB_USER" placeholder="Usuario"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Contraseña: </label>
							<div class="col-md-10">
								<input class="form-control" value="<?php if($_POST){ echo $_POST['DB_PASS'];}?>" type="text" name="DB_PASS" placeholder="Contraseña"/>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary btn-md" onClick="return confirm('Si no existe, la base de datos se creará, si existe, se sobreescribirá !')"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
							<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>