<?php
	$modulo = 'Novedades';

	//Creo instancia de la clase de turnos
	$objNovedades=New Novedades();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	$objUsuario=New Usuarios();

	$objRoles=New Roles();

	$objTipo=New Tipos_asignacion();


	switch(strtoupper($accion))
	{
		case 'VISUALIZAR':
			if (!isset($_REQUEST['id']))
				{
					echo "No tiene permisos para acceder a esta opcion, datos faltantes";
					die();
				}
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
			if ($oUsuario->getRol_numero()==SUPERADMIN)
			{
				$oEmpresa=New Empresas();
			
			}
			else
			{
				$oEmpresa=New Empresas("",$oUsuario->getEmpresa_numero());
			}
			$oNovedad=New Novedades($_REQUEST['id']);
			$oNovedad->pasarAleido();
			$oAsignacion=New Asignaciones($oNovedad->getIdasignacion());
			unset($aWhere);
			$aWhere['usuario_numero']=$oAsignacion->getUsuario_numero();
            $aCamillero=$objUsuario->buscar($aWhere);
            $camillero="";
            $logoCamillero="";

            if (count($aCamillero)>0)
            {
	            $profile_small = @fopen($aCamillero[0]->getImagen(), "r");
			   	
				
				if ($profile_small)
				{
					$logoCamillero=$aCamillero[0]->getImagen();
					fclose($profile_small);
				}
				else 
				{
					$profile_small = @fopen($oEmpresa->getLogo_empresa(), "r");
			   		if ($profile_small)
					{
						$logoCamillero=$oEmpresa->getLogo_empresa();
						fclose($profile_small);
					}
					else
					{
						$logoCamillero=BASE_URL."/img/gestion.png";
					}
				}

				$camillero=$aCamillero[0]->getNombre();
			}
			$asignacion="";
			$tipo="";
                                            
            if ($oAsignacion->getIdtipoasignacion()!="")
            {
                unset($aWhere);
                $aWhere['id']=$oAsignacion->getIdtipoasignacion();
                $aTipos=$objTipo->buscar($aWhere);
                if (count($aTipos)>0)
                    $tipo=$aTipos[0]->getNombre();
            }

            $asignacion=$tipo." - ".$oAsignacion->getPaciente();

			include($directorio."/visualizar.php");
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
			$aWhere['n.estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['n.empresa_numero']=$oUsuario->getEmpresa_numero();

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

				$aWhere['u.usuario_numero IN']=$In;
			}

			if (isset($_POST['buscar']) && !empty($_POST['buscar'])) {
				if (!empty(trim($_POST['filtro_camillero_search'])))    { $aOrWhere['u.nombre ilike']    = trim($_POST['filtro_camillero_search']);    }
				if (!empty(trim($_POST['filtro_fecha_search']))) { 
					list($d,$m,$y)=split("/",trim($_POST['filtro_fecha_search']));

					$aWhere["to_char(n.created_at,'YYYY-mm-dd')"] = $y."-".$m."-".$d; 
				}
			}

			$aNovedades=$objNovedades->buscar($aWhere);
			include($directorio."/consultar.php");
		break;
	}
?>