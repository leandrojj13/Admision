<?php
	include("plantillaAdministrador.php");

	if (isset($_GET['nm'])){
		$mensajes = new Mensajes();
		$mensajes->id = $_GET['nm'];
		$mensajes->traerMensaje();
?>

	<div style="margin-top:150px; margin-bottom:10px; border-radius: 10px; box-shadow: 0 0 5px #0070B0;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class= "page-header">
			
			<h1 id = "titulo"><strong>De: </strong><small> <?php echo $mensajes->usuario; ?>  </small></h1>
			<h3><strong>Asunto: </strong><small> <?php echo $mensajes->asunto; ?> </small></h3>
			<h3><strong>Fecha: </strong><small><?php  echo date('d-m-20y',strtotime($mensajes->fecha)); ?> </small></h3>
		</div>	
		
		<div class="page-body" style="margin-bottom: 10px;">
			<?php echo $mensajes->cuerpo; ?>
		</div>
	</div>
<?php
	}
?>