<?php
//Creo instancia de la clase de Empresas
$objArea=New Areas();

if (isset($_POST['id']))
{
	$objArea->setNombre($_POST['nombre']);
	$objArea->setEstado_registro($_POST['estado']);
	$objArea->setDescripcion($_POST['descripcion']);
	$objArea->setEmpresa_numero($_POST['empresa_numero']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objArea->agregar();
	}
	else
	{
		$objArea->setId($_POST['id']);

		$result_save=$objArea->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objArea->setId($_POST['eliminar']);
			$objArea->setEstado_registro('3');
			$result_save=$objArea->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>areas/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>