<?php
	include("plantilla.php");
	if(isset($_GET['del'])){
		$mensaje = new MensajesEstudiantes();
		$mensaje->borrarMensaje($_GET['del']);
		header("Location: mensajeriaAdmin.php");
	}
?>
<div class ="container-fluid">
	<br>
	<div class="panel-heading">
		<div class="panel-title text-center"><font size="6">Mensajer&iacute;a</font></div>
	</div>  
	<div style="padding-top:30px" class="panel-body" >
		<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>									
		<div class="list-group">
					
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
			<a href = "verMensaje.php?nm=<?php echo $mensaje['id'];?>" style = "text-decoration: none">
				<div  class="list-group-item">
					<h4 class="pull-right text-danger">Fecha: <?php echo date('d-m-20y',strtotime($mensaje['fecha'])); ?></h4>
					<h4 class="list-group-item-heading">Administrador</h4>
					<p class="list-group-item-text"><?php echo $mensaje['asunto']; ?>&nbsp;&nbsp;&nbsp;	</a> <a href = "mensajeria.php?del=<?php echo $mensaje['id'];?>"><button  class = "btn btn-danger btn-xs">borrar</button></a></p>
				</div>
			</a>
		<?php
				}
			}else{
				echo "<p class='text-center text-muted' style='margin-top:120px; font-size: 65px; font-family: Courier New;'>Esperando por mensajes para mostrar !</strong></p>";
			}
		?>
		</div>
	</div>
</div>
				