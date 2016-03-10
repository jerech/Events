<?php
	$modulo = 'Asistentes';
	//Creo instancia de la clase de Asistentes
	$objAsistente=New Asistentes();

	
	//Creo instancia de la clase de Roles
	$objRoles=New Roles();

	//Creo instancia de la clase de Identificaciones
	$objIdentificacion=New Identificaciones();


    //Creo instancia de la clase de Identificaciones
	$objEvento=New Eventos();

	$objZona=New Zonas();
	$objTipo=New TipoAsistentes();
	

	$aWhere=array();
	$aOrWhere=array();
	$aWhere['estado_registro IN']="(1,2)";
	$empresanumero='';
	$usuarionumero='';
			
	if ($oUsuario->getRol_numero()!=SUPERADMIN)
	{
		$empresanumero=$oUsuario->getEmpresa_numero();
		$usuarionumero=$oUsuario->getUsuario_numero();
			
		$aWhereRol['rol_numero']=$oUsuario->getRol_numero();
		$aRolNivel=$objRoles->buscar($aWhereRol);
		$nivelIni=$aRolNivel[0]->getNivel();
		$In="(".$oUsuario->getUsuario_numero().")";
		
		
		$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
		
		//$aOrWhere['usuario_numero IN']=$In;
	}
	//echo $In;

	$aWhereA['estado']=1;
	if ($oUsuario->getRol_numero()!=SUPERADMIN)
	{
		$aWhereA['empresa_numero']=$oUsuario->getEmpresa_numero();
	}

	$aAsistentes=$objAsistente->buscar($aWhereA);

	
	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	unset($aWhere);
	$aWhere['estado_registro']=1;
    $aWhere['rol_numero <>']=SUPERADMIN;
    
	$Roles=$objRoles->buscar($aWhere);

	unset($aWhere);
	$aWhere['estado_registro']=1;
	if ($oUsuario->getRol_numero()!=SUPERADMIN)
	{
		$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
	}
	$Empresas=$objEmpresas->buscar($aWhere);

	if (isset($_POST['identificador']))
	{
		unset($aWhere);
		$aWhere['id']=$_POST['identificador'];
		$Asistentes=$objAsistente->buscar($aWhere);

	}

	if (isset($_POST['asistentes_asociar']))
	{
		if ($_POST['asistentes_asociar']!="")
		{
			$aId=split(",",$_POST['asistentes_asociar']);
			$aCodigos=$_POST['codigos'];
			$arrAsevento=array();
			if (isset($_POST['asevento_id_evento']))
			{
				$arrAsevento=$_POST['asevento_id_evento'];
			}

			$quitarAnterior="0";

			if (isset($_POST['quitarAsociacion']))
			{
				$quitarAnterior="1";
			}
			$i=0;
			foreach($aId as $value)
			{
				$objAsistente->setCodigo($aCodigos[$i]);
				$objAsistente->setId($value);
				$i++;
				$result_save=$objAsistente->asociar($arrAsevento,$quitarAnterior);
			}
		$accion="consultar";
		}
	}

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	$objEvento=New Eventos();



	
	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			unset($aWhere);
			

		

			unset($aWhere);
			$aWhere['estado']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Identificaciones=$objIdentificacion->buscar($aWhere);
			$Eventos=$objEvento->buscar($aWhere);

			include($directorio."/add_edit.php");
		break;
		case 'EDIT_PASS':
			if (!isset($Asistentes))
			{
				echo "No tiene permisos para acceder a esta opcion, datos faltantes";
				die();
			}
			include($directorio."/add_edit_pass.php");
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

			unset($aWhere);
			$aWhere['estado']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Eventos=$objEvento->buscar($aWhere);

			include($directorio."/consultar.php");
		break;
	}

?>