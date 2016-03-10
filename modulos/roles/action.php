<?php
//Creo instancia de la clase de Roles
$objRoles=New Roles();

if (isset($_POST['id']))
{
	$objRoles->setRol($_POST['rol']);
	$objRoles->setNivel($_POST['nivel']);
	$objRoles->setDescripcion($_POST['descripcion']);
	$objRoles->setEstado_registro($_POST['estado']);
	$objRoles->setUsuario_numero($_SESSION['usuario_numero']);

	if ($_POST['id']=="")
	{
		$result_save=$objRoles->agregar();
	}
	else
	{
		$objRoles->setId($_POST['id']);

		$result_save=$objRoles->modificar();
	}
}

if (isset($_POST['eliminar']))
{
	if ($_POST['eliminar']!="")
	{
		$aId=split(",",$_POST['eliminar']);
		foreach($aId as $value)
		{
			$objRoles->setId($_POST['eliminar']);
			$objRoles->setEstado_registro('0');
			$result_save=$objRoles->eliminar();
		}
	}
}

if (isset($_POST['id_edit_perm']))
{
	$objPermiso->setRol_numero($_POST['rol_numero']);
	
	unset($aWhere);
	$aWhere['estado_registro']=1;
	$MenusPosibles=$objMenus->buscar($aWhere);

	$arrPermisos=array();
	foreach($MenusPosibles as $objeto)
	{
		$checkPermVer=0;
        $checkPermAgregar=0;
        $checkPermModificar=0;
		$checkPermEliminar=0;
		if (count($_POST['menusCheckVer'])>0)
		{
			foreach($_POST['menusCheckVer'] as $value)
			{
				if  ($objeto->getId()==$value)
				{
					$checkPermVer=1;
				}
			}
		}
		if (count($_POST['menusCheckAgregar'])>0)
		{
			foreach($_POST['menusCheckAgregar'] as $value)
			{
				if  ($objeto->getId()==$value)
				{
					$checkPermAgregar=1;
				}
			}
		}
		if (count($_POST['menusCheckModificar'])>0)
		{
			foreach($_POST['menusCheckModificar'] as $value)
			{
				if  ($objeto->getId()==$value)
				{
					$checkPermModificar=1;
				}
			}
		}
		if (count($_POST['menusCheckEliminar'])>0)
		{
			foreach($_POST['menusCheckEliminar'] as $value)
			{
				if  ($objeto->getId()==$value)
				{
					$checkPermEliminar=1;
				}
			}
		}

		$arrPermisos[]=array("idmenu"=>$objeto->getId(),"ver"=>$checkPermVer,"agregar"=>$checkPermAgregar,"modificar"=>$checkPermModificar,"eliminar"=>$checkPermEliminar);
	}
	$result_save=$objPermiso->agregar($arrPermisos);
}
?>
<form name="formulario" action="<?=BASE_URL;?>roles/&m=<?=$_REQUEST["m"];?>" class="form-horizontal" method="post"  >
	<input type="hidden" name="m" value="<?=$_REQUEST["m"];?>" >
	<input type="hidden" name="url" value="<?=BASE_URL;?>" >
	<input type="hidden" name="result_save" value="<?=$result_save;?>" >
                                      
</form>
<script>
	document.formulario.submit();
</script>