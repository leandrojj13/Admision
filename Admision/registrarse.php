<?php
	include ('funciones.php');

	$usuarios = new Usuarios ();
	$formato2 = "input-group";
	$formato3 = "input-group";
	$mensaje = "";
	$administrador = new Administradores();
	if($_POST){
		// foreach($_POST as $k => $v){
			// echo "\$usuarios->{$k} = \$_POST['{$k}'];<br>";
		// }
		$verificador = true;
		$verificador2 = true;
		foreach (Usuarios::extraerUsuarios() as $usuario){
			if($usuario['usuario'] == $_POST['usuario'] ){
				$verificador = false;
				break;
			}
		}
		foreach (Usuarios::extraerUsuarios() as $usuario){
			if($usuario['email'] == $_POST['email'] ){
				$verificador2 = false;
				break;
			}
		}
		$administrador->admin = $_POST['usuario'];

		if($verificador && $verificador2 && $administrador->traerAdministradores() == 0){	
			if(trim ($_POST['nombre']) && trim ($_POST['telefono']) && trim ($_POST['usuario']) && trim ($_POST['email']) && trim ($_POST['clave']) && trim ($_POST['claveConfirmar']) && $_POST['clave'] == $_POST['claveConfirmar']){
				$usuarios->nombre = $_POST['nombre'];
				$usuarios->telefono = $_POST['telefono'];
				$usuarios->celular = $_POST['celular'];
				$usuarios->usuario = $_POST['usuario'];
				$usuarios->email = $_POST['email'];
				$usuarios->clave = $_POST['clave'];
				//$usuarios->claveConfirmar = $_POST['claveConfirmar'];
				$usuarios->guardarEditar();
				$usuarios->reset();
				//clearstatcache(); 
				
				header("Location: usuarioRegistrado.php");
			}
		}if ($verificador == false || $administrador->traerAdministradores() != 0){
			$formato2 = "input-group has-error";
			$mensaje = "<p class='text-center text-danger'>Ya existe este nombre de usuario, favor elegir otro!</p>";
		}if ($verificador2 == false){
			$formato3 = "input-group has-error";
			$mensaje = "<p class='text-center text-danger'>Este correo esta siendo usado!</p>";
		}
	}

?>

<html>
	<head>
		<link rel="icon" type="image/png" href="imagenes/politico1.png" />
		<title>Admission System - VMeta</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel= "stylesheet" href = "css/bootstrap.min.css">
	</head>
	<body>
		<div class = "container">
				<nav class = "navbar navbar-fixed-top" role="navigation" style ="background-color:#4A66A0">
					<div  class = "container-fluid">
						<br><font color ="white" size="5" align = "center"><p>Sistema de admisi&oacute;n del Liceo Nocturno Rep&uacute;blica de Honduras</p></font>
					</div>
				</nav>
				
				<div class="row">
	
					<div class="col-xs-5" id="registrartePanel">
						<div class="container-fluid" style = "margin-top: 80;">	
							<div class="col-xs-12 col-md-offset-5"> 
								<div class="panel panel-info" >
									<div class="panel-heading">
										<div class="panel-title text-center"><font size="6">Reg&iacute;strate</font></div>
									</div>     
									<div style="padding-top:30px" class="panel-body" >
										<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
										<form method="post" action="" class="form-horizontal" role="form">
											
											<?php
												$formato = "input-group";
												
												if ($_POST && !trim($_POST['nombre'])){
													$formato = "input-group has-error";
												}
											
											?>
											<div style="margin-bottom: 25px" class="<?php echo $formato;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
												<input value="<?php if($_POST){ echo $_POST['nombre'];}else{ echo $usuarios->nombre;}?>" type="text" class="form-control text-center" name="nombre" placeholder="Nombre Completo"/>                                        
											</div>
											
											<?php
												$formato1 = "input-group";
												
												if ($_POST && !trim($_POST['telefono'])){
													$formato1 = "input-group has-error";
												}
											
											?>
											<div style="margin-bottom: 25px" class="<?php echo $formato1;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-signal"></i></span>
												<input value="<?php if($_POST){ echo $_POST['telefono'];}else{ echo $usuarios->telefono;} ?>"  type="number" class="form-control text-center" name="telefono" placeholder="Tel&eacute;fono"/>                                        
											</div>				
											<div style="margin-bottom: 25px" class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
												<input type="number" class="form-control text-center" name="celular" placeholder="Celular"/>                                        
											</div>
											<?php
												
												
												if ($_POST && !trim($_POST['usuario'])){
													$formato2 = "input-group has-error";
												}
											
											?>
											<div style="margin-bottom: 25px" class="<?php echo $formato2;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input value="<?php if($_POST){ echo $_POST['usuario'];}else{ echo $usuarios->usuario;} ?>" type="text" class="form-control text-center" name="usuario" placeholder="Nombre de usuario"/>                                        
											</div>
											<?php
												
												if ($_POST && !trim($_POST['email'])){
													$formato3 = "input-group has-error";
												}
											
											?>
											<div style="margin-bottom: 25px" class="<?php echo $formato3;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input value="<?php if($_POST){ echo $_POST['email'];}else{ echo $usuarios->email;} ?>" type="email" class="form-control text-center" name="email" placeholder="Correo Electr&oacute;nico"/>                                        
											</div>
											<?php
												$formato4 = "input-group";
												if($_POST){
													if (!trim($_POST['clave'])){
														$formato4 = "input-group has-error";
													}
													if($_POST['clave'] != $_POST['claveConfirmar']){
														$formato4 = "input-group has-error";
													}
												}
											?>
											<div style="margin-bottom: 25px" class="<?php echo $formato4;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control text-center" name="clave" placeholder="Contrase&ntilde;a">
											</div>
											<?php
												$formato5 = "input-group";
												
												if($_POST){
													if (!trim($_POST['claveConfirmar'])){
														$formato5 = "input-group has-error";
													}
													if($_POST['clave'] != $_POST['claveConfirmar']){
														$formato5 = "input-group has-error";
														$mensaje = "<p class='text-center text-danger'>No coinciden!</p>";
													}
												}
											
											?>
											
											<div style="margin-bottom: 25px" class="<?php echo $formato5;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control text-center" name="claveConfirmar" placeholder="Confirmar Contrase&ntilde;a" />
											</div>

											<div style="margin-top:10px" class="input-group btn-block">
												<button id="btn-login" class="btn btn-block btn-info"> <i class="icon-hand-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reg&iacute;strate&nbsp;&nbsp;&nbsp;</button>
											</div>
											<?php
												echo "<br>".$mensaje;
											?>
										</form>     
									</div>                     
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xs-7" id="registrarteParrafo">
						<div class="container-fluid" style = "margin-top: 250;">
							<div class="col-xs-7 col-md-offset-3">
								<center>
									<font style = "font-size:30; font-weight: bold; font-family: Courier New;"><p>Iniciar sesi&oacute;n</p></font>
									<font style = "font-size:25; font-family: Courier New;"><p>&iquest;Ya estas registrado?</p></font>
									<font style = "font-size:25; font-family: Courier New;"><p>Entra y vive la historia</p></font>
									<font style = "font-size:25; font-family: Courier New;"><p><a type="submit" href="./" style="text-decoration: none">Inicia sesi&oacute;n</a></p></font>
								</center>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
		<div class="nav navbar-fixed-bottom">
			<div id="pie" id="pie" style = "font-size:16; background-color: #4A66A0; color:white;">Derechos reservados para Leandro Jim&eacute;nez | Estudiante de Software. </div>
		</div>

		<script src="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	</body>
</html>