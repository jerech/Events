<?php
	$modulo="Empresa";

	
	//Creo instancia de la clase de Empresas
	$objEmpresas=New Empresas();

	//Creo instancia de la clase de roles
	$objEstados=New Estados();

	

	$aWhere=array();
	$aOrWhere=array();

	$empresanumero='';
	$usuarionumero='';
		
	if ($oUsuario->getRol_numero()!=SUPERADMIN)
	{
		$empresanumero=$oUsuario->getEmpresa_numero();
		$usuarionumero=$oUsuario->getUsuario_numero();
		
		$aWhere['empresa_numero']=$empresanumero;
		echo SUPERADMIN;
	}

	
	$aWhere['estado_registro <>']='3';
		
	$aEmpresa=$objEmpresas->buscar($aWhere,$aOrWhere);
	
	$aTipoDoc=array("NIT");

	$aColor=array();

	$aColor[]=array("value"=>"#FFFFFF","nombre"=>"BLANCO");
	$aColor[]=array("value"=>"#000000","nombre"=>"NEGRO");
	$aColor[]=array("value"=>"#EEEEEE","nombre"=>"GRIS");
	$aColor[]=array("value"=>"#0000FF","nombre"=>"AZUL");
	$aColor[]=array("value"=>"#FFFF00","nombre"=>"AMARILLO");
	$aColor[]=array("value"=>"#FF0000","nombre"=>"ROJO");
	$aColor[]=array("value"=>"#00FF00","nombre"=>"VERDE");
	
	switch(strtoupper($accion))
	{
		case 'ADD_EDIT':
			unset($aWhere);
			
			
			if (isset($_POST['identificador']))
			{
				if ($oUsuario->getRol_numero()!=SUPERADMIN)
				{
					$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
				}

				unset($aWhere);
				$aWhere['id']=$_POST['identificador'];
				$Empresa=$objEmpresas->buscar($aWhere);


			}
			
			// $oLocalidades=New Localidades();
			// unset($aWhere);
			// $aWhere['nivel']="3";
						
			// $LocalidadCiudad=$oLocalidades->buscar($aWhere);
			

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