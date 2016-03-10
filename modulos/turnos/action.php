<?php
//Creo instancia de la clase de Empresas
$objTurnos=New Turnos();

if (isset($_POST['id']))
{
	$objTurnos->setNombre($_POST['nombre']);
	$objTurnos->setEstado_registro($_POST['estado']);
	$objTurnos->setDescripcion($_POST['descripcion']);
	$objTurnos->setHora_inicio($_POST['hora_inicio']);
	$objTurnos->setHora_fin($_POST['hora_fin']);
	$objTurnos->setLunes(0);
	$objTurnos->setMartes(0);
	$objTurnos->setMiercoles(0);
	$objTurnos->setJueves(0);
	$objTurnos->setViernes(0);
	$objTurnos->setSabados(0);
	$objTurnos->setDomingo(0);
	$objTurnos->setEmpresa_numero($_POST['empresa_numero']);
	

	if (isset($_POST['lunes']))
	{
		$objTurnos->setLunes($_POST['lunes']);
	}
	if (isset($_POST['martes']))
	{
		$objTurnos->setMartes($_POST['martes']);
	}
	if (isset($_POST['miercoles']))
	{
		$objTurnos->setMiercoles($_POST['miercoles']);
	}
	if (isset($_POST['jueves']))
	{
		$objTurnos->setJueves($_POST['jueves']);
	}
	if (isset($_POST['viernes']))
	{
		$objTurnos->setViernes($_POST['viernes']);
	}
	if (isset($_POST['sabados']))
	{
		$objTurnos->setSabados($_POST['sabados']);
	}
	if (isset($_POST['domingo']))
	{
		$objTurnos->setDomingo($_POST['domingo']);
	}

	if ($_POST['id']=="")
	{
		$result_save=$objTurnos->agregar();
	}
	else
	{
		$objTurnos->setId($_POST['id']);

		$result_save=$objTurnos->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objTurnos->setId($_POST['eliminar']);
			$objTurnos->setEstado_registro('3');
			$result_save=$objTurnos->eliminar();
		}
	}
}

?>

<form name="formulario" action="<?=BASE_URL;?>turnos/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>