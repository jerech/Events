<?php
require_once 'library/PhpExcel/PHPExcel.php';
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

			$aWhere=array();
			if ($_POST['usuarionumero']!="")
			{
				$aWhere['usuario_numero']=$_POST['usuarionumero'];
				$oUsuarios=$objUsuario->buscar($aWhere);

				$oUsuario=$oUsuarios[0];
unset($aWhere);
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
				else
					$aWhere['a.estado_registro IN']="(4,5)";
			
			}
			else
			{
				$aWhere['a.estado_registro IN']="(4,5)";
			
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
			
				}
				else
				{
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");	
					
				}
			}
			else
			{
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"","","a.id","DESC");	
			}


$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("NativoApps")
	->setLastModifiedBy("NativoApps")
	->setTitle("Exportacion")
	->setSubject("Exportacion")
	->setDescription("Exportaciones")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Excel");

$objPHPExcel->getSheetCount();

$positionInExcel=0;//esto es para que ponga la nueva pestaña al principio

$objPHPExcel->createSheet($positionInExcel);//creamos la pestaña
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//$datos_exportacion=mysqli_fetch_array($rsDetalle);
// Renombrar Hoja
$title = "Exportar Reporte";
$objPHPExcel->getActiveSheet()->setTitle(substr($title, 0, 20));

$styleArray = array(
    'font' => array(
        'bold' => true
    )
);

if ($logo!="")
{
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// 	$objDrawing->setName('Logo');
// 	$objDrawing->setDescription('Logo');
// 	$objDrawing->setPath($logo);  //setOffsetY has no effect
// 	$objDrawing->setCoordinates('A1');
// 	$objDrawing->setWidth(100); // logo width
// 	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
}
$objPHPExcel->getActiveSheet()->setCellValue('G2', "REPORTE- TIEMPO DE DEMORA");
$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);


// Agregar Informacion encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue('A7', 'ESTADO')
	->setCellValue('B7', 'DETALLE DEL SERVICIO')
	->setCellValue('C7', 'TIEMPO')
	->setCellValue('D7', 'ESTADO AVANCE')
	->setCellValue('E7', 'ULTIMO PTO. CHEQUEO')
	->setCellValue('F7', 'USUARIO')
	->setCellValue('G7', 'RECIBIO');
	// ->setCellValue('E7', 'FECHA_ULTIMA_ACT');

$objPHPExcel->getActiveSheet()->getStyle('A7:AB7')->applyFromArray($styleArray);

$row=8;

