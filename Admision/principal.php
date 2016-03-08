<?php
	include("plantilla.php");
?>
	
<div class="container-fluid">
	<div class="container">
		<div class= "row">
			<font style = "font-family: Tahoma; font-size: 35px; text-align: center; font-style: ITALIC;"><p class = ""  style = "margin-top: 10px; "> Sistema de Admisi&oacute;n - VMeta</p></font>
		</div>
	</div>
	
	<div class="row">
		<br>
		<div class="content-section-b">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
						<hr class="section-heading-spacer">
						<div class="clearfix"></div>
						<h2 class="section-heading">Misi&oacute;n</h2>
						<p class="lead"><?php if (is_file("data/mision.dat")){echo file_get_contents("data/mision.dat");} else { echo "No existe.";}?></p>
					</div>
					<div class="col-lg-5 col-sm-pull-6  col-sm-6">
						<img style="width:327; height:331" class="img-responsive" src="imagenes/mision.png" alt="">
					</div>
				</div>
			</div>
		</div>
		
		<div class="content-section-a">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-sm-6">
						<hr class="section-heading-spacer">
						<div class="clearfix"></div>
						<h2 class="section-heading">Visi&oacute;n </h2>
						<p  class="lead"><?php if (is_file("data/vision.dat")){echo file_get_contents("data/vision.dat");} else { echo "No existe.";}?></p>
					</div>
					<div class="col-lg-5 col-lg-offset-2 col-sm-6">
						<img style="width:327; height:331" class="img-responsive" src="imagenes/vision.png" alt="">
					</div>
				</div>
			</div>
		</div>
		
		<div class="content-section-b">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
						<hr class="section-heading-spacer">
						<div class="clearfix"></div>
						<h2 class="section-heading">Valores</h2>
						<?php
							$verificador = true;
							if(is_file("data/valores.dat")){
								$datos = file_get_contents("data/valores.dat");
								$datos = json_decode($datos);
								$verificador = false;
							}
						?>
		
						<ul class="lead">
						<li><?php if ($verificador){echo "Valor #1";}else{echo $datos->value1;}?>.   </li>
						<li><?php if ($verificador){echo "Valor #2";}else{echo $datos->value2;}?>.    </li>
						<li><?php if ($verificador){echo "Valor #3";}else{echo $datos->value3;}?>. </li>
					<?php if ($verificador || !trim($datos->value4)){}else{ echo "<li>{$datos->value4}.</li>"; } ?>
					<?php if ($verificador || !trim($datos->value5)){}else{ echo "<li>{$datos->value5}.</li>"; } ?>
					</ul><br><br><br><br><br>
					</div>
					<div class="col-lg-5 col-sm-pull-6  col-sm-6">
						<img style="width:200; height:331" class="img-responsive" src="imagenes/valores.png" alt="">
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
	
	
	
	
	
	<!-- <div class="page-body" style="margin-bottom: 10px;">
			<br><br><br><font style = "font-family: Tahoma; font-size: 25px; text-align: center; font-style: BOLD;"><p>Misi&oacute;n</p></font>
			<p></p>-->