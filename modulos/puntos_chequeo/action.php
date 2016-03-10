<?php
//Creo instancia de la clase de Empresas
$objPunto=New Puntos_chequeo();

if (isset($_POST['id']))
{
	$objPunto->setNombre($_POST['nombre']);
	$objPunto->setEstado_registro($_POST['estado']);
	$objPunto->setDescripcion($_POST['descripcion']);
	$objPunto->setEmpresa_numero($_POST['empresa_numero']);
	$objPunto->setIdarea($_POST['idarea']);
	$objPunto->setPiso($_POST['piso']);
	$objPunto->setTag($_POST['tag']);
	
	
	if ($_POST['id']=="")
	{
		$result_save=$objPunto->agregar();
	}
	else
	{
		$objPunto->setId($_POST['id']);

		$result_save=$objPunto->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objPunto->setId($_POST['eliminar']);
			$objPunto->setEstado_registro('3');
			$result_save=$objPunto->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>puntos_chequeo/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>