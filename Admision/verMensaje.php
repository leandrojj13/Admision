<?php
	include("plantilla.php");
	if (isset($_GET['nm'])){
		$mensajes = new MensajesEstudiantes();
		$mensajes->id = $_GET['nm'];
		$mensajes->traerMensaje();
?>
<div class ="container-fluid">
	<div style="margin-top:150px; margin-bottom:10px; border-radius: 10px; box-shadow: 0 0 5px #0070B0;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class= "page-header">
			<center><h1 id="titulo"><strong>Asunto</strong><small> <?php echo $mensajes->asunto; ?></small></h1></center>
		</div>	
		
		<div class="page-body" style="margin-bottom: 10px;">
			<font size= "4" style="font-family: Courrier New; font-weight: normal;"><p><?php echo $mensajes->cuerpo; ?></p></font>
		</div>
	</div>
</div>
<?php
	}
?>