<?php
//Creo instancia de la clase de Empresas
$objRuta=New Rutas();

if (isset($_POST['id']))
{
	$objRuta->setNombre($_POST['nombre']);
	$objRuta->setEstado_registro($_POST['estado']);
	$objRuta->setDescripcion($_POST['descripcion']);
	$objRuta->setEmpresa_numero($_POST['empresa_numero']);
	$objRuta->setTiempo($_POST['tiempo']);
	
	$array_puntos=array();
	if (isset($_POST['puntos']))
	{
		if (count($_POST['puntos'])>0)
		{
			foreach($_POST['puntos'] as $val)
			{
				$array_puntos[]=$val;
			}
		}
	}
	
	if ($_POST['id']=="")
	{
		$result_save=$objRuta->agregar($array_puntos);
	}
	else
	{
		$objRuta->setId($_POST['id']);

		$result_save=$objRuta->modificar($array_puntos);
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objRuta->setId($_POST['eliminar']);
			$objRuta->setEstado_registro('3');
			$result_save=$objRuta->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>rutas/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>