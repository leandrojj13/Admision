<?php
	include("plantilla.php");
	
	$usuarios = new Usuarios();
	$usuarios->usuario = $_SESSION['logeado'];
	$usuarios->traerUsuario();
	$verificador = true;
	if ($_POST){
		foreach (Usuarios::extraerUsuarios() as $usuario){
			if($usuario['email'] == $_POST['email'] && $usuario['email'] != $usuarios->email ){
				$verificador = false;
				break;
			}
		}
		if($verificador){
			if(trim($_POST['nombre']) && trim($_POST['telefono']) && trim($_POST['email'])){
				$usuarios->nombre = $_POST['nombre'];
				$usuarios->telefono = $_POST['telefono'];
				$usuarios->celular = $_POST['celular'];
				$usuarios->email = $_POST['email'];
				$usuarios->guardarEditar();
				
				if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0 ){						
					$foto = $_FILES['foto'];
					move_uploaded_file($foto['tmp_name'], "fotosUsuarios/{$usuarios->id}.png");
				}
			}
		}
	}
?>
	<div class ="container-fluid">
		<div class= "page-header"style = "margin-bottom: 4;">
			<center><h1 id="titulo"><strong>Perfil <small>Usuario</small></h1></center>
		</div>
		
		<div class= "page-body " >
			<center>	
				<div  style="margin-bottom:10px;">
					<img  class="img-circle" style = "width: 125px; height: 125px;"src="imagen.php?id=<?php echo $usuarios->id;?>" />
				</div>
			</center>
			<form action=""  method="post" class="form-horizontal" enctype="multipart/form-data">
			
				<div class="form-group">
					<label for="firstname" class="col-md-2 control-label">Nombre Completo:</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="nombre" value="<?php echo $usuarios->nombre; ?> " placeholder="Campo Obligatorio">
					</div>
				</div>
				<div class="form-group">
					<label for="icode" class="col-md-2 control-label">Celular:</label>
					<div class="col-md-10">
						<input type="tel" class="form-control" name="celular" value="<?php echo $usuarios->celular; ?>" placeholder="Opcional">
					</div>
				</div>
				
				<div class="form-group">
					<label for="icode"  class="col-md-2 control-label">Tel&eacute;fono:</label>
					<div class="col-md-10">
						<input type="tel" class="form-control" name="telefono" value="<?php echo $usuarios->telefono; ?>" placeholder="Campo Obligatorio">
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-md-2 control-label">Correo Electr&oacute;nico:</label>
					<div class="col-md-10">
						<input type="email" class="form-control" name="email" value="<?php echo $usuarios->email; ?>"  placeholder="Campo Obligatorio">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Foto: </label>
					<div class="col-md-1">
						<span class="btn btn-default btn-file">
							Subir foto &hellip;<input class="form-control-static" type="file" name="foto"/>
						</span>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-12 control">
						<div style="font-size:100%; color:red;">

						</div>
					</div>
				</div>
				
					<div class="modal-footer">
					<center>
						<button class="btn btn-primary btn-md" type = "submit"><span class="glyphicon glyphicon-ok-sign"></span> Guardar Cambios</button>
					</center>
				</div>
			</form>
		</div>	
	</div>	