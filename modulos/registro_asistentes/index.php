<?php
	$modulo = 'Registro Asistentes';

	//Creo instancia de la clase de turnos
	$objAsistente=New Asistentes();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	$objRoles=New Roles();

	$objUsuario=New Usuarios();

	$objEvento=New Eventos();

	$objZona=new Zonas();

	$objTipo=new TipoAsistentes();

	$objIdentificacion=new Identificaciones();


	if (isset($_POST['nombre_acompaniante']))
	{
		if ($_POST['nombre_acompaniante']!=""||$_POST['id_asistente_acompaniante']!="")
		{

			$idAsistente=$_POST['id_asistente_acompaniante'];
			$objAsistente->setId($idAsistente);

			$nombre = $_POST['nombre_acompaniante'];
			$apellido = $_POST['apellido_acompaniante'];
			$doc = $_POST['documento_acompaniante'];

			$objAsistente2 = New Asistentes();
			$objAsistente2->setNombre($nombre);
			$objAsistente2->setApellido($apellido);
			$objAsistente2->setEstado_registro(1);
			$objAsistente2->setEmpresa_numero($_POST['empresa_numero']);
			$objAsistente2->setEs_acompaniante(1);
			$objAsistente2->setDocumento($doc);

			$objAsistente->agregarAcompaniante($objAsistente2);
			$accion="consultar";
		}
	}



	switch(strtoupper($accion))
	{
		/*case 'VISUALIZAR':
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
		break;*/
		/*case 'ADD_EDIT':
			if (isset($_POST['identificador']))
			{
				unset($aWhere);
				$aWhere['a.id']=$_POST['identificador'];
				$Asignacion=$objAsistente->buscar($aWhere);

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
		break;*/
		
		case 'ACTION':
			include($directorio."/action.php");
		break;

		default:

				if($_POST['id_evento']!=""){
					$idEvento=$_POST['id_evento'];
					$idAsistente=$_POST['id_asistente'];
					$objAsistente=New Asistentes();
					$objAsistente->setId($idAsistente);
					$objAsistente->setEstadoRegistrado($idEvento);

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
			$aWhere['a.estado IN']="(1,4,5)";
			

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
			if (isset($_POST['searchnombre']))
			{
				if ($_POST['searchnombre']!="")
				{
					$aWhere["(nombre||' '||apellido) ilike"]=$_POST['searchnombre'];
					//$aOrWhere['u.nombre ilike']=$_POST['search'];
				
				}
				$search=$_POST['searchnombre'];
			}
			if (isset($_POST['searchevento']))
			{
				if ($_POST['searchevento']!='')
					$aWhere['ae.id_evento']=$_POST['searchevento'];
			
			}

			if (isset($_POST['searchdocumento']))
			{
				if ($_POST['searchdocumento']!="")
				{
					$aWhere['documento ilike']=$_POST['searchdocumento'];
					//$aOrWhere['u.nombre ilike']=$_POST['search'];
				
				}
				$search=$_POST['searchnombre'];
			}

			if (isset($_POST['searchidentificacion']))
			{
				if ($_POST['searchidentificacion']!='')
				{
					//echo $_POST['searchfechadesde'];
					//list($d,$m,$a)=explode('/',$_POST['searchfechadesde']);
					$aWhere['id_identificacion']=$_POST['searchidentificacion'];
				}
			}

			if (isset($_POST['searchestado']))
			{
				if ($_POST['searchestado']!='')
					$aWhere['ae.estado']=$_POST['searchestado'];
			
			}
			/*if ($page*20==0)
				$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere,"0","20","id","DESC");	
			else
				$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere,$page*20,"20","id","DESC");*/	
			$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere);
			
			$aAsistentesCount=$objAsistente->buscar2($aWhere,$aOrWhere,"","","id","DESC");



			unset($aWhere);
			$aWhere['estado_registro']=1;
			

			$aWhere2['estado']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Identificaciones=$objIdentificacion->buscar($aWhere2);
			$Eventos=$objEvento->buscar($aWhere2);
			$Estados=$objEstados->buscar($aWhere);

			$asistenteEscaneado= array();
			if (isset($_POST['code']))
			{
				if ($_POST['code']!='')
					$code=$_POST['code'];
				$query="select a.id_identificacion, a.documento, a.nombre, a.apellido, r.estado, r.codigo, a.id, r.id_evento from asistentes as a inner join asistente_evento as r on a.id=r.id_asistente where r.codigo='$code'";
				$result=$db->executeQuery($query);
                $db->commit();
                $asistenteEscaneado=$result;
			}
			
			
			include($directorio."/consultar.php");
		break;
	}
?>