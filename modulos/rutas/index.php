<?php
	$modulo = 'Rutas';

	//Creo instancia de la clase de turnos
	$objRuta=New Rutas();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	$objPuntos=New Puntos_chequeo();

	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			if (isset($_POST['identificador']))
			{
				unset($aWhere);
				$aWhere['id']=$_POST['identificador'];
				$Ruta=$objRuta->buscar($aWhere);

				if (count($Ruta)>0)
				{
					$PuntosRuta=$Ruta[0]->getPuntosChequeo();
				}

			}
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$Empresas=$objEmpresas->buscar($aWhere);
			
			if (isset($PuntosRuta))
			{
				if (count($PuntosRuta)>0)
                {
                	$PuntosChequeoIn=array();
					//var_dump($PuntosRuta);
					$in="";
					foreach($PuntosRuta as $arr)
					{
						if ($in=="")
							$in.="(".$arr['idpunto'];
						else
							$in.=",".$arr['idpunto'];

						unset($aWhere);
						$aWhere['estado_registro']=1;
						if ($oUsuario->getRol_numero()!=SUPERADMIN)
						{
							$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
						}

						$aWhere['id']=$arr['idpunto'];
						$PuntosChequeoIn[]=$objPuntos->buscar($aWhere);

					}
					if ($in!="")
						$in.=")";
					// $aWhere['id IN']=$in;
					// $PuntosChequeoIn=$objPuntos->buscar($aWhere);
					unset($aWhere);
					$aWhere['estado_registro']=1;
					if ($oUsuario->getRol_numero()!=SUPERADMIN)
					{
						$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
					}
					$aWhere['id NOT IN']=$in;
				
				}
			}
			unset($aWhere);
			$aWhere['estado_registro']=1;
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			}
			$PuntosChequeo=$objPuntos->buscar($aWhere);
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
			$aRutas=$objRuta->buscar($aWhere);
			
			include($directorio."/consultar.php");
		break;
	}
?>