<?php
	$modulo="Menu";

	//Creo instancia de la clase de Menus
	$objMenus=New Menus();

	
	
	$aWhere=array();
	$aWhere['estado_registro']=1;
	$aMenus=$objMenus->buscar($aWhere);

	unset($aWhere);
	$aWhere['estado_registro']=1;
	$aWhere['idpadre']=0;
	$MenusPadre=$objMenus->buscar($aWhere);

	if (isset($_POST['identificador']))
	{
		unset($aWhere);
		$aWhere['id']=$_POST['identificador'];
		$Menus=$objMenus->buscar($aWhere);

	}

	
	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			include($directorio."/add_edit.php");
		break;
		case 'ACTION':
			include($directorio."/action.php");
		break;
		default:
			if ($oUsuario->getRol_numero()!=SUPERADMIN):
				if (!isset($_REQUEST['m']))
				{
					echo "No tiene permisos para acceder a esta opcion, datos faltantes";
					die();
				}
				else if ($_REQUEST['m']=="")
				{
					?>
					<script type="text/javascript">
						location.href='<?=BASE_URL;?>';
					</script>
					<?php
				}
				
				unset($aWhere);
				$aWhere['rol_numero']=$oUsuario->getRol_numero();
				$aWhere['idmenu']=$_REQUEST['m'];
				
				$aPermitir=$objPermiso->buscar($aWhere);
				$permParaAgregar=0;
				$permParaModificar=0;
				$permParaEliminar=0;
				if($aPermitir[0]->getAgregar())
					$permParaAgregar=1;
				
				if ($aPermitir[0]->getModificar())
					$permParaModificar=1;
				if ($aPermitir[0]->getEliminar())
					$permParaEliminar=1;

			endif;
			include($directorio."/consultar.php");
		break;
	}

?>