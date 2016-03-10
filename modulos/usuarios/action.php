<?php
//Creo instancia de la clase de usuarios
$objUsuario=New Usuarios();

if (isset($_POST['id']))
	{
		if ($_FILES["imagen"]["error"] == 0) {
			$name = $_FILES["imagen"]["name"];
			$tmp_name = $_FILES['imagen']['tmp_name'];

			$array_name = explode(".", $name);
			$extension = end($array_name);

			//$ultimoId = $objClientes->getUltimoId();
			$ultimoId =date('YmdHmmss');

			$uploadfile = 'img/imagenes_usuarios/' . $ultimoId . '.' . $extension;
			$uploadfileTmp = '/img/imagenes_usuarios/' . $ultimoId . '.' . $extension;
			
			$imagen = 'http://nativoapps.com/NFC' . $uploadfileTmp;

			move_uploaded_file($tmp_name, $uploadfile);
		} else {
			$imagen = $_POST['url_imagen'];
		}

		$objUsuario->setImagen($imagen);
		$objUsuario->setNombre($_POST['nombre']);
		$objUsuario->setCodigo($_POST['codigo']);
		$objUsuario->setTelefono($_POST['telefono']);
		$objUsuario->setEmail($_POST['email']);
		$objUsuario->setRol_numero($_POST['rol_numero']);
		$objUsuario->setEstado_registro($_POST['estado']);
		$objUsuario->setLogin($_POST['login']);
		$objUsuario->setEmpresa_numero($_POST['empresa_numero']);
		$objUsuario->setDirector_usuario($_POST['director']);
		$objUsuario->setImei($_POST['imei']);
		
		if ($_POST['id']=="")
		{
			//$objUsuario->setPassword($_POST['password']);
			$objUsuario->setPassword_movil($_POST['password_movil']);
			
			$result_save=$objUsuario->agregar();
		}
		else
		{
			$objUsuario->setId($_POST['id']);

			$result_save=$objUsuario->modificar();
		}
	}

	if (isset($_POST['id_edit_pass']))
	{
		$objUsuario->setId($_POST['id_edit_pass']);
		//$objUsuario->setPassword($_POST['password']);
		$objUsuario->setPassword_movil($_POST['password_movil']);
			
		$result_save=$objUsuario->modificarPass();
	}

	if (isset($_POST['eliminar']))
	{
		if ($_POST['eliminar']!="")
		{
			$aId=split(",",$_POST['eliminar']);
			foreach($aId as $value)
			{
				$objUsuario->setId($value);
				$objUsuario->setEstado_registro('3');
				$result_save=$objUsuario->eliminar();
			}
		}
	}

?>
<form name="formulario" action="<?=BASE_URL;?>usuarios/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>