<?php
	$modulo = 'Asignaciones';

	//Creo instancia de la clase de turnos
	$objAsignacion=New Asignaciones();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	$objPuntos=New Puntos_chequeo();

	$objRoles=New Roles();

	$objUsuario=New Usuarios();

	$objTipo=New Tipos_asignacion();

	$objRuta=New Rutas();

	switch(strtoupper($accion))
	{
		case 'VISUALIZAR':
			if (!isset($_REQUEST['identificador']))
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
			$oAsignacion=New Asignaciones($_REQUEST['identificador']);
			unset($aWhere);
            $aWhere['usuario_numero']=$oAsignacion->getUsuario_numero();
            $aCamillero=$objUsuario->buscar($aWhere);
            unset($aWhere);
            $aWhere['usuario_numero']=$oAsignacion->getResponsable();
            $aResponsable=$objUsuario->buscar($aWhere);
            $responsable="";

            if (count($aResponsable)>0)
            {
	            

				$responsable=$aResponsable[0]->getNombre();
			}

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

            $asignacion=$oAsignacion->getAsunto()." - ".$oAsignacion->getPaciente();

            $Puntos=$oAsignacion->getPuntosChequeo();

            $aAleNov=$oAsignacion->getAlertaNovedades();

            $checked=0;
             $avance=0;
           	
            if (count($Puntos)>0)
            {
            	$oInicio=New Puntos_chequeo($Puntos[0]['idpunto']);
            	$oFin=New Puntos_chequeo($Puntos[count($Puntos)-1]['idpunto']);
            	$oRuta=New Rutas($Puntos[0]['idruta']);
            	foreach($Puntos as $control)
            	{
            		if ($control['checkpoint']=="1")
            			$checked+=1;

            		$oUltimo=New Puntos_chequeo($control['idpunto']);
            	
            	}
            	$avance=ROUND(($checked*100)/count($Puntos),2);
			}

			include($directorio."/visualizar.php");
		break;
		case 'ADD_EDIT':
			if (isset($_POST['identificador']))
			{
				unset($aWhere);
				$aWhere['a.id']=$_POST['identificador'];
				$Asignacion=$objAsignacion->buscar($aWhere);

				if (count($Asignacion)>0)
				{
					$Ruta=$Asignacion[0]->getRutaChequeo();

					if ($Ruta=='0')
					{
						$PuntosIniFin=$Asignacion[0]->getPuntosChequeo();
					}
				}

			}
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Empresas=$objEmpresas->buscar($aWhere);
			
			unset($aWhere);
			// if ($oUsuario->getRol_numero()!=SUPERADMIN)
			// {
			// 	$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			// }
			$Estados=$objEstados->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			// if (isset($PuntosRuta))
			// {
			// 	if (count($result)>0)
   //              {
			// 		//var_dump($PuntosRuta);
			// 		$in="";
			// 		foreach($PuntosRuta as $arr)
			// 		{
			// 			if ($in=="")
			// 				$in.="(".$arr['idpunto'];
			// 			else
			// 				$in.=",".$arr['idpunto'];
			// 		}
			// 		if ($in!="")
			// 			$in.=")";
			// 		$aWhere['id IN']=$in;
			// 		$PuntosChequeoIn=$objPuntos->buscar($aWhere);
			// 		unset($aWhere);
			// 		$aWhere['estado_registro']=1;
			// 		$aWhere['id NOT IN']=$in;
				
			// 	}
			// }

			$PuntosChequeo=$objPuntos->buscar($aWhere,array(),"","20","nombre","ASC");

			unset($aWhere);
			$aWhere['nivel']=$objRoles->getMaxNivel();
			$rol=$objRoles->buscar($aWhere);
			
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();

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

			
				$aWhere['usuario_numero IN']=$In;
			}
			$aWhere['rol_numero']=$rol[0]->getRol_numero();
			$Camilleros=$objUsuario->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Tiposasignacion=$objTipo->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Rutas=$objRuta->buscar($aWhere);
			
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
			$aWhere['a.estado_registro IN']="(4,5)";
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['a.empresa_numero']=$oUsuario->getEmpresa_numero();

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

			
				$aWhere['a.usuario_numero IN']=$In;
			}

			if(isset($_POST['pagina']))
			{
				$page=$_POST['pagina'];
			}
			else
			{
				$page=0;
			}

			$search="";
			$aOrWhere=array();
			if (isset($_POST['search']))
			{
				if ($_POST['search']!="")
				{
					$aWhere['a.asunto ilike']=$_POST['search'];
					//$aOrWhere['u.nombre ilike']=$_POST['search'];
				
				}
				$search=$_POST['search'];
			}
			if (isset($_POST['searchusuario']))
			{
				if ($_POST['searchusuario']!='')
					$aWhere['u.usuario_numero']=$_POST['searchusuario'];
			
			}

			if (isset($_POST['searchfechadesde']) && isset($_POST['searchfechahasta']))
			{
				if ($_POST['searchfechadesde']!='' && $_POST['searchfechahasta']!='')
				{
					//echo $_POST['searchfechadesde'];
					//list($d,$m,$a)=explode('/',$_POST['searchfechadesde']);
					$aWhere['a.created_at::date >=']=$_POST['searchfechadesde'];
					//list($d,$m,$a)=explode('/',$_POST['searchfechahasta']);
					$aWhere['a.created_at::date <=']=$_POST['searchfechahasta'];
				}
			}

			if (isset($_POST['searchestado']))
			{
				if ($_POST['searchestado']!='')
					$aWhere['a.estado_registro']=$_POST['searchestado'];
			
			}
			if ($page*20==0)
				$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"0","20","a.id","DESC");	
			else
				$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,$page*20,"20","a.id","DESC");	
			
			$aAsignacionesCount=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");

			unset($aWhere);
			$aWhere['nivel']=$objRoles->getMaxNivel();
			$rol=$objRoles->buscar($aWhere);

			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();

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

			
				$aWhere['usuario_numero IN']=$In;
			}
			$aWhere['rol_numero']=$rol[0]->getRol_numero();
			$Camilleros=$objUsuario->buscar($aWhere);


			
			include($directorio."/consultar.php");
		break;
	}
?>