<?php
	include("plantillaAdministrador.php");
	$administradores = new Administradores();
	$formato2 = "form-group";
	if($_POST){

		if(trim($_POST['admin'])&& trim($_POST['contrasena'])){
			
			$verificador = true;
			
			foreach (Usuarios::extraerUsuarios() as $usuario){
				if($usuario['usuario'] == $_POST['admin'] ){
					$verificador = false;
					break;
				}
			}
			$administradores->admin = $_POST['admin'];
			
			if($verificador && $administradores->traerAdministradores() == 0){
				$administradores->admin = $_POST['admin'];
				$administradores->clave = $_POST['contrasena'];
				$administradores->guardarEditar();
			}else{
						echo <<<CODE
				<script>
					window.onload = function (){
						$('#formulario').modal({show: 'true'}); 
					}
				</script>
CODE;
				$formato2 = "form-group has-error";
				$mensaje = "<p class='text-center text-danger'>Ya existe este nombre de usuario, favor elegir otro!</p>";
			}
			
		}
	}
	if(isset($_GET['del'])){
		$administradores->id = $_GET['del'];
		$administradores->borrarAdministrador();
	}
?>

			<div class="row">
				<div class="page-header" style="margin-top:50px;">
					<h2 class="text-center text-info">Gestionar administradores <small> Sistema Admisi&oacute;n</small></h2>
				</div>
				<center>
					<a style="margin-bottom: 15px" href="#formulario" class= "btn btn-success btn-lg"  data-toggle = "modal" data-target="#formulario"><span class="glyphicon glyphicon-plus"></span> Agregar Admin</a>
				</center>
				<div class ="modal fade" id="formulario">
					<div class= "modal-dialog">
						<div class="modal-content">
							<div class = "modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
								<h3 class = "modal-title text-center">Datos admin</h3>
							</div>
							<div class="modal-body">
								<form action=""  method="post" class="form-horizontal" enctype="multipart/form-data">

									<div class="<?php echo $formato2; ?>">
										<label class="control-label col-md-2">Admin: </label>
										<div class="col-md-10">
											<input class="form-control" value="<?php //if($_POST){ echo $_POST['marca'];}else{ echo $carro->marca;} ?>" type="text" name="admin" placeholder="Nombre del usuario"/>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2" >Contrase&ntilde;a: </label>
										<div class="col-md-10">
											<input  class="form-control" value="<?php //if($_POST){ echo $_POST['año'];}else{ echo $carro->ano;} ?>" type="text" name="contrasena" placeholder="Clave de acceso"/>
										</div>
									</div>
									<?php echo $mensaje;?>
									<div class="modal-footer">
										<button class="btn btn-primary btn-md"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
										<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
					<div class ="panel-group" id= "accordion" role= "trablist" style="padding:50px">	
						<div class ="panel panel-info">
							<div class="panel-heading" role= "tab" id ="heading1">
								<h3 class="panel-title">
									<a href = "#collapse1" data-toggle= "collapse" data-parent="#accordion" style="font-size:20px; text-decoration:none">
										Administradores
									</a>
								</h3>
								<div style="float:right; font-size: 90%; position: relative; top:-10px"><label class='text-danger'>Cantidad: <?php echo count(Administradores::extraerAdministradores());?></label></div>
							</div>
							<div id= "collapse1" class = "panel-collapse collapse in">
								<div class = "panel-body">
						 <?php
						 $date = date('d/m/Y');
						 
						 
						 if (Administradores::extraerAdministradores()){
							foreach(Administradores::extraerAdministradores() as $administradores)
							{
						?>
								<p  style="font-size:21px; font-family: Courier New;" >
									<b>Admin:</b><?php echo $administradores['admin'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</p>
								<p  style="font-size:21px; font-family: Courier New;" >
									<a href = "administrar_usuarios.php?del=<?php echo $administradores['id'];?>" onclick="confirm('&iquest;Seguro que deseas borrar al administrador <?php echo $administradores['admin'];?> ? , S&iacute; aceptas no podr&aacute;s recuperar sus datos nuevamente.');" class='btn btn-danger pull-right'><span class="glyphicon glyphicon-trash"></span> Borrar</a>
									<b>Contrase&ntilde;a:</b> <?php for ($i = 0; $i<strlen($administradores['clave']); $i++){ echo "*";}?>
								</p>
								<p  style="font-size:21px; font-family: Courier New;" > 
									<b>Fecha ingreso:</b> <?php echo $administradores['fecha'];?>
								</p>
								<hr>
						<?php

							}
							}else{
								echo "<p class='text-center text-muted'><strong>No hay administradores para mostrar, solo existes tu!</strong></p>";
							}
						 ?>
								</div>
							</div>
						</div>
					</div>
				
			</div>