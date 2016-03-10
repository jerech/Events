<?php
//Creo instancia de la clase de usuarios
$objAsistente=New Asistentes();

if (isset($_POST['id']))
	{
		

	
		$objAsistente->setNombre($_POST['nombre']);
		$objAsistente->setApellido($_POST['apellido']);
		$objAsistente->setTelefono($_POST['telefono']);
		$objAsistente->setEmail($_POST['email']);
		$objAsistente->setEstado_registro($_POST['estado']);
		$objAsistente->setEmpresa_numero($_POST['empresa_numero']);
		$objAsistente->setEs_acompaniante(0);
		$objAsistente->setDocumento($_POST['documento']);
		$objAsistente->setId_identificacion($_POST['id_identificacion']);

		
		if ($_POST['id']=="")
		{
			
			$result_save=$objAsistente->agregar();
		}
		else
		{
			$objAsistente->setId($_POST['id']);

			$result_save=$objAsistente->modificar();
		}
	}

	

	if (isset($_POST['eliminar']))
	{
		if ($_POST['eliminar']!="")
		{
			$aId=split(",",$_POST['eliminar']);
			foreach($aId as $value)
			{
				$objAsistente->setId($value);
				$objAsistente->setEstado_registro('3');
				$result_save=$objAsistente->eliminar();
			}
		}
	}

?>
<form name="formulario" action="<?=BASE_URL;?>asistentes/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>