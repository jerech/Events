<?php
//Creo instancia de la clase de Empresas
$objZona=New Zonas();

if (isset($_POST['id']))
{
	$objZona->setEstado_registro($_POST['estado']);
	$objZona->setDescripcion($_POST['descripcion']);
	$objZona->setEmpresa_numero($_POST['empresa_numero']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objZona->agregar();
	}
	else
	{
		$objZona->setId($_POST['id']);

		$result_save=$objZona->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objZona->setId($_POST['eliminar']);
			$objZona->setEstado_registro('3');
			$result_save=$objZona->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>zonas/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>