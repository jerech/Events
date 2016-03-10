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
					$aAsignaciones=$objAsignacion->buscar($aWhere,$aOrWhere,"","","u.nombre","ASC","a.usuario_numero,u.nombre","a.usuario_numero,u.nombre,count(*) as totalAsignaciones"); 
            
			


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
$objPHPExcel->getActiveSheet()->setCellValue('G2', "REPORTE- ASIGNACIONES POR CAMILLERO");
$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);


// Agregar Informacion encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue('A7', 'CAMILLERO')
	->setCellValue('B7', 'TOTAL ASIGNACIONES')
	;
	// ->setCellValue('E7', 'FECHA_ULTIMA_ACT');

$objPHPExcel->getActiveSheet()->getStyle('A7:AB7')->applyFromArray($styleArray);

$row=8;

if ($aAsignaciones)
{
	if (count($aAsignaciones)>0)
	{
		foreach($aAsignaciones as $objeto)
		{
		       $objPHPExcel->getActiveSheet()
					->setCellValue('A'.$row, $objeto->nombre)
					->setCellValue('B'.$row, $objeto->totalasignaciones);
					// ->setCellValue('E'.$row, $objeto->getFecha_ultima_act());

				$row++;
		}
	}
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="REPORTE_ASIGNACIONES_CAMILLERO_'.date('Y-m-d').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
			

?>