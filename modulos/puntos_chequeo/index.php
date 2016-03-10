<?php
	$modulo = 'Puntos Chequeo';

	//Creo instancia de la clase de turnos
	$objPuntos=New Puntos_chequeo();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	//Creo instancia de la clase de Areas
	$objArea=New Areas();

	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			if (isset($_POST['identificador']))
			{
				unset($aWhere);
				$aWhere['id']=$_POST['identificador'];
				$Punto=$objPuntos->buscar($aWhere);

			}
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Empresas=$objEmpresas->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			$Areas=$objArea->buscar($aWhere);
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
			$aWhere=array();
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$aPuntos=$objPuntos->buscar($aWhere);
			include($directorio."/consultar.php");
		break;
	}
?>