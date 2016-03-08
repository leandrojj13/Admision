<?php
	include("funciones.php");
	verificarAdministrador();	
	
	$objPlantila4459 = new PlantillaAdministrador();
	class PlantillaAdministrador{
		
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

    <title>SA Admin - VMeta</title>

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

<body style = "background-color: white;">

    <div id="wrapper">

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
                <a class="navbar-brand" href="principalAdmin.php">Sistema Admisi&oacute;n</a>
            </div>
            <!-- Top Menu Items -->
			<?php
				if (basename($_SERVER['PHP_SELF']) == 'todosEstudiantes.php'){
			?>
			<form style = "margin: 10px 0 0 490px;"class="visible-lg navbar-form navbar-left" role="search">
				  <div class="form-group">
					<input type="text" class="form-control" placeholder="Buscar">
				  </div>
			</form>

			<?php
				}
				
			?>
			<ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" <?php if(Mensajes::extraerMensajes()) {echo 'style = "color: orange"';}?>class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php 
						if(Mensajes::extraerMensajes()){
								$usuarios = new Usuarios();
								
							foreach(Mensajes::extraerMensajes() as $mensaje){
								$usuarios->usuario = $mensaje['usuario'];
								$usuarios->traerUsuario();
							?>
						<li class="message-preview">
                            <a href="verMensajeAdmin.php?nm=<?php echo $mensaje['id'];?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" width = "45px " height = "45px" src="imagen.php?id=<?php echo $usuarios->id;?>" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $mensaje['usuario']; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d-m-20y',strtotime($mensaje['fecha'])); ?></p>
                                        <p>Ha solicitado la ....</p>
                                    </div>
                                </div>
                            </a>
                        </li>
						<?php 
							} 
						}else{
							echo "No hay mensajes para mostrar!";
						}
						?>
					</ul>
                </li>
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrador <b class="caret"></b></a>
                    <ul class="dropdown-menu">
						<li>
                            <a href="mensajeriaAdmin.php"><i class="fa fa-fw fa-envelope"></i> Mensajer&iacute;a</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="principalAdmin.php"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                    </li>
        
					<li>
                        <a href="solicitudesEsperando.php"><i class="fa fa-fw fa-asterisk"></i> Solicitudes en espera</a>
                    </li>
					
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-eye-open"></i>  Vista General <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="todosEstudiantes.php?alle=genehmigt">Estudiantes aprobados</a>
                            </li>	
                            <li>
                                <a href="todosEstudiantes.php?alle=einzelnachhilfe">Todos los tutores</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="administrar_usuarios.php"><i class="fa fa-fw fa-gear"></i> Gestionar Admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

   

            <div class="container-fluid">
<?php
	}
	function __destruct(){
	
?>	

            </div>
            <!-- /.container-fluid -->

    
        <!-- /#page-wrapper -->

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