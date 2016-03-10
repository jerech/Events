<?php
//Creo instancia de la clase de Empresas
$objTipoAsistente=New TipoAsistentes();

if (isset($_POST['id']))
{
	$objTipoAsistente->setEstado_registro($_POST['estado']);
	$objTipoAsistente->setDescripcion($_POST['descripcion']);
	$objTipoAsistente->setEmpresa_numero($_POST['empresa_numero']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objTipoAsistente->agregar();
	}
	else
	{
		$objTipoAsistente->setId($_POST['id']);

		$result_save=$objTipoAsistente->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objTipoAsistente->setId($_POST['eliminar']);
			$objTipoAsistente->setEstado_registro('3');
			$result_save=$objTipoAsistente->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>tipo_asistentes/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>