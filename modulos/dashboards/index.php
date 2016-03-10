<?php

//Creo instancia de la clase de turnos
$objAsistente=New Asistentes();

//Creo instancia de la clase de roles
$objEstados=New Estados();

//Creo instancia de la clase de Empresas
$objEmpresas=New Empresas();


$objRoles=New Roles();

$objUsuario=New Usuarios();

$objEvento=New Eventos();

$objIdentificacion=New Identificaciones();

$objZona=New Zonas();

$objTipo=New TipoAsistentes();




switch(strtoupper($accion))
{
	default:
		$aWhere=array();
		$aOrWhere=array();
			$aWhere['a.estado IN']="(1,4,5)";
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

			
				//$aWhere['a.usuario_numero IN']=$In;
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
					$aWhere['ae.id_evento']=$_POST['search'];
					//$aOrWhere['u.nombre ilike']=$_POST['search'];
				
				}
				$search=$_POST['search'];
			}
			

	

			/*if ($page*20==0)
				$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere,"0","20","a.id","DESC");	
			else
				$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere,$page*20,"20","a.id","DESC");	*/
			$aAsistentes=$objAsistente->buscar2($aWhere,$aOrWhere);
			$aAsistentesCount=$objAsistente->buscar2($aWhere);

			$canAsistentesActivos=0;
			$canAsistentesRegistrados=0;

			$identificadores_id=array();
			$canidentificadores = array();
			$datosidentidifacion = array();
			for ($i=0; $i < count($aAsistentes); $i++){ 
			 	if($aAsistentes[$i]->getEstado_registro()==1){
			 		$canAsistentesActivos++;
			 	}elseif ($aAsistentes[$i]->getEstado_registro()==4) {
			 		$canAsistentesRegistrados++;
			 	}
			 	if(in_array($aAsistentes[$i]->getId_identificacion(), $identificadores_id)==false){

			 		$identificadores_id[]=$aAsistentes[$i]->getId_identificacion();
			 		$cantidentificadores[$aAsistentes[$i]->getId_identificacion()]=1;
			 	
			 	}else{
			 		$canidentificadores[$aAsistentes[$i]->getId_identificacion()]++;
			 	}

			 }

			 unset($aWhere);
			 $aWhere['estado']=1;
			 if($oUsuario->getRol_numero()!=SUPERADMIN){
			 	$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
			 } 
			 $aEventos=$objEvento->buscar($aWhere);
			
			include($directorio."/consultar.php");
		
	break;
	}
?>