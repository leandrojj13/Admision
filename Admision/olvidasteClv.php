<?php
	include("funciones.php");
	
	$usuarios = new Usuarios();

	if($_POST){
		$usuarioNombre = "";
		$usuarioClave = "";
		$verificador = false;
		foreach (Usuarios::extraerUsuarios() as $usuario){
			if($usuario['email'] == $_POST['correo'] ){
				$verificador = true;
				$usuario['usuario'] = $usuarioNombre;
				$usuario['clave'] = $usuarioClave;
				break;
			}
		}
	

		if(trim($_POST['correo'])){
			if($verificador){
				mail($_POST['correo'], "Recuperaci&oacute;n Clave", "Aqui su nombre de Usuario es '{$usuarioNombre}' y su Clave es '{$usuarioClave}'!", "From: leandrojj13@hotmail.com");
				
			}else{
				$mensaje= "<font style = 'color:red;'><p>Este este Correo Electr&oacute;nico no se ha registrado!</p></font>";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Usuario</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- <body  style = "background-image: url('imagenes/ministerio.jpg') "> -->
<body  style = "background-color: white">
	<nav class = "navbar navbar-fixed-top" role="navigation" style ="background-color:#0070BB">
		<div  class = "container-fluid">
			<br><font color ="white" size="5" align = "center"><p>Sistema de admisi&oacute;n del Liceo Nocturno Rep&uacute;blica de Honduras - Recuperaci&oacute;n Clave</p></font>
		</div>
	</nav>

	<form method= "post" action= "">
		<center><br><br><br><br><br>
			<div class="container" style ="margin-top: 50px; margin-bottom: 100px;">
				<div class="row vertical-offset-100">
					<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title" >Restablecer contrase&ntilde;a <small><a class="pull-right" style = "color: blue;"href = "./">Volver al login</a></small> </h3>
									
							</div>
							<div class="panel-body">
								
								<fieldset>
										<div class="alert alert-warning">
											Indica el correo electr&oacute;nico que usaste para registrarte y te enviaremos un mensaje con tu  contrase&ntilde;a.
										</div>
								
									<div class="form-group">
										<div class="input-group">
											<span class= "input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
											<input class="form-control" placeholder="Correo Electr&oacute;nico" name="correo" type="email" value="" required >
										</div>						
									</div>						
									<?php echo $mensaje;?>
									<div class="form-group">
										<button  class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-send"></span>  Enviar</button>
									</div>
									
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</center>	
	</form>
	<div class="nav navbar-fixed-bottom">
		<div id="pie" id="pie" style = "font-size:16; background-color: #0070BB; color:white;">Derechos reservados para Leandro Jim&eacute;nez | Estudiante de Software. </div>
	</div>
		
		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- Morris Charts JavaScript -->
		<script src="js/plugins/morris/raphael.min.js"></script>
		<script src="js/plugins/morris/morris.min.js"></script>
		<script src="js/plugins/morris/morris-data.js"></script>
		
	</body>
</html>
