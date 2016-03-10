<?php
	$modulo = 'Usuarios';
	//Creo instancia de la clase de usuarios
	$objUsuario=New Usuarios();

	
	//Creo instancia de la clase de Roles
	$objRoles=New Roles();


	

	$aWhere=array();
	$aOrWhere=array();
	$aWhere['estado_registro IN']="(1,2,4)";
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
		while ($nivelIni<$objRoles->getMaxNivel())
		{
			
				$aWhereHijo['director_usuario IN']=$In;
				$UsuariosHijos=$objUsuario->buscar($aWhereHijo);
				if ($UsuariosHijos)
				{
					if (count($UsuariosHijos)>0)
        			{
        				$In=substr($In,0,-1);
        				foreach($UsuariosHijos as $objetoHijo)
        				{
        					$In.=",".$objetoHijo->getUsuario_numero();
        						
        				}
        				
        			}

				}
				else
        			{
        				$In=substr($In,0,-1);
        				
        			}
			$nivelIni++;
			if ($In!="")
        	$In.=")";

		}
		
		$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
		
		$aOrWhere['usuario_numero IN']=$In;
	}
	//echo $In;

	$aUsuarios=$objUsuario->buscar($aWhere);

	
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
		$Usuarios=$objUsuario->buscar($aWhere);

	}

	//Creo instancia de la clase de roles
	$objEstados=New Estados();
	
	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if (isset($_POST['identificador']))
			{
				$aWhere['id<>']=$_POST['identificador'];
			}
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$UsuariosDirector=$objUsuario->buscar($aWhere);

		

			
			include($directorio."/add_edit.php");
		break;
		case 'EDIT_PASS':
			if (!isset($Usuarios))
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
			include($directorio."/consultar.php");
		break;
	}

?>