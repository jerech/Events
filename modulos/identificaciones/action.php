<?php
//Creo instancia de la clase de Empresas
$objIdentificacion=New Identificaciones();

if (isset($_POST['id']))
{
	$objIdentificacion->setEstado_registro($_POST['estado']);
	$objIdentificacion->setNombre($_POST['nombre']);
	$objIdentificacion->setEmpresa_numero($_POST['empresa_numero']);
	$objIdentificacion->setColor($_POST['color']);
	$objIdentificacion->setId_zona($_POST['id_zona']);
	$objIdentificacion->setId_tipo($_POST['id_tipo']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objIdentificacion->agregar();
	}
	else
	{
		$objIdentificacion->setId($_POST['id']);

		$result_save=$objIdentificacion->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objIdentificacion->setId($_POST['eliminar']);
			$objIdentificacion->setEstado_registro('3');
			$result_save=$objIdentificacion->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>identificaciones/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>