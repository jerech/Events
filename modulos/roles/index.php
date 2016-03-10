<?php
	$modulo = 'Roles';
	//Creo instancia de la clase de Roles
	$objRoles=New Roles();

	//Creo instancia de la clase de Perm_rol_menu
	$objPermiso=New Perm_rol_menu();

	//Creo instancia de la clase de Menus
	$objMenus=New Menus();

	if (isset($_POST['result_save']))
	{
		$result_save=$_POST['result_save'];
	}	
	
	
	$aWhere=array();
	$aWhere['estado_registro']=1;
	$aRoles=$objRoles->buscar($aWhere);

	if (isset($_POST['identificador']))
	{
		unset($aWhere);
		$aWhere['id']=$_POST['identificador'];
		$Roles=$objRoles->buscar($aWhere);

	}

	
	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			include($directorio."/add_edit.php");
		break;
		case 'EDIT_PERM':
			if (!isset($Roles))
			{
				echo "No tiene permisos para acceder a esta opcion, datos faltantes";
				die();
			}
			
			unset($aWhere);
			$aWhere['estado_registro']=1;
			$aWhere['idpadre']=0;
			$MenusPadre=$objMenus->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			$aWhere['idpadre<>']=0;
			$MenusHijo=$objMenus->buscar($aWhere);

			unset($aWhere);
			$aWhere['rol_numero']=$Roles[0]->getRol_numero();
			
			$aPermisos=$objPermiso->buscar($aWhere);
			

			include($directorio."/add_edit_perm.php");
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