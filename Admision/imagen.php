<?php
	$foto = "imagenes/ella.jpg";

	$verificador = (isset($_GET['id']))?$_GET['id']:'';

	$direccion = "fotosUsuarios/{$verificador}.png";

	if (is_file($direccion)){
		$foto = $direccion;
	}

	readfile($foto);