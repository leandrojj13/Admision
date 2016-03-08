<?php
	include("plantilla.php");
	$usuarios = new Usuarios();
	$usuarios->usuario = $_SESSION['logeado'];
	$usuarios->traerUsuario();
?>	
<div class ="container-fluid">
	<div style="margin-top:10px; margin-bottom:0px; border-radius: 10px; box-shadow: 0 0 5px #0070B0;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class= "page-header">
			<center><h1 id="titulo"><strong>Perfil <small>Usuario</small></h1></center>
		</div>	
		<div class="page-body" style="margin-bottom: 10px;">
		<center>	
			<div  style="margin-bottom:3px;">
				<img  class="img-circle" style = "width: 125px; height: 125px;"src="imagen.php?id=<?php echo $usuarios->id;?>" />
			</div>
		</center>
			<div class="alert alert-info text-center">
				<label>Nombre Completo: "<?php echo $usuarios->nombre; ?>"</label>		
			</div>

			<div class="alert alert-danger text-center">
				<label>Tel&eacute;fono: "<?php echo $usuarios->telefono; ?>"</label>	
			</div>
	
			<?php
				if ($usuarios->celular != ""){
			?>
			<div class="alert alert-success text-center">
				<label>Celular: "<?php echo $usuarios->celular; ?>"</label>	
			</div>
			<?php
				}
			?>
			<div class="alert alert-warning text-center">
				<label>Correo Electr&oacute;nico: "<?php echo $usuarios->email; ?>"</label>
			</div>
			<div class="alert text-center" style = "background-color: #D2FF77">
				<label>Estado: <?php echo $usuarios->estado; ?></label>
			</div>
		</div>
	</div>
</div>
		