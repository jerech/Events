<?php
	
	switch($_POST['funcion'])
	{
		case 'validar_editar_pass':
			$resultado="0";

			// AND password=md5('".$_POST['password_old']."') 
			
			$sql="SELECT * FROM usuarios WHERE id='".$_POST['idusuario']."' 
			AND password_movil=md5('".$_POST['password_movil_old']."')";

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$resultado="1";
	            }
	        }

	        echo $resultado;
		break;

		case 'buscar_alertas':
			$resultado='';
			$filEmpresa="";
			$filUsuario="";
			$oUsuario=New Usuarios($_SESSION['id_usuario']);
			$objRoles=new Roles();
			$objUsuario=new Usuarios();
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$filEmpresa.=" AND a.empresa_numero='".$oUsuario->getEmpresa_numero()."' ";

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

				$filUsuario.=" AND u.usuario_numero IN ".$In." ";
			}

			$sql="SELECT a.*,u.nombre as camillero FROM alertas as a 
					inner join asignaciones as asig ON asig.id=a.idasignacion
            		inner join usuarios as u ON u.usuario_numero=asig.usuario_numero 
            		Where a.estado_registro='1' AND a.leido=0 
            		".$filEmpresa.$filUsuario." order by a.leido ASC,a.created_at DESC LIMIT 10 OFFSET 0 ";
            //echo $sql;
			$result=$db->executeQuery($sql);
	        $db->commit();

	        $sql="SELECT a.* FROM alertas as a 
					inner join asignaciones as asig ON asig.id=a.idasignacion
            		inner join usuarios as u ON u.usuario_numero=asig.usuario_numero 
            		Where a.estado_registro='1' AND a.leido=0
            		".$filEmpresa.$filUsuario."";
           	$resultLeido=$db->executeQuery($sql);
	        $db->commit();
	        if (isset($resultLeido))
	        {
	            if (count($resultLeido)>0)
	            {
	            	$total_alerta=count($resultLeido);
	            
	            }
	        }

	        $list='';
	        $camillero='';
	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
                    $list.='<input type="hidden" name="historialAlert" value="'.$total_alerta.'">';
	            	$list.='<ul class="dropdown-menu dropdown-alerts">';
	            	foreach($result as $objeto)
                    {
                    	$camillero=$objeto['camillero'];
                    	$list.='<li>';
                        $list.='<div class="dropdown-messages-box">';
                        $list.='<div>';
                        $list.='<a href="javascript:void(0);" class="a_alertas" onclick="visualizarAlerta('.$objeto['id'].');">';
                        if ($objeto['leido']=='0')
                        {
                        $list.='<strong>'.$objeto['observacion'].'</strong>.</a><br>';
                        }
                        else
                        {
                        $list.=$objeto['observacion'].'.</a><br>';
                        }
                        $list.='<small class="text-muted">'.substr($objeto['created_at'],0,19).'</small>';
                        $list.='</div>';
                        $list.='</div>';
                        $list.='</li>';
                        $list.='<li class="divider"></li>';
                    }
                    $list.='</ul>';
	            }
	            else
	            {
                        $list.='<input type="hidden" name="historialAlert" value="0">';
	            		$list.='<ul class="dropdown-menu dropdown-alerts">';
	            		$list.='<li>';
                        $list.='<div class="dropdown-messages-box">';
                        $list.='<div>';
                        $list.='<a href="javascript:void(0);" class="a_alertas">';
                        $list.='<strong>No tiene alertas pendientes</strong>.</a><br>';
                        $list.='<small class="text-muted"></small>';
                        $list.='</div>';
                        $list.='</div>';
                        $list.='</li>';
                        $list.='<li class="divider"></li>';
                        $list.='</ul>';
	           
	            }
	        }
	        $resultado.='<audio id="audio_alert"><source src="../audio/alert.mp3" type="audio/mpeg"><source src="../audio/alert.wav" type="audio/wav"></audio>';
	        $resultado.='<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">';
            $resultado.='<i class="fa fa-bell"></i>  <span class="label label-primary">'.$total_alerta.'</span>';
            $resultado.='</a>';
            $resultado.=$list;
			
			echo json_encode(array("html"=>$resultado,"total"=>$total_alerta,"camillero"=>$camillero));

		break;

		case 'buscar_novedades':
			$resultado='';
			$filEmpresa="";
			$filUsuario="";
			$oUsuario=New Usuarios($_SESSION['id_usuario']);
			$objRoles=new Roles();
			$objUsuario=new Usuarios();
			if ($oUsuario->getRol_numero()!=SUPERADMIN)
			{
				$filEmpresa.=" AND n.empresa_numero='".$oUsuario->getEmpresa_numero()."' ";

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

				$filUsuario.=" AND u.usuario_numero IN ".$In." ";
			}

			$sql="SELECT n.* FROM novedades as n 
					inner join asignaciones as asig ON asig.id=n.idasignacion
            		inner join usuarios as u ON u.usuario_numero=asig.usuario_numero 
            		Where n.estado_registro='1' AND n.leido=0 
            		".$filEmpresa.$filUsuario." order by n.leido DESC LIMIT 10 OFFSET 0 ";
			$result=$db->executeQuery($sql);
	        $db->commit();

	        $sql="SELECT n.* FROM novedades as n 
					inner join asignaciones as asig ON asig.id=n.idasignacion
            		inner join usuarios as u ON u.usuario_numero=asig.usuario_numero 
            		Where n.estado_registro='1' AND n.leido=0 
            		".$filEmpresa.$filUsuario."";
           	$resultLeido=$db->executeQuery($sql);
	        $db->commit();
	        if (isset($resultLeido))
	        {
	            if (count($resultLeido)>0)
	            {
	            	$total_novedad=count($resultLeido);
	            }
	        }

	        $list='';
	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$list.='<ul class="dropdown-menu dropdown-alerts">';
                    foreach($result as $objeto)
                    {
                    	$list.='<li>';
                        $list.='<div class="dropdown-messages-box">';
                        $list.='<div>';
                        $list.='<a href="javascript:void(0);" class="a_alertas" onclick="visualizarNovedad('.$objeto['id'].');">';
                        if ($objeto['leido']=='0')
                        {
                        $list.='<strong>'.$objeto['observacion'].'</strong>.</a><br>';
                        }
                        else
                        {
                        $list.=$objeto['observacion'].'.</a><br>';
                        }
                        $list.='<small class="text-muted">'.substr($objeto['created_at'],0,19).'</small>';
                        $list.='</div>';
                        $list.='</div>';
                        $list.='</li>';
                        $list.='<li class="divider"></li>';
                    }
                    $list.='</ul>';
	            	
	            }
	            else
	            {
	            	$list.='<ul class="dropdown-menu dropdown-alerts">';
                    	$list.='<li>';
                        $list.='<div class="dropdown-messages-box">';
                        $list.='<div>';
                        $list.='<a href="javascript:void(0);" class="a_alertas" >';
                        $list.='<strong>No tiene novedades pendientes</strong>.</a><br>';
                        $list.='<small class="text-muted"></small>';
                        $list.='</div>';
                        $list.='</div>';
                        $list.='</li>';
                        $list.='<li class="divider"></li>';
                     $list.='</ul>';
	            }
	        }
	        

			$resultado.='<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">';
            $resultado.='<i class="fa fa-envelope"></i>  <span class="label label-warning">'.$total_novedad.'</span>';
            $resultado.='</a>';
            $resultado.=$list;
			
			
			echo json_encode(array("html"=>$resultado));

		break;

		case 'datos_de_cliente':
			$resultado=array();

			$sql="select c.nombre,COALESCE(c.imagen,'') as imagen,c.direccion,COALESCE(l.nombre,'') as ciudad,
			COALESCE(d.nombre,'') as departamento,COALESCE(p.nombre,'') as pais,c.ccnit,
			c.telefono,c.celular,c.email,COALESCE(s.nombre,'') as sector,c.razon_social,
			c.cnta_numero as usuario,c.sitio_web,c.latitud,c.longitud,c.orden_visita,
			c.firma,c.cupo,c.contacto,c.cargo_contacto,COALESCE(t.descripcion,'') as tipo_cliente,
			COALESCE(UPPER(e.descripcion),'') as estado
			from clientes as c
			left join localidades as l ON l.codigo=c.ciudad
			left join localidades as d ON d.codigo=c.departamento
			left join localidades as p ON p.codigo=c.pais
			left join sector as s ON s.id::varchar=c.sector
			left join usuarios as u ON u.usuario_numero=c.usuario_numero
			left join tipo_cliente as t ON t.tipcliente_numero=c.tipcliente_numero
			left join estados as e ON e.estado_registro=c.estado_registro
			where c.id='".$_POST['idcliente']."'";

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$sql="select COALESCE(u.nombre,'') as usuario from clusuario as cc
	            	inner join usuarios as u on u.usuario_numero=cc.id_usuario
	            	where cc.id_cliente='".$result[0]['usuario']."'";
	            	
	            	//echo $sql;

	            	$resultUsuario=$db->executeQuery($sql);
	        		$db->commit();
	        		if (isset($resultUsuario))
			        {
			            if (count($resultUsuario)>0)
			            {
			            	$j=0;
			            	foreach($resultUsuario as $usu)
			            	{
			            		if ($j==0)
			            		    $result[0]['usuario']=$usu['usuario'];
			            		else	
			            	    	$result[0]['usuario'].="<br>".$usu['usuario'];

			            	    $j++;
			            	}
			            }
			        }
			        $resultado=$result[0];
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'nivel1_nivel2':
			$resultado=array();

			$sql="select * from tipo_actividad where nivel='3' AND cod_padre='".$_POST['nivel1']."'";

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array('id'=>$objeto['id'],'descripcion'=>$objeto['descripcion']);
	            	}
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'nivel2_nivel3':
			$resultado=array();

			$sql="select * from tipo_actividad where nivel='4' AND cod_padre='".$_POST['nivel2']."'";

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array('id'=>$objeto['id'],'descripcion'=>$objeto['descripcion']);
	            	}
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'usuario_cliente':
			$resultado=array();

			$sql="select c.cnta_numero,c.nombre from clusuario as cc 
			inner join clientes as c ON c.cnta_numero=cc.id_cliente
			where cc.id_usuario='".$_POST['usuario']."'";

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array('cnta_numero'=>$objeto['cnta_numero'],'nombre'=>$objeto['nombre']);
	            	}
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'nivel_padre':
			$resultado=array();

			switch ($_POST['nivel'])
			{
				case "1":
					$resultado[]=array('padre'=>'','nombre'=>'');
				break;
				case "2":
					$sql="select * from localidades where nivel='1'";
					$result=$db->executeQuery($sql);
			        $db->commit();

			        if (isset($result))
			        {
			            if (count($result)>0)
			            {
			            	foreach($result as $objeto)
		                    {
		                    	$resultado[]=array('padre'=>$objeto['codigo'],'nombre'=>$objeto['nombre']);
			            	}
			            }
			        }
				break;
				case "3":
					$sql="select * from localidades where nivel='2'";
					$result=$db->executeQuery($sql);
			        $db->commit();

			        if (isset($result))
			        {
			            if (count($result)>0)
			            {
			            	foreach($result as $objeto)
		                    {
		                    	$resultado[]=array('padre'=>$objeto['codigo'],'nombre'=>$objeto['nombre']);
			            	}
			            }
			        }
				break;
				
			}

		    echo json_encode($resultado);

		break;

		case 'nivel_tipact':
			$resultado=array();

			switch ($_POST['nivel'])
			{
				case "1":
					$resultado[]=array('padre'=>'','nombre'=>'');
				break;
				case "2":
					$sql="select * from tipo_actividad where nivel='1' and tipact_numero='1'";
					if ($_POST['empresa']!="")
					{
						$sql.=" AND empresa_numero='".$_POST['empresa']."'";
					}
					$result=$db->executeQuery($sql);
			        $db->commit();

			        if (isset($result))
			        {
			            if (count($result)>0)
			            {
			            	foreach($result as $objeto)
		                    {
		                    	$resultado[]=array('padre'=>$objeto['id'],'nombre'=>$objeto['descripcion']);
			            	}
			            }
			        }
				break;
				case "3":
					$sql="select * from tipo_actividad where nivel='2'";
					if ($_POST['empresa']!="")
					{
						$sql.=" AND empresa_numero='".$_POST['empresa']."'";
					}
					$result=$db->executeQuery($sql);
			        $db->commit();

			        if (isset($result))
			        {
			            if (count($result)>0)
			            {
			            	foreach($result as $objeto)
		                    {
		                    	$resultado[]=array('padre'=>$objeto['id'],'nombre'=>$objeto['descripcion']);
			            	}
			            }
			        }
				break;
				case "4":
					$sql="select * from tipo_actividad where nivel='3'";
					if ($_POST['empresa']!="")
					{
						$sql.=" AND empresa_numero='".$_POST['empresa']."'";
					}
					$result=$db->executeQuery($sql);
			        $db->commit();

			        if (isset($result))
			        {
			            if (count($result)>0)
			            {
			            	foreach($result as $objeto)
		                    {
		                    	$resultado[]=array('padre'=>$objeto['id'],'nombre'=>$objeto['descripcion']);
			            	}
			            }
			        }
				break;
				
			}

		    echo json_encode($resultado);

		break;


		case 'pais_departamento':
			$resultado=array();

			$sql="select * from localidades where nivel='2' AND cod_padre='".$_POST['pais']."'";
			if ($_POST['empresa']!="")
			{
				$sql.=" AND empresa_numero='".$_POST['empresa']."'";
			}

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array('departamento'=>$objeto['codigo'],'nombre'=>$objeto['nombre']);
	            	}
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'departamento_ciudad':
			$resultado=array();

			$sql="select * from localidades where nivel='3' AND cod_padre='".$_POST['departamento']."'";
			if ($_POST['empresa']!="")
			{
				$sql.=" AND empresa_numero='".$_POST['empresa']."'";
			}

			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array('ciudad'=>$objeto['codigo'],'nombre'=>$objeto['nombre']);
	            	}
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'actividadesEstado':
			$resultado="";
		 	
		 	$objActividades=New Actividades();
			
			$objEstados=New Estados();

			$objTipoActividad=New Tipo_Actividad();

			$objTipoCliente=New Tipo_Cliente();
			
			$objEmpresa=New Empresas();

			$aWhere=array();
			$aOrWhere=array();
			
			switch(strtoupper($_POST['estado']))
			{
				case 'PROGRAMADAS':
					$aWhere['a.estado_registro <>']="3";
				break;
				case 'PENDIENTES':
					$aWhere['(a.estado_registro <>3 AND a.estado_registro <>7 AND a.estado_registro <>8)']=null;
					// $aWhere['a.estado_registro <>']="7";
					// $aWhere['a.estado_registro <>']="8";
				break;
				case 'REALIZADAS':
					$aWhere['a.estado_registro']="7";
				break;
				case 'CANCELADAS':
					$aWhere['a.estado_registro']="8";
				break;
				case 'EFECTIVAS':
					$aWhere['a.estado_registro']="7";
					$aWhere['(ACOS(SIN(RADIANS(a.latitud::numeric)) * SIN(RADIANS(c.latitud::numeric)) + 
    COS(RADIANS(a.latitud::numeric)) * COS(RADIANS(c.latitud::numeric)) * 
    COS(RADIANS(a.longitud::numeric) - RADIANS(c.longitud::numeric))) * 6378 * 1000) <=']="250";
				break;
				case 'POR_VALIDAR':
					$aWhere['a.estado_registro']="7";
					$aWhere['(ACOS(SIN(RADIANS(a.latitud::numeric)) * SIN(RADIANS(c.latitud::numeric)) + 
    COS(RADIANS(a.latitud::numeric)) * COS(RADIANS(c.latitud::numeric)) * 
    COS(RADIANS(a.longitud::numeric) - RADIANS(c.longitud::numeric))) * 6378 * 1000) >']="250";
				break;
			}
			$aWhere['a.usuario_numero']=$_POST['usuario'];

			
			if ($_POST['filtro_fecha_desde']!="" && $_POST['filtro_fecha_hasta']!="")
            {
                $aWhere[" to_char(a.fecha_hora_apertura,'YYYY-mm-dd')>="]="'".$_POST['filtro_fecha_desde']."'"; 
                $aWhere[" to_char(a.fecha_hora_apertura,'YYYY-mm-dd')<="]="'".$_POST['filtro_fecha_hasta']."'";
            }
            else
            {
            	$aWhere["to_char(a.fecha_hora_apertura,'YYYY-mm-dd')"]="to_char(current_date,'YYYY-mm-dd')";
            }

            if ($_POST['filtro_cliente']!="" )
            {
                $aOrWhere[" c.nombre ilike"]=$_POST['filtro_cliente']; 
                $aOrWhere[" c.ccnit"]=$_POST['filtro_cliente'];
            }

			$aActividades=$objActividades->buscar($aWhere,$aOrWhere);
			$resultado.='<input type="hidden" name="usuarioSearch" value="'.$_POST['usuario'].'" >';
			$resultado.='<input type="hidden" name="estadoSearch" value="'.$_POST['estado'].'" >';
			$resultado.='<input type="hidden" name="filtro_clienteSearch" value="'.$_POST['filtro_cliente'].'" >';
			$resultado.='<input type="hidden" name="filtro_fecha_desdeSearch" value="'.$_POST['filtro_fecha_desde'].'" >';
			$resultado.='<input type="hidden" name="filtro_fecha_hastaSearch" value="'.$_POST['filtro_fecha_hasta'].'" >';
			$resultado.='<table class="table table-striped table-bordered table-hover dataTables-example2" >';
            $resultado.='    <thead>';
            $resultado.='        <tr>';
            $resultado.='            <th>NOMBRE USUARIO</th>';
            $resultado.='            <th>NIT o CEDULA</th>';
            $resultado.='            <th>CLIENTE</th>';
            $resultado.='            <th>DIRECCION</th>';
            $resultado.='            <th style="width:10%;">F.INICIO</th>';
            $resultado.='            <th style="width:10%;">F.FIN</th>';
            $resultado.='            <th>DURACI&Oacute;N (mins)</th>';
            $resultado.='            <th>T.ACTIVIDAD</th>';
            $resultado.='            <th>ASUNTO</th>';
            $resultado.='            <th>DESCRIPCI&Oacute;N</th>';
            $resultado.='            <th>COMENTARIOS</th>';
            $resultado.='            <th>ESTADO</th>';
            $resultado.='            <th>LATITUD</th>';
            $resultado.='            <th>LONGITUD</th>';
            $resultado.='            <th>TIPO</th>';
            $resultado.='            <th>CATEGORIA</th>';
            $resultado.='            <th>SUBCATEGORIA</th>';
            $resultado.='            <th>EMPRESA</th>';
            $resultado.='        </tr>';
            $resultado.='    </thead>';
            $resultado.='    <tbody >';
			if ($aActividades)
            {
                if (count($aActividades)>0)
                {
                    $aWhere=array();
                    foreach($aActividades as $objeto)
                    {
                        unset($aWhere);
                        $aWhere['estado_registro']=$objeto['estado_registro'];
                        $Estados=$objEstados->buscar($aWhere);

                        
                        $stringTipoActividad="";
                        if ($objeto['tipact_numero']!="" && $objeto['tipact_numero']!="0" && $objeto['tipact_numero']!="-1")
                        {
                            unset($aWhere);
                            $aWhere['nivel']="1";
                            $aWhere['tipact_numero IN']="(1,2,3)";
                            $aWhere['tipact_numero']=$objeto['tipact_numero'];
                            $TiposActividades=$objTipoActividad->buscar($aWhere);   
                            if (count($TiposActividades)>0)
                                $stringTipoActividad=$TiposActividades[0]->getDescripcion();
                        }

                        $stringTipoCliente="";
                        if ($objeto['nivel1_actividad']!="" && $objeto['nivel1_actividad']!="0" && $objeto['nivel1_actividad']!="-1")
                        {
                            unset($aWhere);
                            $aWhere['tipcliente_numero']=$objeto['nivel1_actividad'];
                            $TiposClientes=$objTipoCliente->buscar($aWhere);    
                            if (count($TiposClientes)>0)
                                $stringTipoCliente=$TiposClientes[0]->getDescripcion();
                        }

                        $stringTipoActividad2="";
                        if ($objeto['nivel2_actividad']!="" && $objeto['nivel2_actividad']!="0" && $objeto['nivel2_actividad']!="-1")
                        {
                            unset($aWhere);
                            $aWhere['nivel']="2";
                            $aWhere['tipact_numero']=$objeto['nivel2_actividad'];
                            $TiposActividades2=$objTipoActividad->buscar($aWhere);  
                            if (count($TiposActividades2)>0)
                                $stringTipoActividad2=$TiposActividades2[0]->getDescripcion();
                        }

                        $stringTipoActividad3="";
                        if ($objeto['nivel3_actividad']!="" && $objeto['nivel3_actividad']!="0" && $objeto['nivel3_actividad']!="-1")
                        {
                            unset($aWhere);
                            $aWhere['nivel']="3";
                            $aWhere['tipact_numero']=$objeto['nivel3_actividad'];
                            $TiposActividades3=$objTipoActividad->buscar($aWhere);  
                            if (count($TiposActividades3)>0)
                                $stringTipoActividad3=$TiposActividades3[0]->getDescripcion();
                        }
                        
                        $stringEmpresa="";
                        unset($aWhere);
                        $aWhere['empresa_numero']=$objeto['empresa_numero'];
                        $Empresas=$objEmpresa->buscar($aWhere);
                        if (count($Empresas)>0)
                            $stringEmpresa=$Empresas[0]->getNombre_empresa();

                        $resultado.='<tr>';
                        $resultado.='    <td>'.$objeto['usuario'].'</td>';
                        $resultado.='    <td>'.$objeto['nit'].'</td>';
                        $resultado.='    <td>'.$objeto['cliente'].'</td>';
                        $resultado.='    <td>'.$objeto['direccion'].'</td>';
                        $resultado.='    <td>'.$objeto['fecha_hora_apertura'].'</td>';
                        $resultado.='    <td>'.$objeto['fecha_hora_fin'].'</td>';
                        $resultado.='    <td>'.$objeto['duracion'].'</td>';
                        $resultado.='    <td>'.$stringTipoActividad.'</td>';
                        $resultado.='    <td>'.$objeto['asunto'].'</td>';
                        $resultado.='    <td>'.$objeto['descripcion'].'</td>';
                        $resultado.='    <td>'.$objeto['comentarios'].'</td>';
                        $resultado.='    <td>'.$Estados[0]->getDescripcion().'</td>';
                        $resultado.='    <td>'.$objeto['latitud'].'</td>';
                        $resultado.='    <td>'.$objeto['longitud'].'</td>';
                        $resultado.='    <td>'.$stringTipoCliente.'</td>';
                        $resultado.='    <td>'.$stringTipoActividad2.'</td>';
                        $resultado.='    <td>'.$stringTipoActividad3.'</td>';
                        $resultado.='    <td>'.$stringEmpresa.'</td>';
                        $resultado.='</tr>';
                    }
                }
            }

            $resultado.='</tbody>';
            $resultado.='    <tfoot>';
            $resultado.='        <tr>';
            $resultado.='            <th>NOMBRE USUARIO</th>';
            $resultado.='            <th>NIT o CEDULA</th>';
            $resultado.='            <th>CLIENTE</th>';
            $resultado.='            <th>DIRECCION</th>';
            $resultado.='            <th style="width:10%;">F.INICIO</th>';
            $resultado.='            <th style="width:10%;">F.FIN</th>';
            $resultado.='            <th>DURACI&Oacute;N (mins)</th>';
            $resultado.='            <th>T.ACTIVIDAD</th>';
            $resultado.='            <th>ASUNTO</th>';
            $resultado.='            <th>DESCRIPCI&Oacute;N</th>';
            $resultado.='            <th>COMENTARIOS</th>';
            $resultado.='            <th>ESTADO</th>';
            $resultado.='            <th>LATITUD</th>';
            $resultado.='            <th>LONGITUD</th>';
            $resultado.='            <th>TIPO</th>';
            $resultado.='            <th>CATEGORIA</th>';
            $resultado.='           <th>SUBCATEGORIA</th>';
            $resultado.='            <th>EMPRESA</th>';
            $resultado.='        </tr>';
            $resultado.='    </tfoot>';
            $resultado.='</table>';
			
		    echo json_encode(array("table"=>$resultado));
		break;

		case 'coberturaClientes':
			$resultadoHidden="";
		 	$resultado="";
		 	$resultadoClientes="";
		 	
		 	$objActividades=New Actividades();
			
			$objEstados=New Estados();

			$objTipoActividad=New Tipo_Actividad();

			$objTipoCliente=New Tipo_Cliente();
			
			$objEmpresa=New Empresas();

			$aWhere=array();
			$aOrWhere=array();
			extract($_POST);
			global $db;


			$filtroCliente="";
            if ($filtro_cliente!="")
            {
                $filtro_cliente=" AND (c.nombre ilike '%".$filtro_cliente."%' 
                OR c.ccnit='".$filtro_cliente."') ";
            }
			
			$dia=1;
            $j=1;
            
            while($j<=$semana)
            {
            $num_sem1 = date("W", mktime(0, 0, 0, $filtro_mes, $dia, date("Y")));

            $sem=$num_sem1;
            $filtro_fecha_desde=date("Y")."-".$filtro_mes."-".str_pad($dia,2,"0",STR_PAD_LEFT);
            while ($sem==$num_sem1 && $dia<=31)
            {
                $dia++;
                $sem = date("W", mktime(0, 0, 0, $filtro_mes, $dia, date("Y")));
            } 
            $filtro_fecha_hasta=date("Y")."-".$filtro_mes."-".str_pad($dia,2,"0",STR_PAD_LEFT);

            $filtroFecha=" AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')>='".$filtro_fecha_desde."' 
                AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')<'".$filtro_fecha_hasta."' ";

            
            $j++;
            }

            $resultadoHidden.='<input type="hidden" name="usuarioSearch" value="'.$usuario_numero.'" >';
			$resultadoHidden.='<input type="hidden" name="semanaSearch" value="'.$semana.'" >';
			$resultadoHidden.='<input type="hidden" name="filtro_clienteSearch" value="'.$filtro_cliente.'" >';
			$resultadoHidden.='<input type="hidden" name="filtro_mesSearch" value="'.$filtro_mes.'" >';
			$resultadoHidden.='<input type="hidden" name="total_semanasSearch" value="'.$total_semanas.'" >';

		    $resultado.='<table class="table table-striped table-bordered table-hover dataTables-example2" >';
            $resultado.='    <thead>';
            $resultado.='        <tr>';
            $resultado.='            <th>NIT o CEDULA</th>';
            $resultado.='            <th>CLIENTE</th>';
            $resultado.='            <th>DIRECCION</th>';
            $resultado.='            <th>CELULAR</th>';
            $resultado.='            <th>TELEFONO</th>';
            $resultado.='            <th>EMAIL</th>';
            $resultado.='            <th>CIUDAD</th>';
            $resultado.='            <th>DEPARTAMENTO</th>';
            $resultado.='            <th>PAIS</th>';
            $resultado.='            <th>TIPO CLIENTE</th>';
            $resultado.='            <th>LATITUD</th>';
            $resultado.='            <th>LONGITUD</th>';
            $resultado.='            <th>ESTADO</th>';
            $resultado.='            <th>EMPRESA</th>';
            $resultado.='        </tr>';
            $resultado.='    </thead>';
            $resultado.='    <tbody >';


            $resultadoClientes=$resultado;

            $resultado=$resultadoHidden.$resultado;

            if ($total_semanas=='' || $total_semanas==$semana)
			{
				$filtro_fecha_desde=date("Y")."-".$filtro_mes."-01";
				$filtro_fecha_hasta=date("Y")."-".$filtro_mes."-32";

            
				 $filtroFecha=" AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')>='".$filtro_fecha_desde."' 
                AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')<'".$filtro_fecha_hasta."' ";
            }

			$sql="SELECT DISTINCT c.ccnit,c.nombre as cliente,c.direccion,c.celular,c.telefono,
            c.email,lc.nombre as ciudad,ld.nombre as departamento,lp.nombre as pais,
            tc.descripcion as tipo_cliente,c.latitud,c.longitud,e.descripcion as estado,em.nombre_empresa as empresa
            FROM actividades as a 
            inner join clientes as c ON c.cnta_numero=a.cnta_numero  
            left join localidades as lc ON lc.codigo=c.ciudad
            left join localidades as ld ON ld.codigo=c.departamento
            left join localidades as lp ON lp.codigo=c.pais
            left join tipo_cliente as tc ON tc.tipcliente_numero=c.tipcliente_numero
            left join estados as e ON e.estado_registro=c.estado_registro
            left join empresa as em ON em.empresa_numero=c.empresa_numero
            WHERE a.usuario_numero='".$usuario_numero."' 
            AND a.estado_registro='7' ".$filtroFecha.$filtro_cliente." ";
            $result = $db->executeQuery($sql);
            $db->commit();
            if (isset($result))
                {
                    if (count($result)>0)
                    {
                        foreach($result as $objeto)
                        {   

	                       	$resultado.='<tr>';
	                        $resultado.='    <td>'.$objeto['ccnit'].'</td>';
	                        $resultado.='    <td>'.$objeto['cliente'].'</td>';
	                        $resultado.='    <td>'.$objeto['direccion'].'</td>';
	                        $resultado.='    <td>'.$objeto['celular'].'</td>';
	                        $resultado.='    <td>'.$objeto['telefono'].'</td>';
	                        $resultado.='    <td>'.$objeto['email'].'</td>';
	                        $resultado.='    <td>'.$objeto['ciudad'].'</td>';
	                        $resultado.='    <td>'.$objeto['departamento'].'</td>';
	                        $resultado.='    <td>'.$objeto['pais'].'</td>';
	                        $resultado.='    <td>'.$objeto['tipo_cliente'].'</td>';
	                        $resultado.='    <td>'.$objeto['latitud'].'</td>';
	                        $resultado.='    <td>'.$objeto['longitud'].'</td>';
	                        $resultado.='    <td>'.$objeto['estado'].'</td>';
	                        $resultado.='    <td>'.$objeto['empresa'].'</td>';
	                        $resultado.='</tr>';
            
                        }
                    }
                }

            if ($total_semanas=='')
			{
				$filtro_fecha_desde=date("Y")."-".$filtro_mes."-01";
				$filtro_fecha_hasta=date("Y")."-".$filtro_mes."-32";

            
				 $filtroFecha=" AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')>='".$filtro_fecha_desde."' 
                AND to_char(a.fecha_hora_apertura,'YYYY-mm-dd')<'".$filtro_fecha_hasta."' ";

            
            $sql="SELECT DISTINCT c.ccnit,c.nombre as cliente,c.direccion,c.celular,c.telefono,
            c.email,lc.nombre as ciudad,ld.nombre as departamento,lp.nombre as pais,
            tc.descripcion as tipo_cliente,c.latitud,c.longitud,e.descripcion as estado,em.nombre_empresa as empresa
            FROM clusuario as cl
            inner join clientes as c ON c.cnta_numero=cl.id_cliente  
            left join localidades as lc ON lc.codigo=c.ciudad
            left join localidades as ld ON ld.codigo=c.departamento
            left join localidades as lp ON lp.codigo=c.pais
            left join tipo_cliente as tc ON tc.tipcliente_numero=c.tipcliente_numero
            left join estados as e ON e.estado_registro=c.estado_registro
            left join empresa as em ON em.empresa_numero=c.empresa_numero
            WHERE cl.id_usuario='".$usuario_numero."'  
            AND c.estado_registro<>'3' AND c.cnta_numero NOT IN (SELECT a.cnta_numero FROM actividades as a WHERE  a.usuario_numero='".$usuario_numero."' 
            AND a.estado_registro='7' ".$filtroFecha.$filtro_cliente.") ";
            //echo $sql;
            
            $resultC = $db->executeQuery($sql);
            $db->commit();
            if (isset($resultC))
                {
                    if (count($resultC)>0)
                    {
                        foreach($resultC as $objeto)
                        {   

                            $resultadoClientes.='<tr>';
	                        $resultadoClientes.='    <td>'.$objeto['ccnit'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['cliente'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['direccion'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['celular'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['telefono'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['email'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['ciudad'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['departamento'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['pais'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['tipo_cliente'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['latitud'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['longitud'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['estado'].'</td>';
	                        $resultadoClientes.='    <td>'.$objeto['empresa'].'</td>';
	                        $resultadoClientes.='</tr>';
                        }
                    }
                }
			
                $resultadoClientes.='</tbody>';
            
            	$resultadoClientes.='</table>';
			
			}
			else
			{
				$resultadoClientes="";	
			}

            $resultado.='</tbody>';
            
            $resultado.='</table>';

            
		    echo json_encode(array("tableVisitados"=>$resultado,"tableNoVisitados"=>$resultadoClientes));
		break;

		case 'actividades':
			$resultado=array();

			$sql="select a.id,a.asunto,a.fecha_hora_fin,a.fecha_hora_apertura,a.estado_registro,
			  c.nombre as cliente,a.tipact_numero,c.cnta_numero,c.direccion,a.descripcion,a.comentarios,
			  a.nivel1_actividad,a.nivel2_actividad,a.nivel3_actividad
			 from actividades as a
			INNER JOIN clientes as c ON c.cnta_numero=a.cnta_numero 
			 ";

			$condicion="";
			if ($_POST['empresa']!='')
			{
				$condicion.=" WHERE a.empresa_numero='".$_POST['empresa']."' ";
			}

			if ($_POST['usuario']!='')
			{
				if ($condicion=="")
					$condicion.=" WHERE a.usuario_numero='".$_POST['usuario']."' ";
				else
					$condicion.=" AND a.usuario_numero='".$_POST['usuario']."' ";
					
			}	
			$sql.=$condicion;
			//echo $sql;
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	$color="#ff273a";
                    	switch($objeto['estado_registro'])
                    	{
                    		case '5':
                    			$color="#42b2b6";
                    		break;
                    		case '6':
                    			$color="#6a0f20";
                    		break;
                    		case '8':
                    			$color="#f38a6a";
                    		break;
                    		case '7':
                    			$color="#bdbcca";
                    		break;
                    	}
                    	$resultado[]=array('title'=>$objeto['cliente'],'cliente'=>$objeto['cliente'],'direccion'=>$objeto['direccion'],'cnta_numero'=>$objeto['cnta_numero'],'start'=>$objeto['fecha_hora_apertura'],'end'=>$objeto['fecha_hora_fin'],'color'=>$color,'id'=>$objeto['id'],'description'=>$objeto['asunto'],'tipact_numero'=>$objeto['tipact_numero'],'detalle'=>$objeto['descripcion'],'observaciones'=>$objeto['comentarios'],'nivel1_actividad'=>$objeto['nivel1_actividad'],'nivel2_actividad'=>$objeto['nivel2_actividad'],'nivel3_actividad'=>$objeto['nivel3_actividad']);
	            	}
	            }
	        }

	        echo json_encode(array("events"=>$resultado));
		
		break;

		case 'usuariosAgenda':
			$resultado=array();

			$sql="select rol_numero FROM usuarios where usuario_numero='".$_POST['usuario']."' ";

			$result=$db->executeQuery($sql);
	        $db->commit();
	        $rol="";
	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$rol=$result[0]['rol_numero'];
	            }
	        }

			$sql="select u.nombre,u.imagen,u.usuario_numero,r.nivel
			 from usuarios as u 
			 inner join roles as r ON r.rol_numero=u.rol_numero
			 ";

			$condicion=" WHERE u.estado_registro=1 ";
			if ($_POST['empresa']!=''  && $rol!="3")
			{
				$condicion.=" AND u.empresa_numero='".$_POST['empresa']."' ";
			}

			if ($_POST['usuario']!='')
			{
				if ($condicion=="")
					$condicion.=" AND u.usuario_numero='".$_POST['usuario']."' ";
				else
					$condicion.=" AND u.usuario_numero='".$_POST['usuario']."' ";
					
			}	
			$sql.=$condicion;
			$sql.=" ORDER BY u.nombre ASC ";
			//echo $sql;
			$result=$db->executeQuery($sql);
	        $db->commit();
	        $objRoles=New Roles();
	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	if ($rol!="3")
                    	$nivelIni=$objeto['nivel'];
						else
						$nivelIni=1;
							
						$In="(".$objeto['usuario_numero'].")";
						while ($nivelIni<$objRoles->getMaxNivel())
						{
	                    	$sql="select u.nombre,u.imagen,u.usuario_numero
							 from usuarios as u
							 ";

							$condicion=" WHERE u.estado_registro=1 ";
							if ($_POST['empresa']!='' && $rol!="3")
							{
								$condicion.=" AND u.empresa_numero='".$_POST['empresa']."' ";
							}

							if ($_POST['usuario']!='' && ($rol!="3" && $nivelIni>1))
							{
								if ($condicion=="")
									$condicion.=" AND u.director_usuario IN ".$In."  ";
								else
									$condicion.=" AND u.director_usuario IN ".$In." ";
									
							}	
							$sql.=$condicion;
							//echo $sql;
							$resultHijos=$db->executeQuery($sql);
					        $db->commit();
					        $resultadoHijo=array();
							if (isset($resultHijos))
					        {
					            if (count($resultHijos)>0)
					            {
					            	$In=substr($In,0,-1);
        							foreach($resultHijos as $objetoHijo)
				                    {
				                    	$In.=",".$objetoHijo['usuario_numero'];	
				            		}
	                    		}
	                    		else
		                    	{
		                    		$In=substr($In,0,-1);
		                    	}
	                    	}

	                    	 $nivelIni++;
	                    	 if ($In!="")
        						$In.=")";
							
							
	                    }

	                    $sql="select u.nombre,u.imagen,u.usuario_numero
							 from usuarios as u
							 ";

							$condicion=" WHERE u.estado_registro=1 ";
							if ($_POST['empresa']!='' && $rol!="3")
							{
								$condicion.=" AND u.empresa_numero='".$_POST['empresa']."' ";
							}

							if ($_POST['usuario']!='')
							{
								if ($condicion=="")
									$condicion.=" AND u.director_usuario IN ".$In."  ";
								else
									$condicion.=" AND u.director_usuario IN ".$In." ";
									
							}	
							$sql.=$condicion;
							$sql.=" ORDER BY u.nombre ASC ";
							//echo $sql;
							$resultHijos=$db->executeQuery($sql);
					        $db->commit();
					        $resultadoHijo=array();
							if (isset($resultHijos))
					        {
					            if (count($resultHijos)>0)
					            {
					            	foreach($resultHijos as $objetoHijo)
				                    {
				                    	if ($objetoHijo['imagen']=="")
            								$objetoHijo['imagen']='fa fa-camera';
        								
        								if (isset($_POST['empresaUsuario']))
				                    	{
				                    		$resultado[]=array("usuario_numero"=>$objetoHijo['usuario_numero'],"nombre"=>$objetoHijo['nombre']);
				                    	}
				                    	else
				                    	{
	                    	 				$resultadoHijo[]=array('text'=>$objetoHijo['nombre'],'icon'=>$objetoHijo['imagen'],'a_attr'=>array('usuario_numero'=>$objetoHijo['usuario_numero']));
	                    	 			}
	                    	 		}
	                    	 	}
	                    	} 
    					if ($objeto['imagen']=="")
							$objeto['imagen']='fa fa-camera';
                    	
                    	if (isset($_POST['empresaUsuario']))
                    	{
                    		$resultado[]=array("usuario_numero"=>$objeto['usuario_numero'],"nombre"=>$objeto['nombre']);
                    	}
                    	else
                    	{
                    		$resultado['data']=array('text'=>$objeto['nombre'],'icon'=>$objeto['imagen'],'a_attr'=>array('usuario_numero'=>$objeto['usuario_numero']),'children'=>$resultadoHijo);
                    	}
                    }
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'clientesAgenda':
			$resultado=array();

			$sql="select c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion
			 from clientes as c 
			 inner join clusuario cc ON cc.id_cliente=c.cnta_numero  
			 ";

			$condicion="";
			if ($_POST['empresa']!='')
			{
				$condicion.=" WHERE c.empresa_numero='".$_POST['empresa']."' ";
			}

			if ($_POST['usuario']!='')
			{
				if ($condicion=="")
					$condicion.=" WHERE cc.id_usuario='".$_POST['usuario']."' ";
				else
					$condicion.=" AND cc.id_usuario='".$_POST['usuario']."' ";
					
			}

			$sql.=$condicion." GROUP BY c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion";
			//echo $sql;
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	
                    	$resultado[]=array('text'=>$objeto['nombre'],'icon'=>$objeto['imagen'],'cnta_numero'=>$objeto['cnta_numero'],'ccnit'=>$objeto['ccnit'],'direccion'=>$objeto['direccion']);
                    }
	            }
	        }

	        echo json_encode($resultado);

		break;

		case 'consultaFormulario':
			$resultado=array();
			$varString="";

			if (count($_POST['usuarios'])>0)
			{
				
				foreach($_POST['usuarios'] as $value)
				{
					
					if ($varString=="")
					 $varString.="'".$value."'";
					else
					 $varString.=",'".$value."'";
					
				}

				// if ($condicion=="")
				// 	$condicion.=" WHERE cc.id_usuario IN (".$varString.") ";
				// else
				// 	$condicion.=" AND cc.id_usuario=(".$varString.") ";
					
			}	

			if ($varString=="")
			{
				echo json_encode($resultado);
				break;
			}

			$sql="select rol_numero FROM usuarios where usuario_numero IN (".$varString.") ";

			$result=$db->executeQuery($sql);
	        $db->commit();
	        $rol="";
	        $nivelIni=1;

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$rol=$result[0]['rol_numero'];
	            	if ($rol!="3")
        				$nivelIni=$result[0]['nivel'];
	            }
	        }

	        if ($_POST['prefuncion']=='clientesFormulario')
	        {
			$sqlC="select c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion
			 from clientes as c 
			 inner join clusuario cc ON cc.id_cliente=c.cnta_numero  
			 ";
			}
			else if ($_POST['prefuncion']=='tipoclientesFormulario')
			{
			$sqlC="select c.descripcion as nombre,c.tipcliente_numero as cnta_numero
			 from tipo_cliente as c 
			 ";
			}
			else if ($_POST['prefuncion']=='sectoresFormulario')
			{
			$sqlC="select c.nombre as nombre,c.codigo as cnta_numero
			 from sector as c 
			 ";
			}
			else if ($_POST['prefuncion']=='zonasFormulario')
			{
			$sqlC="select c.nombre as nombre,c.codigo as cnta_numero
			 from zona as c 
			 inner join zona_usuarios cc ON cc.zona=c.id  
			 ";
			}
			else if ($_POST['prefuncion']=='paisesFormulario')
			{
			$sqlC="select c.nombre as nombre,c.codigo as cnta_numero
			 from localidades as c 
			 ";
			}
			else if ($_POST['prefuncion']=='departamentosFormulario')
			{
			$sqlC="select c.nombre as nombre,c.codigo as cnta_numero
			 from localidades as c 
			 ";
			}
			else if ($_POST['prefuncion']=='ciudadesFormulario')
			{
			$sqlC="select c.nombre as nombre,c.codigo as cnta_numero
			 from localidades as c 
			 ";
			}
			else if ($_POST['prefuncion']=='productosFormulario')
			{
			$sqlC="select c.nombre as nombre,c.prdo_numero as cnta_numero
			 from productos as c 
			 ";
			}

			$condicionC="";
			if ($_POST['empresa']!='')
			{
				$condicionC.=" WHERE c.empresa_numero='".$_POST['empresa']."' ";
			}

			
			$objRoles=New Roles();
	        
			$In="(".$varString.")";
			while ($nivelIni<$objRoles->getMaxNivel())
			{
            	$sql="select u.nombre,u.imagen,u.usuario_numero
				 from usuarios as u
				 ";

				$condicion=" WHERE u.estado_registro=1 ";
				if ($_POST['empresa']!='' && $rol!="3")
				{
					$condicion.=" AND u.empresa_numero='".$_POST['empresa']."' ";
				}

				if ($varString!='' && ($rol!="3" && $nivelIni>1))
				{
					if ($condicion=="")
						$condicion.=" AND u.director_usuario IN ".$In."  ";
					else
						$condicion.=" AND u.director_usuario IN ".$In." ";
						
				}	
				$sql.=$condicion;
				//echo $sql;
				$resultHijos=$db->executeQuery($sql);
		        $db->commit();
		        $resultadoHijo=array();
				if (isset($resultHijos))
		        {
		            if (count($resultHijos)>0)
		            {
		            	$In=substr($In,0,-1);
						foreach($resultHijos as $objetoHijo)
	                    {
	                    	$In.=",".$objetoHijo['usuario_numero'];	
	            		}
            		}
            		else
                	{
                		$In=substr($In,0,-1);
                	}
            	}

            	 $nivelIni++;
            	 if ($In!="")
					$In.=")";
				
				
            }

            if ($condicionC=="")
            {
            	if ($_POST['prefuncion']=='clientesFormulario')
	        	{
					$condicionC.=" WHERE cc.id_usuario IN ".$In." ";
            	}
            	else if ($_POST['prefuncion']=='zonasFormulario')
	        	{
					$condicionC.=" WHERE cc.usuario IN ".$In." ";
            	}
            	else if ($_POST['prefuncion']=='paisesFormulario')
	        	{
					$condicionC.=" WHERE nivel='1' ";
            	}
            	else if ($_POST['prefuncion']=='departamentosFormulario')
	        	{
					$condicionC.=" WHERE nivel='2' ";
            	}
            	else if ($_POST['prefuncion']=='ciudadesFormulario')
	        	{
					$condicionC.=" WHERE nivel='3' ";
            	}
            	else if ($_POST['prefuncion']=='productosFormulario')
	        	{
	        		$condicionC.=" WHERE c.usuario_numero IN ".$In." ";
            	}	
            }
            else
            {
            	if ($_POST['prefuncion']=='clientesFormulario')
	        	{
					$condicionC.=" AND cc.id_usuario IN ".$In." ";
            	}
            	else if ($_POST['prefuncion']=='zonasFormulario')
	        	{
					$condicionC.=" AND cc.usuario IN ".$In." ";
            	}
            	else if ($_POST['prefuncion']=='paisesFormulario')
	        	{
					$condicionC.=" AND c.nivel='1' ";
            	}
            	else if ($_POST['prefuncion']=='departamentosFormulario')
	        	{
					$condicionC.=" AND c.nivel='2' ";
            	}
            	else if ($_POST['prefuncion']=='ciudadesFormulario')
	        	{
					$condicionC.=" AND c.nivel='3' ";
            	}
            	else if ($_POST['prefuncion']=='productosFormulario')
	        	{
	        		$condicionC.=" AND c.usuario_numero IN ".$In." ";
            	}	
            }
			
			if ($_POST['prefuncion']=='clientesFormulario')
	        {
				$sqlC.=$condicionC." GROUP BY c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion";
				$sqlC.=" ORDER BY c.nombre ASC ";
			}
			else if ($_POST['prefuncion']=='tipoclientesFormulario')
	        {
				$sqlC.=$condicionC." GROUP BY c.descripcion,c.tipcliente_numero";
				$sqlC.=" ORDER BY c.descripcion ASC ";
			}
			else if ($_POST['prefuncion']=='sectoresFormulario')
	        {
				$sqlC.=$condicionC." GROUP BY c.nombre,c.codigo";
				$sqlC.=" ORDER BY c.nombre ASC ";
			}
			else if ($_POST['prefuncion']=='zonasFormulario')
	        {
	        	$sqlC.=$condicionC." GROUP BY c.nombre,c.codigo";
				$sqlC.=" ORDER BY c.nombre ASC ";
	        }
	        else if ($_POST['prefuncion']=='paisesFormulario')
	        {
	        	$sqlC.=$condicionC." GROUP BY c.nombre,c.codigo";
				$sqlC.=" ORDER BY c.nombre ASC ";
	        }
	        else if ($_POST['prefuncion']=='departamentosFormulario')
	        {
	        	$sqlC.=$condicionC." GROUP BY c.nombre,c.codigo";
				$sqlC.=" ORDER BY c.nombre ASC ";
	        }
	        else if ($_POST['prefuncion']=='ciudadesFormulario')
	        {
	        	$sqlC.=$condicionC." GROUP BY c.nombre,c.codigo";
				$sqlC.=" ORDER BY c.nombre ASC ";
	        }
	        else if ($_POST['prefuncion']=='productosFormulario')
	        {
	        	$sqlC.=$condicionC." GROUP BY c.nombre,c.prdo_numero";
				$sqlC.=" ORDER BY c.nombre ASC ";
	        }
			if (isset($_POST['limite']))
				$sqlC.=" LIMIT 100 OFFSET 0 ";
			//echo $sqlC;
			if ($varString!="''")
	       	{
	        $result=$db->executeQuery($sqlC);
	        $db->commit();
	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$resultado[]=array("cnta_numero"=>"","nombre"=>"");
                    
	            	foreach($result as $objeto)
                    {
                    	$resultado[]=array("cnta_numero"=>$objeto['cnta_numero'],"nombre"=>$objeto['nombre']);
                    }
	            }
	        }
	    	}

	        echo json_encode($resultado);

		break;

		case 'clientesVisor':
			$resultado=array();

			if ($_POST['usuario']!='')
			{
			
			$sql="select c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion
			 from clientes as c 
			 inner join clusuario cc ON cc.id_cliente=c.cnta_numero  
			 ";

			$condicion="";
			
				if ($condicion=="")
					$condicion.=" WHERE cc.id_usuario='".$_POST['usuario']."' ";
				else
					$condicion.=" AND cc.id_usuario='".$_POST['usuario']."' ";
					
			$sql.=$condicion." GROUP BY c.nombre,c.imagen,c.cnta_numero,c.ccnit,c.direccion";
			//echo $sql;
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	foreach($result as $objeto)
                    {
                    	
                    	$resultado[]=array('text'=>$objeto['nombre'],'value'=>$objeto['ccnit']);
                    }
	            }
	        }
	        }	
			
	        echo json_encode($resultado);

		break;

		case 'buscar_clientes_asociar':
			$resultado=array();
			$aClientes=split(",",$_POST['identificadores']);

			foreach($aClientes as $value)
			{
			$sql="select c.nombre as cliente,COALESCE(u.nombre,'') as usuario
			 from clientes as c 
			 left join clusuario cc ON cc.id_cliente=c.cnta_numero
			 left join usuarios u ON u.usuario_numero=cc.id_usuario  
			 WHERE c.id=".$value." ORDER BY c.nombre ASC";
			
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$strCliente="";
	            	$strUsuario="";
	            	foreach($result as $objeto)
                    {
                    	
                    	if ($strCliente!="" && $strCliente!=$objeto['cliente'])
                    	{	
                    		$resultado[]=array('cliente'=>$strCliente,'usuario'=>$strUsuario);
                    		$strUsuario="";
                    	}
                    	if ($strUsuario=="")
                    		$strUsuario.=$objeto['usuario'];
                    	else 
                    		$strUsuario.=",".$objeto['usuario'];

                    	if ($strCliente!=$objeto['cliente'])
                    	{
                    		$strCliente=$objeto['cliente'];	
                    	}
                    }
                    $resultado[]=array('cliente'=>$strCliente,'usuario'=>$strUsuario);
            
	            }
	        }
	                		

	    	}
	    	
	    	 echo json_encode($resultado);
		break;

		case 'buscar_asistentes_asociar':
			$resultado=array();
			$aAsistentes=split(",",$_POST['identificadores']);

			foreach($aAsistentes as $value)
			{
			$sql="select a.nombre||' '||a.apellido as nombre, a.email, ae.estado as estado_registro, 
			ae.codigo as codigo_barra, e.nombre as evento			 
			 from asistentes as a 
			 left join asistente_evento as ae ON ae.id_asistente=a.id
			 left join evento as e on ae.id_evento=e.id 
			 WHERE a.id=".$value." ORDER BY a.nombre ASC";
			
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$strAsistente="";
	            	$strEvento="";
	            	$strCodigoBarra="";
	            	foreach($result as $objeto)
                    {
                    	
                    	if ($strAsistente!="" && $strAsistente!=$objeto['nombre'])
                    	{	
                    		$resultado[]=array('asistente'=>$strAsistente,'evento'=>$strEvento, 'codigo'=>$strCodigoBarra);
                    		$strEvento="";
                    		$strCodigoBarra="";
                    	}
                    	if ($strEvento==""){
                    		$strEvento.=$objeto['evento'];
                    		$strCodigoBarra.=$objeto['codigo_barra'];
                    	}
                    	else{ 
                    		$strEvento.=",".$objeto['evento'];
                    		$strCodigoBarra.=",".$objeto['codigo_barra'];
						}
                    	if ($strAsistente!=$objeto['nombre'])
                    	{
                    		$strAsistente=$objeto['nombre'];	
                    	}
                    }
                    $resultado[]=array('asistente'=>$strAsistente,'evento'=>$strEvento, 'codigo'=>$strCodigoBarra);
            
	            }
	        }
	                		

	    	}
	    	
	    	 echo json_encode($resultado);
		break;

		case 'buscar_zonas_asociar':
			$resultado=array();
			$aZonas=split(",",$_POST['identificadores']);

			foreach($aZonas as $value)
			{
			$sql="select c.nombre as zona,COALESCE(u.nombre,'') as usuario
			 from zona as c 
			 left join zona_usuarios cc ON cc.zona=c.id
			 left join usuarios u ON u.usuario_numero=cc.usuario  
			 WHERE c.id=".$value." ORDER BY c.nombre ASC";
			
			$result=$db->executeQuery($sql);
	        $db->commit();

	        if (isset($result))
	        {
	            if (count($result)>0)
	            {
	            	$strZona="";
	            	$strUsuario="";
	            	foreach($result as $objeto)
                    {
                    	
                    	if ($strZona!="" && $strZona!=$objeto['zona'])
                    	{	
                    		$resultado[]=array('cliente'=>$strZona,'usuario'=>$strUsuario);
                    		$strUsuario="";
                    	}
                    	if ($strUsuario=="")
                    		$strUsuario.=$objeto['usuario'];
                    	else 
                    		$strUsuario.=",".$objeto['usuario'];

                    	if ($strZona!=$objeto['zona'])
                    	{
                    		$strZona=$objeto['zona'];	
                    	}
                    }
                    $resultado[]=array('cliente'=>$strZona,'usuario'=>$strUsuario);
            
	            }
	        }
	                		

	    	}
	    	
	    	 echo json_encode($resultado);
		break;

		case 'modificarActividad':
			$resultado=array();
			$sql="";
				if ($_POST['nivel2_actividad']=="")
					$_POST['nivel2_actividad']="0";
				if ($_POST['nivel3_actividad']=="")
					$_POST['nivel3_actividad']="0";
			
			if ($_POST['idactividad']=="")
			{
				
				$sql.=" INSERT INTO actividades (estado_registro,empresa_numero,asunto,fecha_hora_apertura,
					fecha_hora_fin,usuario_numero,tipact_numero,cnta_numero,descripcion,direccion,nivel1_actividad,nivel2_actividad,nivel3_actividad,comentarios) 
                     VALUES ('5','".$_POST['empresa_numero']."','".$_POST['asunto']."','".$_POST['fecha_hora_apertura']."',
                     	'".$_POST['fecha_hora_apertura']."','".$_POST['usuario_numero']."','".$_POST['tipact_numero']."',
                     	'".$_POST['cnta_numero']."','".$_POST['descripcion']."','".$_POST['direccion']."','".$_POST['nivel1_actividad']."','".$_POST['nivel2_actividad']."','".$_POST['nivel3_actividad']."',
                     	'".$_POST['observaciones']."')";
				
				//echo $sql;			
				$result=$db->executeQuery($sql);
	        	$db->commit();

	        	
	        		$sql="SELECT MAX(id) as id FROM actividades";

	        		$resultMax=$db->executeQuery($sql);
			        $db->commit();

			        $idact="";
			        if (isset($resultMax))
			        {
			            if (count($resultMax)>0)
			            {
			            	foreach($resultMax as $objeto)
		                    {

		                    	$idact=$objeto['id'];
		                    	$sql="UPDATE actividades SET fecha_hora_fin=(fecha_hora_fin + interval '1 hour')
		                    	      WHERE id='".$idact."'";
		                    	$r=$db->executeQuery($sql);
			        			$db->commit();
		                    }
		                }
		            }

	        		$resultado[]=array("idactividad"=>$idact,"result"=>true);
				

			}
			else
			{
				$sql.=" UPDATE actividades SET estado_registro='5',
											   empresa_numero='".$_POST['empresa_numero']."',
											   asunto='".$_POST['asunto']."',
											   fecha_hora_apertura='".$_POST['fecha_hora_apertura']."',
											   fecha_hora_fin='".$_POST['fecha_hora_fin']."',
											   usuario_numero='".$_POST['usuario_numero']."',
											   tipact_numero='".$_POST['tipact_numero']."',
											   direccion='".$_POST['direccion']."',
											   descripcion='".$_POST['descripcion']."',
											   nivel1_actividad='".$_POST['nivel1_actividad']."',
											   nivel2_actividad='".$_POST['nivel2_actividad']."',
											   nivel3_actividad='".$_POST['nivel3_actividad']."',
											   comentarios='".$_POST['observaciones']."',
											   cnta_numero='".$_POST['cnta_numero']."' 
					     WHERE id='".$_POST['idactividad']."'";
				$result=$db->executeQuery($sql);
	        	$db->commit();
	        	$resultado[]=array("idactividad"=>$_POST['idactividad'],"result"=>true);

			}

			echo json_encode($resultado);
	        
		break;
	}
	

?>