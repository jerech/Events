<?php
//Creo instancia de la clase de Empresas
$objTipo=New Tipos_novedad();

if (isset($_POST['id']))
{
	$objTipo->setNombre($_POST['nombre']);
	$objTipo->setEstado_registro($_POST['estado']);
	$objTipo->setDescripcion($_POST['descripcion']);
	$objTipo->setEmpresa_numero($_POST['empresa_numero']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objTipo->agregar();
	}
	else
	{
		$objTipo->setId($_POST['id']);

		$result_save=$objTipo->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objTipo->setId($_POST['eliminar']);
			$objTipo->setEstado_registro('3');
			$result_save=$objTipo->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>tipos_novedad/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>