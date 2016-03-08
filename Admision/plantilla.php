<?php
	include ("funciones.php");
	verificarUsuario();
	if(isset($_GET['delete'])){
		$notificaciones = new Notificaciones();
		$notificaciones->borrarNotificaciones($_GET['delete']);
		header("Location: " . basename($_SERVER['PHP_SELF']));
	}
	$objPlantila4454 = new plantilla();
	class Plantilla{
		
		function __construct(){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admisi&oacute;n-VMeta</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/landing-page.css" rel="stylesheet">

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



        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="principal.php">Sistema Admisi&oacute;n</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
				<?php
					$usuario = new Usuarios();
					$usuario->usuario = $_SESSION ['logeado'];
					$usuario->traerUsuario();
					$mensajesEstudiantes = new MensajesEstudiantes();
					$mensajesEstudiantes->id_usuario = $usuario->id;
					$todo = $mensajesEstudiantes->extraerMensajes();
					if($todo){
						foreach($todo as $mensaje){
				?>                       
					   <li class="message-preview">
                            <a href="verMensaje.php?nm=<?php echo $mensaje['id'];?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="imagenes/admin.png" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo  $mensaje['asunto'];?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d-m-20y',strtotime($mensaje['fecha'])); ?></p>
                                        <p>Ver</p>
                                    </div>
                                </div>
                            </a>
                        </li>
					<?php
						}
					?>
						<li class="message-footer">
                            <a href="mensajeria.php">Leer todos los mensajes</a>
                        </li>
					<?php
					}else{
						echo "No hay mensaje!";
					}
					?>
  
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <?php
						$usuarios = new Usuarios();
						$usuarios->usuario = $_SESSION['logeado'];
						$usuarios->traerUsuario();
						
						$notificaciones = new Notificaciones();
						$notificaciones->id_Usuario = $usuarios->id;
					?>
					<a href="#" <?php if($notificaciones->extraerNotificaciones()) {echo 'style = "color: orange"';}?> class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret "></b></a>
                    
					<ul class="dropdown-menu alert-dropdown">
					
					<?php
						//echo "<br><br><br><br><br>".$notificaciones->extraerNotificaciones(); 
						//var_dump($notificaciones->extraerNotificaciones());
						//$todo = $notificaciones->extraerEstudiantes();
						$suceso = "label-danger";
						
						foreach ( $notificaciones->extraerNotificaciones() as $notificacion){
						
						if($suceso == "label-danger"){
							$suceso = "label-warning";
						}else if ($suceso == "label-warning"){
							$suceso = "label-info";
						}else if ($suceso == "label-info"){
							$suceso = "label-danger";
						}
						// if ($notificacion['notificacion'] == "aprobado"){
							// $suceso == "label-success";
						// }
					?>
						
						<li> 
                            <a><span class="label <?php echo $suceso; ?>"><?php echo $notificacion['notificacion']?></span></a>
							<a href="<?php echo basename($_SERVER['PHP_SELF']);?>?delete=<?php echo $notificacion['id'];?>"><center><button class = "btn <?php echo $suceso; ?> btn-xs">Eliminar</button></center></a>
                        </li>
					<?php
						}
						if(!$notificaciones->extraerNotificaciones()){
							echo "No hay notificaciones que mostrar!";
						}
					?>
                    </ul>
                </li>
                
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php 
					
						if(isset ($_SESSION['logeado'])){
							$usuarios = new Usuarios();
							
							$usuarios->usuario = $_SESSION['logeado'];
							$usuarios->traerUsuario();
							echo $usuarios->nombre;
						}
					
					?> 
					
					<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
						
						<li>
                            <a href="inscripcion.php"><i class="fa fa-fw fa-edit"></i> Inscripci&oacute;n</a>
                        </li>
						
                        <li>
                            <a href="mensajeria.php"><i class="fa fa-fw fa-envelope"></i> Mensajería</a>
                        </li>
                        <li>
                            <a href="configuracion.php"><i class="fa fa-fw fa-gear"></i> Configuración</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
		

<?php
	}
	function __destruct(){
	
?>		

					
		<div class="nav navbar-fixed-bottom">
			<div id="pie" id="pie" style = "font-size:16; background-color: #4A66A0; color:white;">Derechos reservados para Leandro Jim&eacute;nez | Estudiante de Software. </div>
		</div>


		<!-- /#wrapper -->

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

<?php
	}
}
?>