if ($aAsignaciones)
{
	if (count($aAsignaciones)>0)
	{
		foreach($aAsignaciones as $objeto)
		{
			$estado="ACTIVO";
            unset($aWhere);
            $aWhere['estado_registro']=$objeto->getEstado_registro();
            $oEstado=$objEstados->buscar($aWhere);
            if ($objeto->getEstado_registro()==2)
            {
                $estado="INACTIVO";
            }
            else if ($objeto->getEstado_registro()==3)
            {
                $estado="ELIMINADO";
            }
            else if ($objeto->getEstado_registro()==4)
            {
                $estado="ASIGNADO";
            }
            else if ($objeto->getEstado_registro()==5)
            {
                $estado="FINALIZADA";
            }


            unset($aWhere);
            $aWhere['estado_registro']=$objeto->getEstado_registro();
            $Estados=$objEstados->buscar($aWhere);

            $empresa="";

            if ($objeto->getEmpresa_numero()!="")
            {
                unset($aWhere);
                $aWhere['empresa_numero']=$objeto->getEmpresa_numero();
                $aEmpresas=$objEmpresas->buscar($aWhere);
                if (count($aEmpresas)>0)
                    $empresa=$aEmpresas[0]->getNombre_empresa();
            }

            $tipo="";
            
            if ($objeto->getIdtipoasignacion()!="")
            {
                unset($aWhere);
                $aWhere['id']=$objeto->getIdtipoasignacion();
                $aTipos=$objTipo->buscar($aWhere);
                if (count($aTipos)>0)
                    $tipo=$aTipos[0]->getNombre();
            }
            unset($aWhere);
            $aWhere['usuario_numero']=$objeto->getUsuario_numero();
            $camillero=$objUsuario->buscar($aWhere);
            $nameCamillero='';
            if (count($camillero)>0)
            {
                $profile_small = @fopen($camillero[0]->getImagen(), "r");
                $nameCamillero=$camillero[0]->getNombre();
                if ($profile_small)
                {
                    $logo=$camillero[0]->getImagen();
                    fclose($profile_small);
                }
                else 
                {
                    $profile_small = @fopen($aEmpresas[0]->getLogo_empresa(), "r");
                    if ($profile_small)
                    {
                        $logo=$aEmpresas[0]->getLogo_empresa();
                        fclose($profile_small);
                    }
                    else
                    {
                        $logo=BASE_URL."/img/gestion.png";
                    }
                }
            }
            else
            {
                $logo=BASE_URL."/img/gestion.png";
            }

            if ($estado!="FINALIZADA") {
                                       
            $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
            $timezone="America/Bogota";
            $fecha2=new datetime("now",new datetimezone($timezone));
            $fecha2->sub( new DateInterval('PT11M') );
            //$fecha2 = new DateTime(Now);
            //var_dump($fecha2);
            $fecha = $fecha1->diff($fecha2);
            
            }
            else
            {
                $ultPtoCheck=$objeto->getUltimoPuntoChequeoM();
                if (count($ultPtoCheck)>0)
                {
                    $fecha1 = new DateTime(substr($objeto->getCreated_at(),0,19));
                    $fecha2 = new DateTime(substr($ultPtoCheck[0]['updated_at'],0,19));
                    $fecha = $fecha1->diff($fecha2);
                 //   var_dump($fecha);
                }
            
            }
            $dejopasar=true;
            if (isset($_POST['searchtiempodesde']) && isset($_POST['searchtiempohasta']))
            {
                if ($_POST['searchtiempodesde']!='' && $_POST['searchtiempohasta']!='')
                {
                    $tiempodesde=strtotime($_POST['searchtiempodesde']);
                    $tiempohasta=strtotime($_POST['searchtiempohasta']);

                    $duracion=strtotime($fecha->h.":".$fecha->i);
                    // echo "desde".$tiempodesde."<br>";
                    // echo "hasta".$tiempohasta."<br>";
                    // echo "duracion".$duracion."<br><br>";
                    if ($tiempodesde>$duracion || $tiempohasta<$duracion)
                    {
                        $sdejopasar=false;
                    }

                }
            }
            if ($dejopasar){

            	$VarPorc=$objeto->getPorcentajePuntoChequeoM();
                if (count($VarPorc)>0)
                {
                    $porc=0;
                    if ($VarPorc[0]['total']>0)
                    $porc=($VarPorc[0]['marcados']*100)/$VarPorc[0]['total'];
                    $avance=number_format($porc,1,',','.')."%";
                }
                else
                {
                    $avance="0%";
                }

                $ultPtoCheck=$objeto->getUltimoPuntoChequeoM();
                $ultPtoCh="";
                if (count($ultPtoCheck)>0)
                {
                    $objPto=new Puntos_chequeo($ultPtoCheck[0]['idpunto']);
                    $fecha1 = new DateTime(substr($ultPtoCheck[0]['updated_at'],0,19));
                    $timezone="America/Bogota";
                    $fecha2=new datetime("now",new datetimezone($timezone));
                    $fecha2->sub( new DateInterval('PT11M') );
                
                    //$fecha2 = new DateTime(Now);
                    $fecha3 = $fecha1->diff($fecha2);
                    $ultPtoCh=$objPto->getNombre()." (".str_pad($fecha3->h,2,'0',STR_PAD_LEFT).":".str_pad($fecha3->i,2,'0',STR_PAD_LEFT).":".str_pad($fecha3->s,2,'0',STR_PAD_LEFT).") ";
                	$ultPtoCh=$objPto->getNombre()." - ".$ultPtoCheck[0]['updated_at'];
                }

                if (!$objeto->getEn_movil())
                {
                    $estado_movil="NO RECIBIDO";
                }
                else if ($objeto->getEn_movil())
                {
                    $estado_movil="RECIBIDO";
                }  
	           $objPHPExcel->getActiveSheet()
					->setCellValue('A'.$row, $estado)
					->setCellValue('B'.$row, $tipo." ".$objeto->getPaciente()." - ".substr($objeto->getCreated_at(),0,19))
					 ->setCellValue('C'.$row, str_pad($fecha->h,2,'0',STR_PAD_LEFT).":".str_pad($fecha->i,2,'0',STR_PAD_LEFT).":".str_pad($fecha->s,2,'0',STR_PAD_LEFT))
					 ->setCellValue('D'.$row, $avance)
					 ->setCellValue('E'.$row, $ultPtoCh)
					 ->setCellValue('F'.$row, $nameCamillero)
					->setCellValue('G'.$row, $estado_movil);
					// ->setCellValue('E'.$row, $objeto->getFecha_ultima_act());

				$row++;
			}
		}
	}
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="REPORTE_TIEMPO_DEMORADO_'.date('Y-m-d').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
			

?>