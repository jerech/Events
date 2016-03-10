<?php
//Creo instancia de la clase de Empresas
$objEmpresas=New Empresas();

if (isset($_POST['id']))
{
	if ($_FILES["logo_empresa"]["error"] == 0) {
		$name = $_FILES["logo_empresa"]["name"];
		$tmp_name = $_FILES['logo_empresa']['tmp_name'];

		$array_name = explode(".", $name);
		$extension = end($array_name);

		//$ultimoId = $objClientes->getUltimoId();
		$ultimoId =date('YmdHmmss');

		$uploadfile = 'img/imagenes_empresas/' . $ultimoId . '.' . $extension;
		$uploadfileTmp = '/img/imagenes_empresas/' . $ultimoId . '.' . $extension;
		
		$logo_empresa = 'http://nativoapps.com/NFC' . $uploadfileTmp;

		move_uploaded_file($tmp_name, $uploadfile);
	} else {
		$logo_empresa = $_POST['url_logo_empresa'];
	}
	if ($_FILES["background_movil"]["error"] == 0) {
		$name = $_FILES["background_movil"]["name"];
		$tmp_name = $_FILES['background_movil']['tmp_name'];

		$array_name = explode(".", $name);
		$extension = end($array_name);

		//$ultimoId = $objClientes->getUltimoId();
		$ultimoId =date('YmdHmmss');

		$uploadfile = 'img/imagenes_empresas/' . $ultimoId . '.' . $extension;
		$uploadfileTmp = '/img/imagenes_empresas/' . $ultimoId . '.' . $extension;
		
		$background_movil = 'http://nativoapps.com/NFC' . $uploadfileTmp;

		move_uploaded_file($tmp_name, $uploadfile);
	} else {
		$background_movil = $_POST['url_background_movil'];
	}
	$objEmpresas->setTipo_documento($_POST['tipo_documento']);
	$objEmpresas->setDocumento($_POST['documento']);
	$objEmpresas->setNombre_empresa($_POST['nombre_empresa']);
	$objEmpresas->setEstado_registro($_POST['estado_registro']);
	$objEmpresas->setContacto($_POST['contacto']);
	$objEmpresas->setTelefono($_POST['telefono']);
	$objEmpresas->setEmail($_POST['email']);
	$objEmpresas->setFecha_inicio($_POST['fecha_inicio']);
	$objEmpresas->setFecha_corte($_POST['fecha_corte']);
	$objEmpresas->setDias_corte($_POST['dias_corte']);
	$objEmpresas->setCantidad_usuarios($_POST['cantidad_usuarios']);
	$objEmpresas->setPaquete($_POST['paquete']);
	//$objEmpresas->setCiudad($_POST['ciudad']);
	$objEmpresas->setCiudad('');
	$objEmpresas->setDireccion($_POST['direccion']);
	$objEmpresas->setLogo_empresa($logo_empresa);
	$objEmpresas->setBackground_inicial($_POST['background_inicial']);
	$objEmpresas->setFooter_empresa($_POST['footer_empresa']);
	$objEmpresas->setBackground_movil($background_movil);
	$objEmpresas->setEstado_registro($_POST['estado_registro']);
	$objEmpresas->setDias_prueba($_POST['dias_prueba']);
	$objEmpresas->setEtapa($_POST['etapa']);
	
	
	if ($_POST['id']=="")
	{
		
		$result_save=$objEmpresas->agregar();
	}
	else
	{
		$objEmpresas->setId($_POST['id']);

		$result_save=$objEmpresas->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objEmpresas->setId($value);
			$objEmpresas->setEstado_registro('3');
			$result_save=$objEmpresas->eliminar();
		}
	}
}


?>
<form name="formulario" action="<?=BASE_URL;?>empresas/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>