<?php
//Creo instancia de la clase de Empresas
$objMenus=New Menus();

if (isset($_POST['id']))
{
	$objMenus->setNombre($_POST['nombre']);
	$objMenus->setIcono(str_replace("'",'"',$_POST['icono']));
	$objMenus->setEstado_registro($_POST['estado']);
	$objMenus->setDestino($_POST['destino']);
	$objMenus->setIdpadre($_POST['idpadre']);

	if ($_POST['id']=="")
	{
		$result_save=$objMenus->agregar();
	}
	else
	{
		$objMenus->setId($_POST['id']);

		$result_save=$objMenus->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objMenus->setId($_POST['eliminar']);
			$objMenus->setEstado_registro('3');
			$result_save=$objMenus->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>menus/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>