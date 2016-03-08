<?php
	include("plantillaAdministrador.php");
	
	if(isset($_GET['del'])){
		$mensaje = new Mensajes();
		$mensaje->borrarMensaje($_GET['del']);
		header("Location: mensajeriaAdmin.php");
	}
	
?>

	<br>
	<div class="panel-heading">
		<div class="panel-title text-center"><font size="6">Mensajer&iacute;a</font></div>
	</div>  
	<div style="padding-top:30px" class="panel-body" style = "padding: 10px;">
		<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>									
		<div class="list-group">
			
		<?php
		if(Mensajes::extraerMensajes()){
				foreach(Mensajes::extraerMensajes() as $mensaje){
		?>
			<a href = "verMensajeAdmin.php?nm=<?php echo $mensaje['id']?>" style = "text-decoration: none">
				<div  class="list-group-item">
					
					<h4 class="pull-right text-danger">Fecha: "<?php echo date('d-m-20y',strtotime($mensaje['fecha'])); ?>"</h4>
					<h4 class="list-group-item-heading">Solicitante: <?php echo $mensaje['usuario']; ?></h4>
					<p class="list-group-item-text"><?php echo $mensaje['asunto']; ?>&nbsp;&nbsp;&nbsp;	</a> <a href = "mensajeriaAdmin.php?del=<?php echo $mensaje['id'];?>"><button  class = "btn btn-danger btn-xs">borrar</button></a></p>
				</div>

		<?php
				}
		}else{
			echo "<p class='text-center text-muted' style='margin-top:150px; font-size: 60px; font-family: Courier New;'>No hay mensajes para mostrar!</strong></p>";
		}
		?>	
		</div>
	</div>