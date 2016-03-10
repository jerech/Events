<?php
//Creo instancia de la clase de Empresas
$objEstado=New Estados();

if (isset($_POST['id']))
{
	$objEstado->setDescripcion($_POST['descripcion']);
	$objEstado->setEmpresa_numero($_POST['empresa_numero']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objEstado->agregar();
	}
	else
	{
		$objEstado->setId($_POST['id']);

		$result_save=$objEstado->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objEstado->setId($_POST['eliminar']);
			$result_save=$objEstado->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>estados/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>