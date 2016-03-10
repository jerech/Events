<?php
switch(strtoupper($accion))
{
	case 'TIEMPO_DEMORA':
		$modulo='Reporte en Tiempos de demora';
	break;
	case 'ASIGNACIONES_CAMILLERO':
		$modulo='Reporte de la cantidad Asignaciones por Camillero';
	break;
	case 'FRECUENCIA':
		$modulo='Reporte de Frecuencia';
	break;
}

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

	$objPuntos=New Puntos_chequeo();


	//echo strtoupper($accion);

switch(strtoupper($accion))
{
	case 'ASIGNACIONES_CAMILLERO':
		$usuarionumero='';
		
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$usuarionumero=$oUsuario->getUsuario_numero();
				
			
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

			
			$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"","","u.nombre","ASC","a.usuario_numero,u.nombre","a.usuario_numero,u.nombre,count(*) as totalAsignaciones");	
			
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


		include($directorio."/consultar2.php");
	break;
	case 'TIEMPO_DEMORA':
			$usuarionumero='';
		
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$usuarionumero=$oUsuario->getUsuario_numero();
				
			
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

			if (isset($_POST['searchtiempodesde']) && isset($_POST['searchtiempohasta']))
			{
				if ($_POST['searchtiempodesde']!='' && $_POST['searchtiempohasta']!='')
				{
					//echo $_POST['searchtiempodesde'];
					//list($d,$m,$a)=explode('/',$_POST['searchtiempodesde']);
					//$aWhere['a.created_at::date >=']=$_POST['searchtiempodesde'];
					//list($d,$m,$a)=explode('/',$_POST['searchtiempohasta']);
					//$aWhere['a.created_at::date <=']=$_POST['searchtiempohasta'];
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");	
					$aAsignacionesCount=0;

				}
				else
				{
					if ($page*20==0)
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"0","20","a.id","DESC");	
					else
						$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,$page*20,"20","a.id","DESC");	
					
					$aAsignacionesCount=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");
				}
			}
			else
			{
				if ($page*20==0)
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"0","20","a.id","DESC");	
				else
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,$page*20,"20","a.id","DESC");	
				
				$aAsignacionesCount=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");
			}
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
		case 'FRECUENCIA':
			$usuarionumero='';
		
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$usuarionumero=$oUsuario->getUsuario_numero();
				
			
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

			if (isset($_POST['searchpuntoinicio']) )
			{
				if ($_POST['searchpuntoinicio']!='')
				{
					$aWhere['p.id']=$_POST['searchpuntoinicio'];
				}
			}

			if (isset($_POST['searchpuntofinal']) )
			{
				if ($_POST['searchpuntofinal']!='')
				{
					$aWhere['p.id']=$_POST['searchpuntofinal'];
				}
			}


			if (isset($_POST['searchestado']))
			{
				if ($_POST['searchestado']!='')
					$aWhere['a.estado_registro']=$_POST['searchestado'];
			
			}

			if ($page*20==0)
					$aAsignaciones=$objAsignacion->buscar_frecuencia($aWhere,$aOrWhere,"0","20","u.nombre || '_' || p.nombre","ASC","a.usuario_numero,u.nombre,p.nombre,p_dest.nombre","a.usuario_numero,u.nombre,p.nombre as punto,p_dest.nombre as punto_dest,count(*) as totalAsignaciones");	
				else
					$aAsignaciones=$objAsignacion->buscar_frecuencia($aWhere,$aOrWhere,$page*20,"20","u.nombre || '_' || p.nombre","ASC","a.usuario_numero,u.nombre,p.nombre,p_dest.nombre","a.usuario_numero,u.nombre,p.nombre as punto,p_dest.nombre as punto_dest,count(*) as totalAsignaciones");	
				
				//$aAsignacionesCount=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");
			
			    $aAsignacionesT=$objAsignacion->buscar_frecuencia($aWhere,$aOrWhere,"","","u.nombre || '_' || p.nombre","ASC","a.usuario_numero,u.nombre,p.nombre,p_dest.nombre","a.usuario_numero,u.nombre,p.nombre as punto,p_dest.nombre as punto_dest,count(*) as totalAsignaciones","count");	
				$aAsignacionesCount=0;
				if (count($aAsignacionesT)>0)
                                    {
                                        foreach($aAsignacionesT as $count)
                                        {
                                            $aAsignacionesCount= $count->total;
                                        }
                                    }
				//$aAsignacionesCount=$aAsignacionesT[0]['total'];
			
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


			include($directorio."/consultar3.php");
		break;
}
?>