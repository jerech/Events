<?php
require_once 'library/PhpExcel/PHPExcel.php';

//Creo instancia de la clase de usuarios
$objUsuario=New Usuarios();

//Creo instancia de la clase de roles
$objRoles=New Roles();

//Creo instancia de la clase de Empresas
$objEmpresa=New Empresas();

//Creo instancia de la clase de roles
$objEstados=New Estados();



$aOrWhere=array();
$aWhere=array();

if ($_POST['usuarionumero']!="")
{
	$aWhere['usuario_numero']=$_POST['usuarionumero'];
	$oUsuarios=$objUsuario->buscar($aWhere);

	$oUsuario=$oUsuarios[0];
	
	unset($aWhere);
	$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
	$Empre=$objEmpresa->buscar($aWhere);
	
	$logo=$Empre[0]->getLogo_empresa();

	$logo=str_replace("http://nativoapps.com","",$logo);
	$handle = @fopen($_SERVER['DOCUMENT_ROOT'].$logo, "r");
				
	if ($handle)
	{
		$logo=$_SERVER['DOCUMENT_ROOT'].$logo;
		fclose($handle);
	}
	else 
	{
		$logo="";
	}

	unset($aWhere);
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
		$nivelIni++;
		if ($In!="")
    		$In.=")";
	}

	$aWhere['estado_registro IN']="(1,2)";
	
	$aWhere['empresa_numero']=$oUsuario->getEmpresa_numero();
		
	$aWhere['usuario_numero IN']=$In;
}

if (isset($_POST['busqueda']))
{
	if ($_POST['busqueda']!="")
	{
		$aOrWhere['usuario_numero::text ilike']=$_POST['busqueda'];
		$aOrWhere['nombre::text ilike']=$_POST['busqueda'];
		$aOrWhere['telefono::text ilike']=$_POST['busqueda'];
		$aOrWhere['email::text ilike']=$_POST['busqueda'];
		$aOrWhere['imei::text ilike']=$_POST['busqueda'];
	}
}

if (isset($_POST['identificadores']))
{
	if ($_POST['identificadores']!="")
	{
		$inId="(".$_POST['identificadores'].")";
		
		$aWhere['id IN']=$inId;
	}
}

$aUsuarios=$objUsuario->buscar($aWhere,$aOrWhere);

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
$title = "Exportar Usuarios";
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
$objPHPExcel->getActiveSheet()->setCellValue('G2', "LISTADO DE USUARIOS");
$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);
						

// Agregar Informacion encabezados
$objPHPExcel->getActiveSheet()
	->setCellValue('A7', 'NRO.USUARIO')
	->setCellValue('B7', 'NOMBRE')
	->setCellValue('C7', 'ROL')
	->setCellValue('D7', 'EMPRESA')
	->setCellValue('E7', 'ESTADO')
	->setCellValue('F7', 'IMAGEN')
	->setCellValue('G7', 'LOGIN');

$objPHPExcel->getActiveSheet()->getStyle('A7:AB7')->applyFromArray($styleArray);

$row=8;

                                           
if ($aUsuarios)
{
	if (count($aUsuarios)>0)
	{
		foreach($aUsuarios as $objeto)
		{
			$rol="";
			$empresa="";

            unset($aWhere);
            $aWhere['estado_registro']=$objeto->getEstado_registro();
            $Estados=$objEstados->buscar($aWhere);

			if ($objeto->getRol_numero()!=SUPERADMIN)
			{
				unset($aWhere);
				$aWhere['rol_numero']=$objeto->getRol_numero();
				$aRoles=$objRoles->buscar($aWhere);
				if (count($aRoles)>0)
					$rol=$aRoles[0]->getRol();
			}

			if ($objeto->getEmpresa_numero()!="")
			{
				unset($aWhere);
				$aWhere['empresa_numero']=$objeto->getEmpresa_numero();
				$aEmpresas=$objEmpresa->buscar($aWhere);
				if (count($aEmpresas)>0)
					$empresa=$aEmpresas[0]->getNombre_empresa();
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$row, $objeto->getUsuario_numero())
				->setCellValue('B'.$row, $objeto->getNombre())
				->setCellValue('C'.$row, $rol)
				->setCellValue('D'.$row, $empresa)
				->setCellValue('E'.$row, $Estados[0]->getDescripcion())
				->setCellValue('F'.$row, $objeto->getImagen())
				->setCellValue('G'.$row, $objeto->getLogin());

			$row++;
		}
	}
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="USUARIOS_'.date('Y-m-d').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>