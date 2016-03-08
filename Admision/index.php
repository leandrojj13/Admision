<?php
	include ('funciones.php');
	
	if(isset($_SESSION['logeado'])){
		header("Location: principal.php");
	}
	if(isset($_SESSION['administrar'])){
		header("Location: principalAdmin.php");
	}
	
	$gestor = new Gestor();
	$usuarios = new Usuarios ();
	$verificador =true;
	$mensaje = "input-group";
	$mensaje2 = "";
	if($_POST){
		// foreach($_POST as $k => $v){
			// echo "\$usuarios->{$k} = \$_POST['{$k}'];<br>";
		// }
			
		if(isset($_POST['usuarioLogin']) && isset($_POST['claveLogin']) ){	 
			if($gestor->login($_POST['usuarioLogin'], $_POST['claveLogin'])){
				if (isset ($_SESSION['logeado'])){
				//echo "<br><br><br><br><br><br><br><br>";var_dump($_SESSION['logeado']);
					header("Location: principal.php");
				}else if ($_SESSION['administrar']){
					header("Location: principalAdmin.php");
				} 
			}
			else{
				$mensaje = "input-group has-error";
				$mensaje2 = "<p class='text-center text-danger'>Nombre de usuario /email o contraseña no v&aacute;lidos.</p>";
			}
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
	<body onload= "nobackbutton()">
		<div class = "container">
				<nav class = "navbar navbar-fixed-top" role="navigation" style ="background-color:#4A66A0">
					<div  class = "container-fluid">
						<br><font color ="white" size="5" align = "center"><p>Sistema de admisi&oacute;n del Liceo Nocturno Rep&uacute;blica de Honduras</p></font>
					</div>
				</nav>
				
				<div class="row">
			
					
					<div class="col-xs-5" id ="iniciarPanel">
						<div class="container-fluid" style = "margin-top: 185;">	
							<div class="col-xs-12 col-md-offset-5"> 
								<div class="panel panel-info" >
									<div class="panel-heading">
										<div class="panel-title text-center"><font size="6">Iniciar sesi&oacute;n</font></div>
									</div>     
									<div style="padding-top:30px" class="panel-body" >
										<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
										<form method="post" action=""  class="form-horizontal" role="form">
											<div style="margin-bottom: 25px" class="<?php echo $mensaje;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input type="text" class="form-control text-center" name="usuarioLogin" placeholder="Usuario" autofocus />                                        
											</div>
											<div style="margin-bottom: 25px" class="<?php echo $mensaje;?>">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control text-center" name="claveLogin" placeholder="Contrase&ntilde;a" />
											</div>

											<div style="margin-top:10px" class="input-group btn-block">
												<button id="btn-login" class="btn btn-block btn-info"> <i class="icon-hand-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entrar&nbsp;&nbsp;&nbsp;</button>
											</div>
											<hr>
											<center><a href="olvidasteClv.php">&iquest;Olvidaste tu contrase&ntilde;a?</a></center>
											<?php echo $mensaje2;?>
										</form>     
									</div>                     
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-7" id = "iniciarParrafo">
						<div class="container-fluid" style = "margin-top: 250;">
							<div class="col-xs-7 col-md-offset-3">
								<center>
									<font style = "font-size:30; font-weight: bold; font-family: Courier New;"><p>Reg&iacute;strate</p></font>
									<font style = "font-size:25; font-family: Courier New;"><p>&iquest;A&uacute;n no te has unido?</p></font>
									<font style = "font-size:25; font-family: Courier New;"><p>Ya es tiempo, <a type="submit" href="registrarse.php" style="text-decoration: none">reg&iacute;strate</a></p></font>
								</center>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
		<div class="nav navbar-fixed-bottom">
			<div id="pie" id="pie" style = "font-size:16; background-color: #4A66A0; color:white;">Derechos reservados para Leandro Jim&eacute;nez | Estudiante de Software. </div>
		</div>
		<script>
							
			function nobackbutton(){
				
			   window.location.hash="no-back-button";
				
			   window.location.hash="Again-No-back-button" //chrome
				
			   window.onhashchange=function(){window.location.hash="no-back-button";}
				
			}
		
		</script>
		<script src="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>