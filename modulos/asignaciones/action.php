<?php
//Creo instancia de la clase de Empresas
$objAsignacion=New Asignaciones();

$objRuta=New Rutas();

if (isset($_POST['id']))
{
	$objAsignacion->setAsunto($_POST['asunto']);
	$objAsignacion->setEstado_registro($_POST['estado']);
	$objAsignacion->setUsuario_numero($_POST['usuario_numero']);
	$objAsignacion->setEmpresa_numero($_POST['empresa_numero']);
	$objAsignacion->setPaciente($_POST['paciente']);
	$objAsignacion->setCedula('');
	$objAsignacion->setIdtipoasignacion('');
	$objAsignacion->setResponsable($oUsuario->getUsuario_numero());
	
	$array_puntos=array();
	// if ($_POST['idruta']=="")
	// {
		$array_puntos[]=array("idpunto"=>$_POST['punto_inicio'],"idruta"=>"0");
		$array_puntos[]=array("idpunto"=>$_POST['punto_final'],"idruta"=>"0");
	// }
	// else
	// {
	// 	$objRuta->setId($_POST['idruta']);
	// 	$Puntos=$objRuta->getPuntosChequeo();
	// 	foreach($Puntos as $arr)
	// 	{
	// 		$array_puntos[]=array("idpunto"=>$arr['idpunto'],"idruta"=>$_POST['idruta']);
	// 	}
	// }
	//var_dump($array_puntos);die();
	if ($_POST['id']=="")
	{
		$result_save=$objAsignacion->agregar($array_puntos);
	}
	else
	{
		$objAsignacion->setId($_POST['id']);

		$result_save=$objAsignacion->modificar($array_puntos);
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objAsignacion->setId($_POST['eliminar']);
			$objAsignacion->setEstado_registro('3');
			$result_save=$objAsignacion->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>asignaciones/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>